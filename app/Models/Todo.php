<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Todo extends Model
{
   protected $connection = 'mongodb';
   protected $collection = 'todo';
   protected $fillable = ['title', 'author'];

  
}
