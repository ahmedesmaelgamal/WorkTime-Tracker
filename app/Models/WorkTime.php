<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WorkTime extends Model
{
 protected $fillable = ['date', 'hours', 'emp_id', 'project_id', 'modul_id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'emp_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function modul(): BelongsTo
    {
        return $this->belongsTo(Modul::class,'modul_id');
    }
}
