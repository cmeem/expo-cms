<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = array('admin_id','user_id','post_id','comments_id','writer','status','content','attachments');


}
