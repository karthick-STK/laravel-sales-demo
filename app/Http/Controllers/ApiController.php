<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;
use App\Models\Employer;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function user (Request $request)
    {  

        $name = $request->input('username');
        $password = $request->input('password');
       // $password = Hash::make($request->input('password'));

        if (Auth::attempt(['email' => 'ferlin@gmail.com', 'password' => 'Temp@#12312'])){
            return Auth::user();
            }
            else {        
                return "Wrong Credentials";
            }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request)
    {
       
        $api_token = $request->input('api_token');
        
        $data = User::where('api_token','=',$api_token)->first();

        if(!empty($data)){
            $user_role = $data->role;
            $user_id = $data->id;
            
            if($user_role == 'admin'){
                $products = Product::get();
                return response()->json(['result'=>'success', 'products'=>$products]);
            }else{
                return response()->json(['result'=>'failed', 'message'=> 'Dont have enough previledge..']);
            }

        }else{
            return response()->json(['result'=>'failed','message'=> 'Invalid API Key']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request)
    {
        $api_token = $request->input('api_token');
        
        $data = User::where('api_token','=',$api_token)->first();

        if(!empty($data)){
            $user_role = $data->role;
            $user_id = $data->id;
            
            if($user_role == 'admin'){
                $category = Category::get();
                return response()->json(['result'=>'success', 'category'=>$category]);
            }else{
                return response()->json(['result'=>'failed', 'message'=> 'Dont have enough previledge..']);
            }
        }else{
            return response()->json(['result'=>'failed','message'=> 'Invalid API Key']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        $api_token = $request->input('api_token');
        
        $data = User::where('api_token','=',$api_token)->first();

        if(!empty($data)){
            $user_role = $data->role;
            $user_id = $data->id;
            
            if($user_role == 'emp'){
                $employer = Employer::get();
                return response()->json(['result'=>'success', 'sales'=>$employer]);
            }else{
                return response()->json(['result'=>'failed', 'message'=> 'Dont have enough previledge..']);
            }
        }else{
            return response()->json(['result'=>'failed','message'=> 'Invalid API Key']);
        }
    }

}
