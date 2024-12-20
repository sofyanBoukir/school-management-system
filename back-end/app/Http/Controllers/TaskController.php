<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    public function addTask(Request $request){
        try{
            $request->validate([
                "selectedUser" => "integer|exists:users,id",
                "projectId" => "integer|exists:projects,id",
            ]);

            Task::create([
                "title" => $request->title,
                "description" => $request->description,
                "priority" => $request->priority,
                "due_date" => $request->dueDate,
                "project_id" => $request->projectId,
                "assigned_to" => $request->selectedUser,
            ]);

            return response()->json([
                "added" => true,
            ]);

        }catch(Exception $e){
            return response()->json([
                "added" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function getTasks(){
        $user = JWTAuth::parseToken()->authenticate();

        $tasks = Task::SELECT(["id","description","title","due_date","priority","status"])
                        ->where("assigned_to",$user->id)
                        ->latest()
                        ->get();

        if(count($tasks) !== 0){
            return response()->json([
                "tasksExists" => true,
                "tasks" => $tasks,
            ]);
        }
        return response()->json([
            "noTasks" => true
        ]);
    }

    public function editTaskStatus(Request $request){
        try {
            $request->validate([
                "status" => "string|required|in:in progress,completed",
            ]);

            $task = Task::find($request->id);
            $task->status = $request->status;
            $task->save();
            return response()->json([
                "updated" => true,
                "task" => $task,
            ]);

        } catch (Exception $e) {
            return response()->json([
                "updated" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function getAssignedTasks($projectId){
        try {
            $assignedTasks = Task::where("project_id",$projectId)
                            ->with("assignedUser")
                            ->get();
            return response()->json([
                "assignedTasks" => $assignedTasks,
            ]);

        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage(),
            ]);
        }
    }

    public function deleteAssignedTask($taskId){
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $task = Task::where("id",$taskId)->where("assigned_to",$user->id);

            if($task){
                $task->delete();
                return response()->json([
                    "deleted" => true,
                    "message" => "Task deleted successfully!",
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage(),
            ]);
        }
    }
}
