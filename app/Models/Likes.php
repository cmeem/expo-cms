<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Likes extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'admin_id',
        'user_id',
        'post_id',
        'comments_id',
        'ip_address',
        'mac_address',
        'defualt_lang',
    ];


    // public function post(){

    //     return $this->belongsTo(Post::class);
    // }
    // public function comments(){

    //     return $this->belongsTo(Comments::class);
    // }
}
