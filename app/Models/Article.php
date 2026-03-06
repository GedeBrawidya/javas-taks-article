<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Article extends Model {

    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'category_id',
        'user_id',
        'featured_image'
    ];

    public function tags() : BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    
}