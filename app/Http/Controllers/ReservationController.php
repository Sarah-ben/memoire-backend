<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
class ReservationController extends Controller
{
    public function store(Request $request){
        $fields=$request->validate([
           'time'=>'required',
           'date'=>'required',
           'goal'=>'required|string',
           'etat'=>'required|string',
           'id_classroom' => 'required',
           'id_user'=>'required',
        ]);
        // $reservation=Reservation::create([
        //     'time'=>$fields['time'],
        //     'date'=>$fields['date'],
        //     'goal'=>$fields['goal'],
        //     'etat'=>$fields['etat'],
        //     'id_classroom'=>$fields['id_classroom'],
        //     'id_user'=>$fields['id_user'],
        // ]);
        $reservation= new Reservation;
        $reservation->time=$request->time;
        $reservation->date=$request->date;
        $reservation->goal=$request->goal;
        $reservation->etat=$request->etat;
        $reservation->id_classroom=$request->id_classroom;
        $reservation->id_user=$request->id_user;
        $info=Reservation::where('date',$request->date)->where('time',$request->time)->where('id_classroom',$request->id_classroom);
        if($info->exists()){
          return response()->json(['message'=>'salle exists'],200);
        } else{
          $reservation->save();

          $response=[
              'reservations'=>$reservation,
          ];
          return response($response,201);
        }
       
      }
    
    
    //update data
    public function update(Request $request,$id){
        $request->validate([
            //'name'=>'required|unique:salle,name|max:191',
            //'type'=>'required|unique|max:191',
            'time'=>'required',
            'date'=>'required',
            'goal'=>'required|string',
            'id_classroom'=>'required',
            'id_user'=>'required',
            'etat'=>'required|string',
        ]);
       $reservation= Reservation::find($id);
       if($reservation){
       // $salle->type=$request->input('type');
        $reservation->time=$request->input('time');
        $reservation->date=$request->input('date');
        $reservation->goal=$request->input('goal');
        $reservation->id_classroom=$request->input('id_classroom');
        $reservation->id_user=$request->input('id_user');
        $reservation->etat=$request->input('etat');

        $reservation->save();
        return response()->json(['message'=>'reservation updated successfully'],200);
       }
       else {
        return response()->json(['message'=>'reservation updated failed!'],404);
       }
       
    }
         //delete data
    public function delete ($id) {
        if(Reservation::where('id', $id)->exists()) {
          $reservation = Reservation::find($id);
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
        return  Reservation::where('id_user',$id)->get();;
      }

      //get all reservations
      public function getReservations () {
        return  Reservation::All();
      }

      public function example(Request $request)
{
    $fields=$request->validate([
      'time'=>'required',
      'date'=>'required',
      'goal'=>'required|string',
      'etat'=>'required|string',
      'id_classroom' => 'required',
      'id_user'=>'required',
   ]);
   $reservation=Reservation::create([
       'time'=>$fields['time'],
       'date'=>$fields['date'],
       'goal'=>$fields['goal'],
       'etat'=>$fields['etat'],
       'id_classroom'=>$fields['id_classroom'],
       'id_user'=>$fields['id_user'],
   ]);
   $time = Reservation::where('time', $request->time)->doesntExist();
   $date = Reservation::where('date', $request->date)->doesntExist();
   $id_classroom = Reservation::where('id_classroom', $request->id_classroom)->doesntExist();

   if ($time && $date && $id_classroom ) {
    $response=[
      'reservations'=>$reservation,
  ];
    }
     else {
            echo "email exists";

          }
}
function getParticulars(){
  return Reservation::where('etat', '=', 'waiting')->get();
}
function findAllData(){
  return Reservation::All();
}
}
// $data = Reservation::where('id_user',$id)->get();
// return response()->json($data, 200);