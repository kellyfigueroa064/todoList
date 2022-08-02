<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
Use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['users'])->paginate(10);
        return view('index')->with('tasks', $tasks);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tasks = new Task;

        $tasks->descripcion = $request->description;
        $tasks->due_date = $request->dateform;
        $tasks->user_id = $request->user_id;

        $tasks->save();
        Session::flash('message','Tarea creada correctamente');
        return redirect('/');
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
        //
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

        $task = Task::find($id);
        $alternarEstado = $task->estado;
        //Alterno el estado
        $alternarEstado = 1 - $alternarEstado;

        $task->update(['estado'=>$alternarEstado]);
        if($alternarEstado == 1){
            Session::flash('message','Tarea completada');
        }else{
            Session::flash('message','Tarea desmarcada');
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        Session::flash('message','Tarea borrada correctamente');
         return redirect('/');
    }
}
