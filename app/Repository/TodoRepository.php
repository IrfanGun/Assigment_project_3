<?php

namespace App\Repository;

use App\Models\Todo;
use App\Helper\MongoModel;

class TodoRepository
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }
    public function getAll() : Object 
    {
        $todo = $this->todo->get();
        return $todo;
    }
    public function store($data) : Object
    {
        $dataBaru = new $this->todo;
        $dataBaru->title = $data['title'];
        $dataBaru->author = $data['author'];
        $dataBaru->save();
        return $dataBaru->fresh();
    }

    public function getId($id) 
    {
        $task = $this->todo->find(['_id'=>$id]);
        return $task;
    }

    public function save($id, $geData)
    {
        $task = $this->todo->find(['_id'=>$id]);
        $getValue = $task[0];
        $getValue['author'] = $geData['author'];
        $getValue->save();
        return $getValue;
    }

    public function delete($id)
    {
        $task = $this->todo->find(['_id'=>$id]);
        $getValue = $task[0];
        $getValue->delete();
        return $getValue;
    }
}