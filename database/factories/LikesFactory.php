<?php

namespace Database\Factories;

use App\Models\Likes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Likes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id'=>Null,
            'user_id'=>random_int(0,407),
            'post_id'=>NULL,
            'comments_id'=>random_int(1,499),
            'ip_address'=>random_int(0,255).'.'.random_int(0,255).'.'.random_int(0,255).'.'.random_int(0,255),
            'mac_address'=>Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2),
            'defualt_lang'=>'en',

        ];
    }
}
