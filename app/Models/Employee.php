<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = ['name', 'salary'];

    public function workTimes(): HasMany
    {
        return $this->hasMany(WorkTime::class, 'emp_id');
    }

    // public function getTotalHoursAttribute()
    // {
    //     return $this->workTimes()->sum('hours');
    // }

    // public function getTotalCostAttribute()
    // {
    //     $hourlyRate = $this->salary / 160; 
    //     return $this->total_hours * $hourlyRate;
    // }
}
