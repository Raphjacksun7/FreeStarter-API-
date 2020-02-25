<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'projects_id','amount', 'title', 'description','image','shipDate','haveToShip',
    ];

    public function projects()
    {
      return $this->hasOne(Projects::class);
    }
}
