<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public $fileService;

    public function __construct(Request $request) {
        $this->fileService = new FileService($request);
    }

    public function uploadImage(Request $request){
        try {
            $name = $this->fileService->FileUpload($request);
    
            return response()->json(['message'=>'success','path'=>$name]);            
        } catch (Exception $e) {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    public function uploadPdf(Request $request){
        $request->validate([
            'file'=>'required|max:20000|mimes:pdf',  
        ]);
        
        $file = $request->file('file');
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/pdf'),$name);

        return response()->json(['message'=>'success','path'=>$name]);
    }
}
