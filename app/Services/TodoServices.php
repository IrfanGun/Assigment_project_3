<?php

namespace App\Services;

use App\Repository\TodoRepository;
use MongoDB\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class TodoServices 
{
    protected $todoRepository ;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $todo = $this->todoRepository->getAll();

        return $todo;
    }

    public function store($data) : Object
    {
        $validator = Validator::make(
            $data,
            [
                'title' => "required",
                'author' => "required"
            ]
            );

            if($validator->fails())
            {
                throw new InvalidArgumentException($validator->error()->first());
            }
            
            $result = $this->todoRepository->store($data);
            return $result;
    }

    public function getById($Idnumber) {
        $task = $this->todoRepository->getId($Idnumber);
        return $task;
    }

    public function inputData($taskId, array $getData)
    {
       

        $id = $this->todoRepository->save($taskId, $getData);
        return $id;
    }
    
    public function deleteData($id)
    {
        $keyData = $this->todoRepository->delete($id);
        return $id;
    }
    
}