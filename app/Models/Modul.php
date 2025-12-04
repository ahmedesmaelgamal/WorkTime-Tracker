<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modul extends Model
{
    protected $fillable = ['name'];
    public function workTimes(): HasMany
    {
        return $this->hasMany(WorkTime::class,'modul_id');
    }
}
