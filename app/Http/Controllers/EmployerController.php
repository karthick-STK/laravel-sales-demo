<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Employer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmployerController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checkRole:$role');
    }

    public function index()
    {
        $emp = Employer::get();
        $category = Category::get();
        return view('employer', ['datas'=>$category,'employer'=>$emp]);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getcat(Request $request)
    {
        $data = new Product;
        $cat = $request->name;
        $categoty = Product::select("*")
                        ->where("category", "=", $cat)
                        ->get();                

        return response()->json(['result' => 'success','category'=>$categoty]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Employer;
        $data->p_name = $request->pr_name;
        $data->p_price = $request->price;
        $data->p_cat = $request->category;
        $data->qty = $request->qty;
        $data->total = $request->tot;                

        if($data->save()){
            Mail::send('welcome', ['name' => $request->pr_name,'price'=>$request->price,'qty'=>$request->qty,'tot'=>$request->tot], function($message) {
                $message->to('prasanth@sparkouttech.com');
                $message->subject('sales product');
            });
            return redirect('{{url('/')}}/emp/dashboard');
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Employer::find($id);        
        return response()->json(['result' => 'success','sale'=>$sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Employer::find($id);
        $data->p_cat = $request->cate; 
        $data->p_name = $request->pro;                
        $data->save();
        return response()->json(['result' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Employer::find($id);
        $post->delete();
        return response()->json(['result' => 'success']);
    }
}
