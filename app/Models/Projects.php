<?php

namespace App\Models;

use App\Models\Contributors;
use App\Models\Users;
use App\Models\Rewards;
use App\Models\BankStatuses;
use App\Models\ProjectDetails;
use App\Models\Communities;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id','title', 'category', 'current_budget','budget','contributors_number','duration','progression','contact','valider',
    ];


    public function users()
    {
      return $this->belongsTo(Users::class);
    }

    public function project_details()
    {
      return $this->hasOne(ProjectDetails::class);
    }

    public function rewards()
    {
      return $this->hasMany(Rewards::class);
    }

    public function bank_statuses()
    {
      return $this->hasOne(BankStatuses::class);
    }

    public function contributors()
    {
      return $this->hasMany(Contributors::class);
    }

    public function communities()
    {
      return $this->hasOne(Communities::class);
    }

}
