<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductsController extends AdminController
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
        $Products = \App\Product::all();

        $ViewParameters = ['products' => $Products];

        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.products.products_list', $ViewParameters);
    }

    public function add_form(){
        $ProductCategories = \App\ProductCategory::all();
        $Courses = \App\Course::all();

        $ViewParameters = ['product_categories' => $ProductCategories, 'courses' => $Courses];
        if(Input::get('status') != "" && Input::get('message') != ""){
            $ViewParameters = array_merge($ViewParameters, ['status' => Input::get('status'), 'message' => Input::get('message')]);
        }

        return view('admin.products.products_add', $ViewParameters);
    }

    public function create_product(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_subtitle' => 'required',
            'product_description' => 'required',
<<<<<<< HEAD
            'product_photo' => 'required',
=======
            'product_photo' => 'required|image',
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            'product_featured' => 'boolean',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_components' => 'required',
            'product_subcategory_id' => 'required'
        ]);




        if($validator->fails()){
            dd($validator->errors());
            $ProductCategories = \App\ProductCategory::all();
            return view('admin.products.products_add', ['failed' => true, 'errors' => $validator->errors(), 'product_categories' => $ProductCategories, 'courses' => \App\Course::all()]);
        }

        $ProductSubcategory = Input::get('product_subcategory_id');

        if($ProductSubcategory != 0){
            $ProductSubcategory = \App\ProductSubcategory::find($ProductSubcategory);
            if($ProductSubcategory == null){
                $ProductCategories = \App\ProductCategory::all();
                return view('admin.products.products_add', ['failed' => true, 'errors' => 'errores', 'product_categories' => $ProductCategories, 'courses' => \App\Course::all()]);
            }
        }else{
            $ProductSubcategory = null;
        }

        $ProductName = Input::get('product_name');
        $ProductDescription = Input::get('product_description');
        $ProductFeatured = Input::get('product_featured', false);
<<<<<<< HEAD
        $FileUpload = Input::get('product_photo');
        $ProductCategory = \App\ProductCategory::find(Input::get('product_category_id'));
        //$ProductImageThumb = Image::make($FileUpload)->resize(143,200)->stream();
        $FileUpload = \App\File::create(['file_name' => $FileUpload ]);
        
        //$ProductImage = Image::make($FileUpload)->resize(300,400)->stream();
        //$File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImage->__toString());
=======
        $FileUpload = $request->file('product_photo');
        $ProductCategory = \App\ProductCategory::find(Input::get('product_category_id'));
        $ProductImageThumb = Image::make($FileUpload)->resize(143,200)->stream();
        $FileThumb = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'_thumb.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImageThumb->__toString());
        
        $ProductImage = Image::make($FileUpload)->resize(300,400)->stream();
        $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImage->__toString());
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f

        $ProductComponents = Input::get('product_components');


        $Product = \App\Product::create(['name' => $ProductName,
            'featured' => $ProductFeatured,
            'description' => $ProductDescription,
            'product_category_id' => $ProductCategory->id,
            'product_subcategory_id' => !is_null($ProductSubcategory) ? $ProductSubcategory->id : null,
<<<<<<< HEAD
            'thumb_id' => $FileUpload->id,
            'photo_id' => $FileUpload->id,
=======
            'thumb_id' => $FileThumb->id,
            'photo_id' => $File->id,
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            'subtitle' => $request->product_subtitle,
            'components' => $ProductComponents
        ]);

        $RelatedCourses = Input::get('product_related_courses');
        if(count($RelatedCourses) > 0){
            foreach($RelatedCourses as $relatedCourse){
                $Course = \App\Course::find($relatedCourse);
                if(!is_null($Course)){
                    $Product->courses()->attach($Course);
                }
            }
        }

<<<<<<< HEAD
        $RelatedFiles = Input::get('product_related_files');
        if(is_array($RelatedFiles)){
            foreach($RelatedFiles as $relatedFile){
                $File = \App\File::create(['file_name' => $relatedFile ]);
=======
        $RelatedFiles = Input::file('product_related_files');
        if(is_array($RelatedFiles)){
            foreach($RelatedFiles as $relatedFile){
                $File = \App\File::create(['file_name_original' => $relatedFile->getClientOriginalName(), 'file_name' => $relatedFile->getFilename().'.'.$relatedFile->getClientOriginalExtension(), 'mime' => $relatedFile->getMimeType()], File::get($relatedFile));
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
                $Product->files()->attach($File);
                $Product->save();
            }
        }

        if(Input::get('new')){
            return redirect()->route('admin_products_add', ['status' => 'success', 'message' => 'Producto Creado']);
        }
        return redirect()->route('admin_products', ['status' => 'success', 'message' => 'Producto Creado']);
    }



    public function edit_form($product_id){
        $Product = \App\Product::find($product_id);
        if($Product == null)
            abort(404);

        $Courses = \App\Course::all();
        $ProductCategories = \App\ProductCategory::all();
        return view('admin.products.products_edit', ['product' => $Product, 'product_categories' => $ProductCategories, 'courses' => $Courses]);
    }

    public function edit_product($product_id, Request $request){
        $Product = \App\Product::find($product_id);
        if($Product == null)
            abort(404);


        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_subtitle' => 'required',
<<<<<<< HEAD
            'product_photo' => 'required',
=======
            'product_photo' => 'sometimes|required|image',
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            'product_featured' => 'boolean',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_components' => 'required',
            'product_subcategory_id' => 'required'
        ]);

        if($validator->fails()){
            $ProductCategories = \App\ProductCategory::all();
            return view('admin.products.products_edit', ['failed' => true, 'errors' => $validator->errors(), 'product_categories' => $ProductCategories, 'product' => $Product, 'courses' => \App\Course::all()]);
        }

        $ProductSubcategory = Input::get('product_subcategory_id');

        if($ProductSubcategory != 0){
            $ProductSubcategory = \App\ProductSubcategory::find($ProductSubcategory);
            if($ProductSubcategory == null){
                $ProductCategories = \App\ProductCategory::all();
                return view('admin.products.products_edit', ['failed' => true, 'errors' => 'errors', 'product_categories' => $ProductCategories, 'product' => $Product, 'courses' => \App\Course::all()]);
            }
        }else{
            $ProductSubcategory = null;
        }

        $ProductName = Input::get('product_name');
        $ProductDescription = Input::get('product_description');
<<<<<<< HEAD
        $FileUpload = Input::get('product_photo');
=======
        $FileUpload = $request->file('product_photo');
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        $ProductCategory = \App\ProductCategory::find(Input::get('product_category_id'));

        $ProductFeatured = Input::get('product_featured', false);

        if($FileUpload != null){
<<<<<<< HEAD
            //$ProductImageThumb = Image::make($FileUpload)->resize(143,200)->stream();
            //$FileThumb = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'_thumb.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImageThumb->__toString());

            //$ProductImage = Image::make($FileUpload)->resize(300,400)->stream();
            $File = \App\File::create(['file_name' => $FileUpload]);

            $Product->thumb()->associate($File);
=======
            $ProductImageThumb = Image::make($FileUpload)->resize(143,200)->stream();
            $FileThumb = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'_thumb.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImageThumb->__toString());

            $ProductImage = Image::make($FileUpload)->resize(300,400)->stream();
            $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType()], $ProductImage->__toString());

            $Product->thumb()->associate($FileThumb);
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            $Product->photo()->associate($File);

        }

        $ProductComponents = Input::get('product_components');

        $Product->name = $ProductName;
        $Product->description = $ProductDescription;
        $Product->featured = $ProductFeatured;
        $Product->product_category()->associate($ProductCategory);

        if(is_null($ProductSubcategory)){
            $Product->product_subcategory()->dissociate();
        }else {
            $Product->product_subcategory()->associate($ProductSubcategory);
        }

        $Product->subtitle = $request->product_subtitle;
        $Product->components = $ProductComponents;

        $RelatedCourses = Input::get('product_related_courses');
        $Product->courses()->detach();
        if(count($RelatedCourses) > 0){
            foreach($RelatedCourses as $relatedCourse){
                $Course = \App\Course::find($relatedCourse);
                if(!is_null($Course)){
                    $Product->courses()->attach($Course);
                }
            }
        }

<<<<<<< HEAD
=======
        $CurrentRelatedFiles = Input::get('product_related_files_id');
        if(count($CurrentRelatedFiles) > 0){
            $FilesToRemove = $Product->files->diff(\App\Answer::whereIn('id', $CurrentRelatedFiles)->get());
            foreach($FilesToRemove as $fileToRemove){
                $Product->files()->detach($fileToRemove);
                $fileToRemove->delete();
            }
        }

        $RelatedFiles = Input::file('product_related_files');
        if(!is_null($RelatedFiles)){
            foreach($RelatedFiles as $relatedFile){
                $File = \App\File::create(['file_name_original' => $relatedFile->getClientOriginalName(), 'file_name' => $relatedFile->getFilename().'.'.$relatedFile->getClientOriginalExtension(), 'mime' => $relatedFile->getMimeType()], File::get($relatedFile));
                $Product->files()->attach($File);
            }
        }

>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        $Product->save();
        return redirect()->route('admin_products', ['status' => 'success','message' => 'Producto Editado']);
    }

    public function delete_product($product_id, Request $request){
        if($request->ajax()) {
            $Product = \App\Product::find($product_id);
            if ($Product == null)
                return response()->json(['status' => 'error', 'message' => "Product no existente"]);

            $Product->delete();
            return response()->json(['status' => 'success', 'message' => "Producto Borrado"]);
        }
        abort(400);
    }
}
