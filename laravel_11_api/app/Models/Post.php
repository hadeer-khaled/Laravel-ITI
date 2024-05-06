<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Post extends Model
{
    use HasFactory;
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    protected $fillable = ['title', 'body', 'image','creator_id']; 
}
