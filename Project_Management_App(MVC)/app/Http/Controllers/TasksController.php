<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function createtask(){
        $project= Project::where('status','=','In-Process')
        ->select('title','id')
        ->get();

        return view('task.create')->with('project',$project);
    }

    public function submitTask(Request $rq){
        $this->validate($rq,
        [
            't_name'=>'required',
            't_type'=>'required',
            'p_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            't_dis'=>'required',
        ]);

        $task= new Task();
        $task->project_id=$rq->p_id;
        $task->task_name=$rq->t_name;
        $task->type=$rq->t_type;
        $task->deadline_date=$rq->date;
        $task->deadline_time=$rq->time;
        $task->task_dis=$rq->t_dis;
        $task->status="Assigned";
        $task->save();
        return redirect()->route('assign.task');

    }

    public function AssignTask(){

        $task= Task::all();

        return view('task.list')->with('task',$task);


    }

    public function taskGet($id){
        $task= Task::where('id','=',$id)
        ->first();

        return view('task.details')->with('task',$task);
    }

    public function TaskSubmit(Request $rq){
        $p= Task::where('id','=',$rq->id)
        ->first();

        
        $folder="TaskuploadFiles";
        $f_name=$rq->name.time().'.'.$rq->file('attachment')->getClientOriginalExtension();
        $name=$rq->file('attachment')->storeAs($folder,$f_name);
        $p->status="Finished";
        $p->attachment=$name;
        $p->save();

        return redirect()->route('assign.task');
    }
    
}
