<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTaskRequest;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function show(Project $project = null)
    {
        $tasks = ProjectTask::with('project')->when(!empty($project), fn($q) => $q->where('project_id', $project->id))
            ->orderBy('priority')->get();
        $projects = Project::orderBy('title')->get();
        return view('tasks', compact('tasks', 'project','projects'));
    }

    public function createView(){
        $projects = Project::orderBy('title')->get();
        return view('task/create',compact('projects'));
    }

    public function create(SaveTaskRequest $request){
        $inputs = $request->validated();
        ProjectTask::create($inputs);
        return back()->with('status','Task Created Successfully');
    }

    public function updateView(ProjectTask $task){
        $projects = Project::orderBy('title')->get();
        return view('task/update',compact('task','projects'));
    }

    public function update(ProjectTask $task, SaveTaskRequest $request){
        $inputs = $request->validated();
        $task->update($inputs);
        return redirect()->route('home')->with('status','Updated');
    }

    public function delete(ProjectTask $task){
        $task->delete();
        return back()->with('status','Deleted Successfully');
    }

    public function updatePriority(Request $request){
        $inputs = $request->validate(['task'=>['required'],'target_pos'=>['required']]);
        $task = ProjectTask::findOrFail($inputs['task']);
        $target_pos = ProjectTask::findOrFail($inputs['target_pos']);
        $task->priority = $target_pos->priority;
        $task->save();
        return response('updated',200);
    }
}
