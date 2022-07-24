<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsResource;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function PHPUnit\Framework\isEmpty;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=ProductsResource::collection(Products::orderBy('id')->get());
        return ['status'=>200,'data'=>$products];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return ['status'=>200,'data'=>$request->all()['title_uz']];
        $response=[];
        $res=Products::create($request->all());
        if($res)
        {
            $response['status']=200;
            $response['data']=$response;
        }
        else
        {
            $response['status']=200;
            $response['data']=$res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=new ProductsResource(Products::find($id));
        $response=[];
        if($product)
        {
            $response['status']=200;
            $response['data']=$product;
        }
        else
        {
            $response['status']=404;
            $response['error']='There is not product with '.$id.' ID';
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response=[];
        $res=Products::find($id)->update($request->all());
        if($res)
        {
            $response['status']=200;
            $response['data']=$res;
        }
        else
        {
            $response['status']=500;
            $response['data']=$res;
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response=[];
        if(Products::destroy($id))
        {
            $response['status']=200;
        }
        else{
            $response['status']=500;
        }
        return $response;
    }
}
