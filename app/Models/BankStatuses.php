<?php

namespace App\Models;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Model;

class BankStatuses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'projects_id','profil', 
    ];



    public function projects()
    {
      return $this->hasOne(Projects::class);
    }
}