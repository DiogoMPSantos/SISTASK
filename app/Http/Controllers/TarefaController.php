<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

use function PHPSTORM_META\type;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::with('categorias')->orderBy('data_limite','asc')->get()->toArray();
        return $tarefas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     /**
     * Show the form for creating a new resource.
     */

    public function finishTask($id, $status)
    {   
        if ($status == 'true') {
            $status = true;
        } else {
            $status = false;
        }
        
        $tarefa = DB::table('tarefas')
            ->where('id', $id)
            ->update(['status' => $status]);
            
        return response()->json('Tarefa finalizada com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarefa = new Tarefa([
            'descricao' => $request->input('descricao'),
            'data_limite' => $request->input('data_limite'),
        ]);
        $tarefa->save(); 
        $tarefa->categorias()->attach($request->input('tipo_tarefa')); 
        
        return response()->json('Tarefa criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarefa = Tarefa::with('categorias')->find($id);
        $tarefa['tipo_tarefa']=$tarefa['categorias'][0]->id;
        return response()->json($tarefa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::find($id);
        $tarefa->update($request->except('categorias','tipo_tarefa'));

        $tarefa->categorias()->updateExistingPivot(
            $request['categorias'][0]['id'], ['categoria_id' => $request['tipo_tarefa']],
        );
        
        return response()->json('Tarefa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarefa = Tarefa::find($id);
        $tarefa->delete();

        return response()->json('Tarefa deletada com sucesso');
    }
}
