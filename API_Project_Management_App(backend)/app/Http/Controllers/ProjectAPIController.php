<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserModel;
use Illuminate\Http\Request;

class ProjectAPIController extends Controller
{
    public function getall()
    {
        $projects = Project::select('title', 'status')->get();
        return response()->json($projects, 200);
    }

    public function CreateProject()
    {
        $member = UserModel::where('positions', '=', 'User')
            ->select('name', 'id')
            ->get();
        return response()->json($member, 200);
    }

    public function SubmitProject(Request $rq)
    {
        $this->validate(
            $rq,
            [
                'p_name' => 'required',
                'p_type' => 'required',
                'p_time' => 'required',
                'p_dis' => 'required',
                'pmember1' => 'required',
                'pmember2' => 'required',
                'pmember3' => 'required',
                'attachment' => 'mimes:doc,docx,pdf'
            ]
        );
        try {
            $folder = "uploadFiles";
            $f_name = $rq->name . time() . '.' . $rq->file('attachment')->getClientOriginalExtension();
            $name = $rq->file('attachment')->storeAs($folder, $f_name);

            $prjct = new Project();
            $prjct->title = $rq->p_name;
            $prjct->type = $rq->p_type;
            $prjct->status = "Open";
            $prjct->duration = $rq->p_time;
            $prjct->user1_id = $rq->pmember1;
            $prjct->user2_id = $rq->pmember2;
            $prjct->user3_id = $rq->pmember3;
            $prjct->discription = $rq->p_dis;
            $prjct->attachment = $name;
            if ($prjct->save()) {

                return response()->json(["msg" => "Created Successfully"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["msg" => "Could not Add Course"], 500);
        }
    }

    public function GetOpenProject()
    {
        $projects = Project::all();
        return response()->json($projects, 200);
    }

    public function Modprojecte($id)
    {

        $project = Project::where('id', '=', $id)
            ->first();

        $head = UserModel::where('positions', '=', 'Head')
            ->select('name', 'id')
            ->get();

        $lead = UserModel::where('positions', '=', 'Lead')
            ->select('name', 'id')
            ->get();
        return response()->json($project, $head, $lead, 200);
        //return view('project.details')->with('project',$project)->with('head',$head)->with('lead',$lead);
    }

    public function ModSubmit(Request $rq)
    {

        $p = Project::where('id', '=', $rq->id)
            ->first();
        try {
            $p->head_id = $rq->p_head;
            $p->lead_id = $rq->p_lead;
            $p->status = "In-Process";
            if ($p->save()) {

                return response()->json(["msg" => "Modify Successfully"], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(["msg" => "Could not Add Course"], 500);
        }
    }

    public function deleteProject($id){
        
        $deleteData = Project::where('id','=',$id)

        ->first();

        $deleteData->delete();

        return response()->json(["msg" => "Delete Successfully"], 200);
    }
}
