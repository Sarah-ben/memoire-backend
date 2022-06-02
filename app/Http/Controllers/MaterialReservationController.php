<?php

namespace App\Http\Controllers;

use App\Models\materialReservation;
use Illuminate\Http\Request;

class MaterialReservationController extends Controller
{
   

    public function store(Request $request){
        $fields=$request->validate([
           'time'=>'required',
           'date'=>'required',
           'goal'=>'required|string',
           'id_material' => 'required',
           'id_user'=>'required',
        ]);
        $reservation=materialReservation::create([
            'time'=>$fields['time'],
            'date'=>$fields['date'],
            'goal'=>$fields['goal'],
            'id_material'=>$fields['id_material'],
            'id_user'=>$fields['id_user'],
        ]);
        $response=[
            'reservations'=>$reservation,
        ];
        return response($response,201);
      }
    
    
    //update data
    public function update(Request $request,$id){
        $request->validate([
            //'name'=>'required|unique:salle,name|max:191',
            //'type'=>'required|unique|max:191',
            'time'=>'required',
            'date'=>'required',
            'goal'=>'required|string',
           // 'id_material'=>'required',
           // 'id_user'=>'required',

        ]);
       $reservation= materialReservation::find($id);
       if($reservation){
       // $salle->type=$request->input('type');
        $reservation->time=$request->input('time');
        $reservation->date=$request->input('date');
        $reservation->goal=$request->input('goal');
       // $reservation->id_material=$request->input('id_material');
       // $reservation->id_user=$request->input('id_user');
        $reservation->save();
        return response()->json(['message'=>'reservation updated successfully'],200);
       }
       else {
        return response()->json(['message'=>'reservation updated failed!'],404);
       }
       
    }
         //delete data
    public function delete ($id) {
        if(materialReservation::where('id', $id)->exists()) {
          $reservation = materialReservation::find($id);
          $reservation->delete();
          return response()->json([
            "message" => "salle deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "salle not found"
          ], 404);
        }
      }
     
           //get reservation  data
    public function findList ($id) {
        return  materialReservation::where('id_user',$id)->get();;
      }

      //get all reservations
      public function getReservations () {
        return  materialReservation::All();
      }

  

    

   

}
