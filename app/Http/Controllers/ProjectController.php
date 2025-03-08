<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
        return response()->json(['message' => 'All proejects data', 'projects' => Project::all()]);
    }

    public function saveProject(ProjectRequest $request)
    {

        $project = Project::insert($request->all());

        return response()->json(['message' => 'Project info saved successfully', 'project' => $project]);
    }

    public function getProject($id)
    {

        $project = Project::find($id);

        if ($project) {
            return response()->json(['message' => 'Project info fetched successfully', 'project' => $project]);
        }

        return response()->json(['message' => 'Unable to find Project.', 'project' => null]);

    }

    public function updateProject(ProjectRequest $request, $id)
    {

        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Unable to find Project.', 'project' => null]);
        }
        $project->name = $request->name;
        $project->status = $request->status;
        $project->update();

        return response()->json(['message' => 'Project info updated successfully', 'project' => $project]);

    }

    public function deleteProject($id)
    {
        $project = Project::find($id);

        if (! $project) {
            return response()->json(['message' => 'Unable to find Project.', 'project' => null]);
        }

        $project->delete();

        return response()->json(['message' => 'Project info deleted successfully']);
    }
}
