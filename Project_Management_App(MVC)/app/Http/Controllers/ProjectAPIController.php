<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectAPIController extends Controller
{
    //
    public function getall(){
        $projects= Project::select('title','status')->get();
        return $projects;
    }
}
