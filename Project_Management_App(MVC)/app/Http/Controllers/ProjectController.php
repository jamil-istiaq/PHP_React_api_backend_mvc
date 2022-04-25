<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserModel;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function project(){
        return view('project.list');
    }

    public function CreateProject(){
        $member= UserModel::where('positions','=','User')
        ->select('name','id')
        ->get();

        return view('project.create')
        ->with('member',$member);
    }

    public function SubmitProject(Request $rq){
        $this->validate($rq,
    [
        'p_name'=>'required',
        'p_type'=>'required',
        'p_time'=>'required',
        'p_dis'=>'required',
        'pmember1'=>'required',
        'pmember2'=>'required',
        'pmember3'=>'required',
        'attachment'=>'mimes:doc,docx,pdf'
    ]);
    
    $folder="uploadFiles";
    $f_name=$rq->name.time().'.'.$rq->file('attachment')->getClientOriginalExtension();
    $name=$rq->file('attachment')->storeAs($folder,$f_name);

    $prjct= new Project();
    $prjct->title=$rq->p_name;
    $prjct->type=$rq->p_type;
    $prjct->status="Open";
    $prjct->duration=$rq->p_time;
    $prjct->user1_id=$rq->pmember1;
    $prjct->user2_id=$rq->pmember2;
    $prjct->user3_id=$rq->pmember3;
    $prjct->discription=$rq->p_dis;
    $prjct->attachment=$name;
    $prjct->save();
    return redirect()->route('open.project');
    }

    public function openproject(){
        $projects=Project::all();
        return view('project.list')->with('projects',$projects);
    }

    public function Modprojecte($id){
        
        $project= Project::where('id','=',$id)
        ->first();
        
        $head= UserModel::where('positions','=','Head')
        ->select('name','id')
        ->get();

        $lead=UserModel::where('positions','=','Lead')
        ->select('name','id')
        ->get();

        return view('project.details')->with('project',$project)->with('head',$head)->with('lead',$lead);
    }

    public function ModSubmit(Request $rq){
        
        $p= Project::where('id','=',$rq->id)
        ->first();

        $p->head_id=$rq->p_head;
        $p->lead_id=$rq->p_lead;
        $p->status="In-Process";
        $p->save();

        return redirect()->route('open.project');

    }


    // public function finishproject(){
    //     return view('project.list');
    // }

   
}
