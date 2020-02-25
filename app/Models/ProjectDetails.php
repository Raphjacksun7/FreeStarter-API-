<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'projects_id','localisation', 'image', 'video','slogan','description','target',
    ];

    public function projects()
    {
      return $this->hasOne(Projects::class);
    }
}
