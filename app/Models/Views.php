<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Views extends Model
{
    use HasFactory;

    protected $table = 'views';

    protected $fillable = [
        'post_id',
        'ip_address',
        'mac_address',
        'defualt_lang',
    ];

}
