<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    } 

    public function sub_tasks()
    {
        return $this->hasMany(SubTask::class);
    }
}
