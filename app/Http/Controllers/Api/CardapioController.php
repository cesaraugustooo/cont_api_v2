<?php

namespace App\Http\Controllers\Api;

use App\Models\Cardapio;
use App\Services\FileService;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public $fileService;

    public function __construct(Request $request) {
        $this->fileService = new FileService($request);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cardapios = Cardapio::orderBy('created_at','DESC')->paginate();

        return response()->json($cardapios,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $name = $this->fileService->FileUpload($request);
            
            Cardapio::create([
                'path' => $name
            ]);

            return response()->json(['message'=>'success','path'=>public_path('uploads')."/{$name}"]);
        } catch (Exception $e) {
            return response()->json(['error'=>$e->getMessage()],400);   
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($cardapio)
    {
        $cardapio = Cardapio::whereDate('created_at',$cardapio)->first();

        if(!$cardapio){
            return response()->json(['message'=>'Cardapio não encontrado'],404);
        }

        return response()->json($cardapio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cardapio $cardapio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cardapio $cardapio)
    {
        $cardapio->delete();

        return response()->noContent();
    }
}
