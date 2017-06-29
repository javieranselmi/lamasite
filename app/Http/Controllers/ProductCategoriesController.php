<?php

namespace App\Http\Controllers;

use App\Mail\ShareProduct;
use App\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductCategoriesController extends Controller
{

    use ValidatesRequests;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductCategories = \App\ProductCategory::all();
        return view('product_categories_list', ['product_categories' => $ProductCategories->all()]);
    }

    public function getCategory($product_category_id){
        $ProductCategory = \App\ProductCategory::find($product_category_id);
        if(is_null($ProductCategory))
            abort(404);

        return view('product_category_details', ['product_category' => $ProductCategory]);
    }



    public function share(Request $r)
    {
        if ($r->ajax()) {
            $product = Product::find($r->product_id);
            $this->validate($r,[
                'email' => 'email|required'
            ]);
            Mail::to($r->email)->send(new ShareProduct($product));
            $product->share_count = $product->share_count + 1;
            $product->save();
            $this->metricService->publishCounterWithResource('share', $product, Auth::user());
            return response()->json(['status' => 'success',
                'message' => 'Email enviado!',
                'share_count' => $product->share_count,
                'product_id' => $product->id
            ]);
        }
        abort(400);
    }
}
