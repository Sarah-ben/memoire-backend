<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function addMaterial(Request $request){
        $fields=$request->validate([
           'category'=>'required|string',
           'name'=>'required',
        
        ]);
        $salle=Material::create([
            'category'=>$fields['category'],
            'name'=>$fields['name'],
            
        ]);
        $response=[
            'datashows'=>$salle,
        ];
        return response($response,201);
      }

      public function deleteMaterial ($id) {
        if(Material::where('id', $id)->exists()) {
          $material = Material::find($id);
          $material->delete();
          return response()->json([
            "message" => "material deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "material not found"
          ], 404);
        }
      }

      public function getMaterial(){
        return Material::all();
      }
      
    }
