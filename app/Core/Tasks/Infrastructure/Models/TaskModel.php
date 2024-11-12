<?php

namespace App\Core\Tasks\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['name', 'description', 'start_date', 'end_date'];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
