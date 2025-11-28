<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;

class FileService
{
    public $file;

    public function __construct($request) {
        $this->file = $request->file('file');
    }

    public function FileUpload($request){
        try{
            $request->validate([
                'file'=>'required|max:20000',  
            ]);
            
            $file = $request->file('file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'),$name);

            return $name;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}