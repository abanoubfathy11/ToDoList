<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    //
    protected $table='todolist';
    protected $primarykey=['id'];
    protected $fillable=['id','name','category','image','description'];
    protected $hidden=['created_at','updated_at'];
}
