<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Salle;

class AuthController extends Controller
{
    // try to add salle
    
    //REGISTER
    public function register(Request $request){
        $fields=$request->validate([
           'first_name'=>'required|string',
           'last_name'=>'required|string',
           'grade'=>'required|string',
           'place'=>'required|string',
           'email'=>'required|string|unique:users,email',
           'role' => 'required',
           'password'=>'required|string|confirmed',

        ]);
        $user=User::create([
            'first_name'=>$fields['first_name'],
            'last_name'=>$fields['last_name'],
            'grade'=>$fields['grade'],
            'place'=>$fields['place'],
            'email'=>$fields['email'],
            'role'=>$fields['role'],
            'password'=>bcrypt($fields['password']),


        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }

   //LOGIN
    public function login(Request $request){
        $fields=$request->validate([
           'email'=>'required|string',
           'password'=>'required|string',

        ]);
        //check email n passwd
        $user=User::where('email',$fields['email'])->first();

        if(!$user||!Hash::check($fields['password'],$user->password)){
         return response(['message'=>'bad creds'],401);
        }
       
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }

   //LOGOUT
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Logged out '
        ];
    }

   // DELETE 
   
    public function delete ($id) {
        if(User::where('id', $id)->exists()) {
          $salle = User::find($id);
          $salle->delete();
          return response()->json([
            "message" => "user deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "user not found"
          ], 404);
        }
      }

    // UPDATE 
    public function update(Request $request,$id){
        $request->validate([
          // 'name'=>'required|unique:classroom,name|max:191',
          // 'type'=>'required|max:191',
          'first_name'=>'required|string',
          'last_name'=>'required|string',
          'grade'=>'required|string',
          'place'=>'required|string',
          'role' => 'required',
          //'password'=>'required|string|confirmed',           
         
        ]);
       $salle= User::find($id);
       if($salle){
       // $salle->type=$request->input('type');
        $salle->first_name=$request->input('first_name');
        $salle->last_name=$request->input('last_name');
        $salle->grade=$request->input('grade');
        $salle->place=$request->input('place');
        $salle->role=$request->input('role');
        //$salle->password=$request->input('password');
          $salle->save();
        return response()->json(['message'=>'user updated successfully'],200);
       }
       else {
        return response()->json([],404);
       }
    }


    public function getUsers(){
        return User::all();
        //User::where('id',$id)->get();
    }
 
}


