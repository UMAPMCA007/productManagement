<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function product()
    {
        $brands=Brand::all();
        return view('products.index',compact('brands'));
    }
    public function createP(Request $request)
    {
        $request->validate([
            'pcode'=>'required',
            'pname'=>'required',
            'brand'=>'required',
            'sprice'=>'required',
            'oprice'=>'required',
            'img[]'=>'',
        ]);


        $images=$request->file('img');

        if ($request->file('img')) {
            foreach ($images as $item){
                $imageName = $item->getClientOriginalName();
                $item->move(public_path('images'), $imageName);
                $arr[] = $imageName;
            }
            /*$image = implode(",", $arr);*/
            $image=$arr;
        }else{
            $image = '';


        }

        $product=new Product();
        $product->pcode=$request->pcode;
        $product->pname=$request->pname;
        $product->brand_id=$request->brand;
        $product->sprice=$request->sprice;
        $product->oprice=$request->oprice;
        $product->img=json_encode($image);
        $product->save();
        return response()->json(['status'=>200,'Message'=>"data successfully saved",'data'=>$request->all()]);
    }
    public function removeP(Request $request)
    {
        $id=$request->id;
        $delete=Product::where('id',$id)->delete();
        if($delete){
            return response()->json(['status'=>200,'data'=>'brand removed']);
        }
    }
    public function ProductData(){
        $products=Product::all();
        return response()->json(['success'=>200,'products'=>$products]);
    }

    public function EditProduct(Request $request,$id){
        $request->validate([
            'pcode'=>'required',
            'pname'=>'required',
            'brand'=> 'required',
            'sprice'=>'required',
            'oprice'=>'required',
            'img'=>'',
        ]);

        $images=$request->img;
        if ($request->hasFile('img')) :
            foreach ($images as $item):
                $imageName =$item->getClientOriginalName();
                $item->move(public_path('images'), $imageName);
                $arr[] = $imageName;
            endforeach;
            $image = implode(",", $arr);
        else:
            $image = '';
        endif;


        $product=new Product();
        $product->pcode=$request->pcode;
        $product->pname=$request->pname;
        $product->brand=$request->brand;
        $product->sprice=$request->sprice;
        $product->oprice=$request->oprice;
        $product->img=$image;
        $save=$product->save();
        if($save){
            return response()->json(['success'=>200,'data'=>"Edited successfully"]);
        }else{
            return response()->json(['state'=>404,'data'=>"Edited failed"]);

        }

    }
}
