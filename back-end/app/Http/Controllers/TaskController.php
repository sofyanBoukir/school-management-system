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
            // $request->validate([
            //     "status" => "string|required|in:in progess,completed",
            // ]);
            return response()->json([
                "task status" => $request->status,
                "task id" => $request->id,
            ]);
            $task = Task::find($request->id);
            $task->status = $request->status;
            $task->save();
            return response()->json([
                "updated" => true,
            ]);

        } catch (Exception $e) {
            return response()->json([
                "updated" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
