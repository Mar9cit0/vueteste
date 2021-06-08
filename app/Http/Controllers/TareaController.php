<?php

namespace App\Http\Controllers;

use App\Models\tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tarea = Tarea::all(['id','tarea','data','status']);
        return response()->json($tarea);
    }

  
    public function store(Request $request)
    {
        $tarea = Tarea::create($request->post());
        return response()->json([
            'message'=>'Tarea criada com sucesso!!',
            'tarea'=>$tarea
        ]);
    }


    public function show(Tarea $tarea)
    {
        return response()->json($tarea);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $tarea->fill($request->post())->save();
        return response()->json([
            'message'=>'Tarea atualizada com sucesso!!',
            'tarea'=>$tarea
        ]);
    }


    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return response()->json([
            'message'=>'Tarea excluida com sucesso!!'
        ]);
    }
}
