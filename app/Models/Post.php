<?php

namespace App\Models;

use App\Models\Views;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = array('status','admin_id','admin_username','likes_count','comments_count','views_count','title','category','content','tags','attachments_names','attachments');

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
