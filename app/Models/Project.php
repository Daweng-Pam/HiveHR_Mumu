<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'status',
        'project_manager_id'
    ];


    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'project_employee')->withTimestamps();
    }

    protected static function booted()
    {
        static::saving(function ($project) {
            $project->company_id = auth()->user()->id;
        });
    }
}
