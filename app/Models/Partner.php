<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'email',
        'deskription',
        'phone',
        'address',
        'logo',
        'status',
        'approved_at',
        'rejected_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ads() {
        return $this->hasMany(Ad::class);
    }
}