<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model {
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'title',
        'description',
        'image',
        'url',
        'position',
        'link',
        'status',
    ];

    public function partner () {
        return $this->belongsTo(Partner::class);
    }
}