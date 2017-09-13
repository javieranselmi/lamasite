<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContentNotificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends AdminController
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

    private function getRootMeetingsFolder(){
        $RootMeetingsFolder = \App\Folder::where(['name' => 'Meetings'])->get()->first();
        if($RootMeetingsFolder == null)
            $RootMeetingsFolder = \App\Folder::create(['name' => 'Meetings']);

        return $RootMeetingsFolder;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $RootMeetingsFolder = $this->getRootMeetingsFolder();
        return view('admin.meetings.meetings_categories_list', ['meetings_root_folder' => $RootMeetingsFolder]);
    }

    public function create_folder(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'meetings_folder_name' => 'required|unique_folder_name',
                'meetings_parent_folder_id' => 'required|exists:folders,id'
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'message' =>'Error inesperado. Intente mas tarde', 'errors' => $validator->errors()], 500);
            }

            $Folder = \App\Folder::create(['name' => Input::get('meetings_folder_name'), 'folder_id' => Input::get('meetings_parent_folder_id')]);

            return response()->json(['status' => 'success', 'message' => 'Creado Satisfactoriamente', 'folder' => $Folder]);
        }
        abort(400);
    }

    public function create_file(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'meetings_file' => 'required',
                'meetings_parent_folder_id' => 'required|exists:folders,id'
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'message' =>'Error inesperado. Intente mas tarde', 'errors' => $validator->errors()], 500);
            }

            $FileUpload = $request->file('meetings_file');

            $File = \App\File::create(['file_name_original' => $FileUpload->getClientOriginalName(), 'file_name' => $FileUpload->getFilename().'.'.$FileUpload->getClientOriginalExtension(), 'mime' => $FileUpload->getMimeType(), 'folder_id' => Input::get('meetings_parent_folder_id')], File::get($FileUpload));

            dispatch(new SendContentNotificationEmail(null, true));
            return response()->json(['status' => 'success', 'message' => 'Creado Satisfactoriamente', 'file' => $File]);
        }
        abort(400);
    }

    public function edit_folder($folder_id, Request $request){
        if($request->ajax()){
            $Folder = \App\Folder::find($folder_id);
            if ($Folder == null){
                return response()->json(['status' => 'error', 'message' => 'Carpeta No Encontrada'], 404);
            }

            $validator = Validator::make($request->all(), [
                'meetings_folder_name' => 'required|unique_folder_name'
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'message' =>'Error inesperado. Intente mas tarde', 'errors' => $validator->errors()], 500);
            }

            $Folder->name = Input::get('meetings_folder_name');
            $Folder->save();

            return response()->json(['status' => 'success', 'message' => 'Editado Satisfactoriamente', 'folder' => $Folder]);
        }
        abort(400);
    }

    public function create_category(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'meetings_category_name' => 'required|unique_folder_name'
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 500);
            }

            $RootMeetingsFolder = $this->getRootMeetingsFolder();

            $CategoryFolder = \App\Folder::create(['name' => Input::get('meetings_category_name'), 'folder_id' => $RootMeetingsFolder->id]);

            return response()->json(['status' => 'success', 'message' => 'Categoria Creada', 'category_folder' => $CategoryFolder]);
        }
        abort(400);
    }

    public function edit_category($category_folder_id, Request $request){
        if($request->ajax()) {
            $CategoryFolder = \App\Folder::find($category_folder_id);
            if ($CategoryFolder == null){
                return response()->json(['status' => 'error', 'message' => 'Categoria No Encontrada'], 404);
            }

            $validator = Validator::make($request->all(), [
                'meetings_category_name' => 'required|unique_folder_name'
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'message' => "Hubo un error inesperado. Intente mas tarde." ,'errors' => $validator->errors()], 500);
            }

            $CategoryFolder->name = Input::get('meetings_category_name');
            $CategoryFolder->save();

            return response()->json(['status' => 'success', 'message' => 'Categoria Editada', 'category_folder' => $CategoryFolder]);
        }
        abort(400);
    }

    public function delete_category($category_folder_id, Request $request){
        if($request->ajax()) {
            $CategoryFolder = \App\Folder::find($category_folder_id);
            if ($CategoryFolder == null)
                return response()->json(['status' => 'error', 'message' => "Categoria no existente"], 404);

            $CategoryFolder->delete();
            return response()->json(['status' => 'success', 'message' => "Categoria Borrada"]);
        }
        abort(400);
    }

    public function delete_folder($folder_id, Request $request){
        if($request->ajax()) {
            $Folder = \App\Folder::find($folder_id);
            if ($Folder == null)
                return response()->json(['status' => 'error', 'message' => "Carpeta no existente"], 404);

            $Folder->delete();
            return response()->json(['status' => 'success', 'message' => "Carpeta Borrada"]);
        }
        abort(400);
    }

    public function delete_file($file_id, Request $request){
        if($request->ajax()) {
            $File = \App\File::find($file_id);
            if ($File == null)
                return response()->json(['status' => 'error', 'message' => "Archivo no existente"], 404);

            $File->delete();
            return response()->json(['status' => 'success', 'message' => "Archivo Borrado"]);
        }
        abort(400);
    }

    public function get_contents(Request $request){
        if($request->ajax()) {
            $folder_id = Input::get('folder_id');
            $Folder = \App\Folder::find($folder_id);
            if ($Folder == null)
                return response()->json(['status' => 'error', 'message' => "Carpeta no existente"], 404);

            $ChildFolders = [];
            $ChildFiles = [];
            foreach($Folder->folders as $FolderChild){
                $ChildFolders[]['id'] = 'folder_'.$FolderChild->id;
                $ChildFolders[count($ChildFolders)-1]['text'] = $FolderChild->name;
                $ChildFolders[count($ChildFolders)-1]['type'] = 'folder';
                $ChildFolders[count($ChildFolders)-1]['children'] = $FolderChild->folders->count() > 0 || $FolderChild->files->count() > 0;
            }

            foreach($Folder->files as $FilesChild){
                $ChildFiles[]['id'] = 'file_'.$FilesChild->id;
                $ChildFiles[count($ChildFiles)-1]['text'] = $FilesChild->file_name_original;
                $ChildFiles[count($ChildFiles)-1]['type'] = 'file';
                $ChildFiles[count($ChildFiles)-1]['children'] = false;
            }


            $Children = array_merge($ChildFolders, $ChildFiles);
            $FolderType = ($Folder->parentFolder && $Folder->parentFolder->parentFolder && $Folder->parentFolder->parentFolder->folder_name == 'meetings' ? 'root' : 'folder');

            $childrenOnly = Input::get('children_only');
            $output = [];

            if($childrenOnly){
                $output = $Children;
            }else{
                $output = [['id' => 'folder_'.$folder_id, 'text' => $Folder->name, 'children' => $Children, 'type' => $FolderType]];
            }

            return response()->json($output);

        }
        abort(400);
    }

}
