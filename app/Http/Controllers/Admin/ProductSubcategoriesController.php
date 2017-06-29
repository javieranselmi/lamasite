<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductSubcategoriesController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_subcategories_from_category(Request $request){
        if($request->ajax()){
            $ProductCategory = \App\ProductCategory::find(Input::get('category_id'));
            if ($ProductCategory == null)
                return response()->json(['status' => 'error', 'message' => "Categoria no existente"]);

            return response()->json(['status' => 'success', 'subcategories' => $ProductCategory->product_subcategories]);
        }
        abort(400);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductSubcategories = \App\ProductSubcategory::all();
        $ViewParameters = ['product_subcategories' => $ProductSubcategories];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.product_subcategories.product_subcategories_list', $ViewParameters);
    }

    public function add_form()
    {
        $ProductCategories = \App\ProductCategory::all();
        $ViewParameters = ['product_categories' => $ProductCategories];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }
        return view('admin.product_subcategories.product_subcategories_add', $ViewParameters);
    }

    public function edit_form($product_subcategory_id)
    {
        $ProductSubcategory = \App\ProductSubcategory::find($product_subcategory_id);
        $ProductCategories = \App\ProductCategory::all();
        if($ProductSubcategory == null)
            abort(404);

        return view('admin.product_subcategories.product_subcategories_edit', ['product_subcategory' => $ProductSubcategory, 'product_categories' => $ProductCategories]);
    }

    public function edit_subcategory($product_subcategory_id, Request $request){
        $ProductSubcategory = \App\ProductSubcategory::find($product_subcategory_id);
        if($ProductSubcategory == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'subcategory_name' => 'required',
            'subcategory_category_id' => 'required|exists:product_categories,id'
        ]);

        if($validator->fails()){
            $ProductCategories = \App\ProductCategory::all();
            return view('admin.product_subcategories.product_subcategories_edit', ['failed' => true, 'errors' => $validator->errors(), 'product_subcategory' => $ProductSubcategory, 'product_categories' => $ProductCategories]);
        }

        $SubcategoryName = Input::get('subcategory_name');
        $Category = \App\ProductCategory::find(Input::get('subcategory_category_id'));

        $ProductSubcategory->name = $SubcategoryName;
        $ProductSubcategory->product_category()->associate($Category);
        $ProductSubcategory->save();

        return redirect()->route('admin_product_subcategories', ['status' => 'success','message' => 'Subcategoria Editada']);
    }

    public function create_subcategory(Request $request){
        $validator = Validator::make($request->all(), [
            'subcategory_name' => 'required',
            'subcategory_category_id' => 'required|exists:product_categories,id'
        ]);

        if($validator->fails()){
            $ProductCategories = \App\ProductCategory::all();
            return view('admin.product_subcategories.product_subcategories_add', ['failed' => true, 'errors' => $validator->errors(), 'product_categories' => $ProductCategories]);
        }

        $SubcategoryName = Input::get('subcategory_name');
        $Category = \App\ProductCategory::find(Input::get('subcategory_category_id'));
        \App\ProductSubcategory::create(['name' => $SubcategoryName, 'product_category_id' => $Category->id]);


        if(Input::get('new')){
            return redirect()->route('admin_product_subcategories_add', ['status' => 'success', 'message' => 'Subcategoria Creada']);
        }
        return redirect()->route('admin_product_subcategories', ['status' => 'success', 'message' => 'Subcategoria Creada']);
    }

    public function delete_subcategory($product_subcategory_id, Request $request){
        if($request->ajax()) {
            $ProductSubcategory = \App\ProductSubcategory::find($product_subcategory_id);
            if ($ProductSubcategory == null)
                return response()->json(['status' => 'error', 'message' => "Subcategoria no existente"]);

            if ($ProductSubcategory->products->count() > 0)
                return response()->json(['status' => 'error', 'message' => "Esta subcategoria tiene productos relacionados. No puede ser borrada."]);

            $ProductSubcategory->delete();
            return response()->json(['status' => 'success', 'message' => "Subcategoria Borrada"]);
        }
        abort(400);
    }
}
