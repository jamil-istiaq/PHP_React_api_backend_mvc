<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskAPIController extends Controller
{
    public function createtask()
    {
        $project = Project::where('status', '=', 'In-Process')
            ->select('title', 'id')
            ->get();
        return response()->json($project, 200);
    }

    public function submitTask(Request $rq)
    {
        $this->validate(
            $rq,
            [
                't_name' => 'required',
                't_type' => 'required',
                'p_id' => 'required',
                'date' => 'required',
                'time' => 'required',
                't_dis' => 'required',
            ]
        );
        try {
            $task = new Task();
            $task->project_id = $rq->p_id;
            $task->task_name = $rq->t_name;
            $task->type = $rq->t_type;
            $task->deadline_date = $rq->date;
            $task->deadline_time = $rq->time;
            $task->task_dis = $rq->t_dis;
            $task->status = "Assigned";
            if ($task->save()) {

                return response()->json(["msg" => "Submit Successfully"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["msg" => "Could not Processed"], 500);
        }
    }
    public function AssignTask()
    {
        $task = Task::all();
        return response()->json($task, 200);
    }

    public function taskGet($id)
    {
        $task = Task::where('id', '=', $id)
            ->first();
        return response()->json($task, 200);
    }

    public function TaskSubmit(Request $rq)
    {
        $p = Task::where('id', '=', $rq->id)
            ->first();
        try {
            $folder = "TaskuploadFiles";
            $f_name = $rq->name . time() . '.' . $rq->file('attachment')->getClientOriginalExtension();
            $name = $rq->file('attachment')->storeAs($folder, $f_name);
            $p->status = "Finished";
            $p->attachment = $name;
            if ($p->save()) {

                return response()->json(["msg" => "Submit Successful"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["msg" => "Could not Processed"], 500);
        }
    }

    public function deleteTask($id){
        
        $deleteData = Task::where('id','=',$id)

        ->first();

        $deleteData->delete();

        return response()->json(["msg" => "Delete Successfully"], 200);
    }
}
