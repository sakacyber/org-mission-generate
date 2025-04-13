<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'role',
        'department_id',
        'notes',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function missions(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'missions_people', 'people_id', 'mission_id');  
    }
}
