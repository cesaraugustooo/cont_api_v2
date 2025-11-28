<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function contagemDashboard(Request $request){
        if($request->query('data')){
            $data = Categoria::with(['turmas.contagen'=>function($query) use($request){
                $query->where('data_contagem',$request->query('data'));
            }])->get();
                    
            return DashboardResource::collection($data);
        }

        $data = Categoria::with(['turmas.contagen'=>function($query){
            $query->where('data_contagem',date('Y-m-d'));
        }])->get();
                
        return DashboardResource::collection($data);
    }
}
