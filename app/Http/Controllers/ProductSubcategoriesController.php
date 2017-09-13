<?php

namespace App\Http\Controllers;

use App\Mail\ShareProduct;
use App\Product;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductSubcategoriesController extends Controller
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

    public function getSubcategory($product_category_id, $product_subcategory_id){
        $ProductCategory = \App\ProductCategory::find($product_category_id);
        if(is_null($ProductCategory))
            abort(404);

        $ProductSubcategory = $ProductCategory->product_subcategories->where('id', $product_subcategory_id)->first();
        if(is_null($ProductSubcategory))
            abort(404);

        return view('product_subcategory_details', ['product_subcategory' => $ProductSubcategory]);
    }

}
