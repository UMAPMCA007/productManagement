<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use http\Env\Response;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
       return view('dashboard.index');
    }
    public function brand()
    {

       return view('brand.index');
    }
    public function createB(Request $request)
    {
       $request->validate([
          'brand'=>'required'
       ]);
       $brand=new Brand();
       $brand->brand=$request->brand;
       $brand->save();
       return response()->json(['status'=>200]);
    }
    public function removeB(Request $request)
    {
        $id=$request->id;
        $delete=Brand::where('id',$id)->delete();
        if($delete){
            return response()->json(['status'=>200,'data'=>'brand removed']);
        }
    }
    public function BrandData(){
        $brands=Brand::all();
        return response()->json(['success'=>200,'brands'=>$brands]);
    }

    public function EditBrand(Request $request,$id){
        $brand=$request->brand;
        $brands=Brand::where('id',$id)->first();
        $brands->brand=$brand;
        $save=$brands->save();
        if($save){
            return response()->json(['success'=>200,'data'=>"Edited successfully"]);
        }else{
            return response()->json(['state'=>404,'data'=>"Edited failed"]);

         }

    }
}
