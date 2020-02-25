<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'projects_id','website', 'facebook', 'twitter','youtube',
    ];

    public function projects()
    {
      return $this->hasOne(Projects::class);
    }
}
