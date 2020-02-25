<?php

namespace App\Models;

use App\Models\Projects;
use App\Models\Rewards;
use Illuminate\Database\Eloquent\Model;

class Contributors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id','projects_id','rewards_id',
    ];




    public function projects()
    {
      return $this->hasMany(Projects::class);
    }
    public function rewards()
    {
      return $this->hasMany(Rewards::class);
    }
}
