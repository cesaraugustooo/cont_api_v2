<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function contagemDashboard(){
        $data = Categoria::with(['turmas.contagen'=>function($query){
            $query->where('data_contagem',date('Y-m-d'));
        }])->get();
                
        return DashboardResource::collection($data);
    }
}
