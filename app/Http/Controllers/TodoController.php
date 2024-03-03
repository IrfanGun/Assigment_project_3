<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoServices;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoServices $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getTodoList()
    {
        $user = Auth::user();
        try
        {
            $result = $this->todoService->getAll();
        } catch (Exception $e) {
            $result =
            [
                'status' => 500,
                'error' => $e->getMessage()
            ];

        }

        return response()-> json(
            $result
        );
    }

    public function addTodo(Request $request)
    {
        $user = Auth::user();
        $data = $request->only(['title', 'author']);
        // $data = $request->only(['author']);

        $result = ['status' => 201];

        try {
            $result['data'] = $this->todoService->store($data);
        } catch (Exception $e)
        {
            $result = 
            [
                'status' => '422',
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result,$result['status']);
    }

    public function update(Request $request) {
        // $request->validate([
        //     'task_id' => 'required|string',
        //     'title' => 'string,'
        // ]);

        $taskId = $request->post('task_id');
        $formData = $request->only(['title', 'author']);
       
        $getTask = $this->todoService->inputData($taskId, $formData);

        return response()->json(
            $getTask
        );
    }

    public function delete(Request $request) {
        $taskId = $request->post('task_id');
        $deleteId = $this->todoService->deleteData($taskId);

        return response()->json(
            ['message' => "delete data is success"]
        );

    }
}
