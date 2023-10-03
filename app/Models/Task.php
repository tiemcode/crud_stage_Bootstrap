<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'task_user');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class, 'task_user');
    }
}
