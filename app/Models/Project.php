<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $table = "projects";
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class, 'project_user')->withPivot('role_id');
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'project_user');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    protected $fillable = ['name', 'intro', 'description'];
}
