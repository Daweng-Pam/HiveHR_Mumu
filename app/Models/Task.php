<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_employee',
        'project_id',
        'project_manager',
//        'company_id'
    ];

    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'assigned_employee');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager');
    }

//    public function company()
//    {
//        return $this->belongsTo(User::class, 'company_id');
//    }

    protected static function booted()
    {
        static::saving(function ($task) {
            $task->project_manager = auth()->user()->id;
        });
    }
}
