<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SidebarMenu extends Model {


    public $timestamps = false;
    protected $table = 'sidebar_menu';

    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'icon',
        'order',
        'permission'
    ];


}
