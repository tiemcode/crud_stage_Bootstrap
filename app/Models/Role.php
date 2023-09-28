<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, "project_user");
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class, 'project_user');
    }
    protected $fillable = ['name'];
}
