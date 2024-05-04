<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Cviebrock\EloquentSluggable\Sluggable;

use Spatie\Tags\HasTags;

class Post extends Model
{

    use HasFactory;
    // use HasTags;
    use Sluggable;
    use SoftDeletes;
    use HasTags;
    protected $fillable = [
        'title', 'body','image',"posted_by"
    ];
    public function sluggable(): array
    {
        return [
            'title_slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
