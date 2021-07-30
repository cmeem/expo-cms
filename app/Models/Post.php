<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable =[
        'status',
        'admin_id',
        'admin_username',
        'title',
        'category',
        'likes_count',
        'comments_count',
        'views_count',
        'content',
        'tags',
        'attachments_names',
        'attachments'
    ];
    // public function likes(){

    //     return $this->hasMany(Likes::class);
    // }
    // public function comments(){

    //     return $this->hasMany(Comments::class);
    // }
    // public function views(){

    //     return $this->hasMany(Views::class);
    // }

}
