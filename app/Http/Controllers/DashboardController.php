<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function contagemDashboard(){
        $data = Categoria::with(['turmas.contagen'])->get();

        return DashboardResource::collection($data);
    }
}
