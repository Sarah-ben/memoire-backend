<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;
use App\Models\Reservation;

class SalleController extends Controller
{
  public function addsalle(Request $request){
    $fields=$request->validate([
       'name'=>'required|string|unique:classroom,name',
       'type'=>'required',
       'etage' => 'required',
       'capcity'=>'required',
       'particulier'=>'required',
    ]);
    $salle=Salle::create([
        'name'=>$fields['name'],
        'type'=>$fields['type'],
        'etage'=>$fields['etage'],
        'capcity'=>$fields['capcity'],
        'particulier'=>$fields['particulier'],


    ]);
    $response=[
        'salle'=>$salle,
    ];
    return response($response,201);
  }
// add data
    public function store(Request $request )
    {
        $request->validate([
            'name'=>'required|unique:classroom,name|max:191',
            'type'=>'required|max:191',
            'etage'=>'required|between:1,10',
            'capcity'=>'required|between:1,100',
            'particulier'=>'required|max:191',

        ]);
        // $user=Salle::create([
        //     'name'=>$fields['name'],
        //     'email'=>$fields['email'],
        //     'role'=>$fields['role'],
        //     'password'=>bcrypt($fields['password']),
        // ]);
        
       $salle= new Salle;
       $salle->name=$request->name;
       $salle->type=$request->type;
       $salle->etage=$request->etage;
       $salle->capcity=$request->capcity;
       $salle->particulier=$request->particulier=='true'?true:false;
      
       $salle->save();
       return response()->json(['message'=>'salle added successfully'],200);
    }

//update data
    public function update(Request $request,$id){
           
        $request->validate([
          // 'name'=>'required|unique:classroom,name|max:191',
          // 'type'=>'required|max:191',
           'etage'=>'required|between:1,10',
          'capcity'=>'required|between:1,100',
          'particulier'=>'required|max:191',
        ]);
       $salle= Salle::find($id);
       if($salle){
       // $salle->type=$request->input('type');
        $salle->etage=$request->input('etage');
        $salle->capcity=$request->input('capcity');
        $salle->particulier=$request->input('particulier');
        $salle->save();
        return response()->json(['message'=>'salle updated successfully'],200);
       }
       else {
        return response()->json([],404);
       }
    }
   
    //delete data
    public function delete ($id,) {
        if(Salle::where('id', $id)->exists() && Reservation::where('id_classroom',$id)->doesntExist()) {
          $salle = Salle::find($id);
          $salle->delete();
          return response()->json(
           "Classroom deleted"
          , 202);   
        } elseif(Salle::where('id', $id)->exists() && Reservation::where('id_classroom',$id)->exists()){
          return response()->json(
            "Classroom can not be deleted because it's already reserved "
          , 202);
        }
        else{
          return response()->json(
             "Classroom not found"
          , 404);
        }
      }

      // public function addDatashow(Request $request){
      //   $fields=$request->validate([
      //      'category'=>'required|string',
      //      'number'=>'required|integer',
        
      //   ]);
      //   $salle=Salle::create([
      //       'category'=>$fields['category'],
      //       'number'=>$fields['number'],
            
      //   ]);
      //   $response=[
      //       'datashows'=>$salle,
      //   ];
      //   return response($response,201);
      // }
      function getByFilter($time,$date,$type){
        $salle=Salle::where([['id', '=', 28], ['type', '=', 'classroom']])->get();
        return $salle;
      }


      function getClassrooms(){
        return Salle::All();
      }
}
