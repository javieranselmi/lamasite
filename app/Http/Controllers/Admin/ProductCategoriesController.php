<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductCategoriesController extends AdminController
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductCategories = \App\ProductCategory::all();
        $ViewParameters = ['product_categories' => $ProductCategories];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.product_categories.product_categories_list', $ViewParameters);
    }

    public function add_form()
    {
        $ViewParameters = [];
        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }
        return view('admin.product_categories.product_categories_add', $ViewParameters);
    }

    public function edit_form($product_category_id)
    {
        $ProductCategory = \App\ProductCategory::find($product_category_id);
        if($ProductCategory == null)
            abort(404);

        return view('admin.product_categories.product_categories_edit', ['product_category' => $ProductCategory]);
    }

    public function edit_category($product_category_id, Request $request){
        $ProductCategory = \App\ProductCategory::find($product_category_id);
        if($ProductCategory == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_description' => 'required',
            'category_photo' => 'sometimes|required|image'
        ]);

        if($validator->fails()){
            return view('admin.product_categories.product_categories_edit', ['failed' => true, 'errors' => $validator->errors(), 'product_category' => $ProductCategory]);
        }

        $CategoryName = Input::get('category_name');
        $CategoryDescription = Input::get('category_description');
        $FileUpload = $request->file('category_photo');

        $FileToDelete = null;
        if($FileUpload != null){
            $ProductCategoryImage = Image::make($FileUpload)->resize(300,204)->stream();
            $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductCategoryImage->__toString());
            $FileToDelete = $ProductCategory->file;
            $ProductCategory->file()->associate($File);

        }

        $ProductCategory->name = $CategoryName;
        $ProductCategory->description = $CategoryDescription;
        $ProductCategory->save();
        if(!is_null($FileToDelete))
            $FileToDelete->delete();

        return redirect()->route('admin_product_categories', ['status' => 'success','message' => 'Categoria Editada']);
    }

    public function create_category(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_description' => 'required',
            'category_photo' => 'required|image'
        ]);

        if($validator->fails()){
            return view('admin.product_categories.product_categories_add', ['failed' => true, 'errors' => $validator->errors()]);
        }

        $CategoryName = Input::get('category_name');
        $CategoryDescription = Input::get('category_description');
        $FileUpload = $request->file('category_photo');
        $ProductCategoryImage = Image::make($FileUpload)->resize(300,204)->stream();
        $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductCategoryImage->__toString());
        \App\ProductCategory::create(['name' => $CategoryName, 'description' => $CategoryDescription, 'file_id' => $File->id]);


        if(Input::get('new')){
            return redirect()->route('admin_product_categories_add', ['status' => 'success', 'message' => 'Categoria Creada']);
        }
        return redirect()->route('admin_product_categories', ['status' => 'success', 'message' => 'Categoria Creada']);
    }

    public function delete_category($product_category_id, Request $request){
        if($request->ajax()) {
            $ProductCategory = \App\ProductCategory::find($product_category_id);
            if ($ProductCategory == null)
                return response()->json(['status' => 'error', 'message' => "Categoria no existente"]);

            if ($ProductCategory->products->count() > 0)
                return response()->json(['status' => 'error', 'message' => "Esta categoria tiene productos relacionados. No puede ser borrada."]);

            $ProductCategory->delete();
            return response()->json(['status' => 'success', 'message' => "Categoria Borrada"]);
        }
        abort(400);
    }
}
