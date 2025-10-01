<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImage(Request $request){
        $request->validate([
            'file'=>'required|max:2000',  
        ]);
        
        $file = $request->file('file');
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'),$name);

        return response()->json(['message'=>'success','path'=>$name]);
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
