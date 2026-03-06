<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Class Role extends Model {

    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users() : BelongsToMany {
        return $this->belongsToMany
        (User::class);
    }
}