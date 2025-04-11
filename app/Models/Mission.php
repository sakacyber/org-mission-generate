<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal',
        'place',
        'start_date',
        'end_date',
        'signature_date',
        'notes',
    ];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'missions_people', 'mission_id','people_id');
    }

}
