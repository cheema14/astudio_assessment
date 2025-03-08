<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const STATUS_SELECT = [
        'New' => 'New',
        'Active' => 'Active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributes()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
