<?php

namespace App\Http\Controllers;


use App\File;
use App\Mail\ShareFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MeetingsController extends Controller
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
    public function index(Request $request) {
        $RootFolder = \App\Folder::where(['folder_name' => 'meetings'])->get()->first();

        return view('meetings', ['meetings' => $RootFolder]);
    }

    public function download_file($file_id){
        $File = \App\File::find($file_id);
        if($File == null)
            abort(404);

        $fs = Storage::getDriver();
        $stream = $fs->readStream($File->path);


        $this->metricService->publishCounterWithResource('download', $File, Auth::user());

        return response()->stream(
            function() use($stream) {
                fpassthru($stream);
            },
            200,
            [
                'Content-Type' => $File->mime,
                'Content-disposition' => 'attachment; filename="'.$File->file_name_original.'"',
            ]);



        //return Response::download($File->getFileContent(), $File->file_name_original);
    }

    public function get_folder_contents($folder_id, Request $request){
        if($request->ajax()){
            $Folder = \App\Folder::find($folder_id);
            if($Folder == null)
                abort(404);

            return response()->json(['parent_id' => $Folder->parentFolder->id,'folders' => $Folder->folders, 'files' => $Folder->files]);
        }
        abort(400);

    }

    public function share(Request $r)
    {
        if ($r->ajax()) {
            $file = File::find($r->file_id);
            $this->validate($r,[
                'email' => 'email|required'
            ]);
            $comment = $r->exists('comentario') ? $r->comentario : '';

            Mail::to($r->email)->send(new ShareFile($file, $comment));
            $this->metricService->publishCounterWithResource('share', $file, Auth::user());
            return response()->json(['status' => 'success',
                'message' => 'Email enviado!',
                'file_id' => $file->id
            ]);
        }
        abort(400);
    }
}
