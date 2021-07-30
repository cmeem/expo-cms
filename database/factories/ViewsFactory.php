<?php

namespace Database\Factories;

use App\Models\Views;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Views::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'=>random_int(169,474),
            'user_id'=>random_int(1,407),
            'ip_address'=>random_int(0,255).'.'.random_int(0,255).'.'.random_int(0,255).'.'.random_int(0,255),
            'mac_address'=>Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2).':'.Str::random(2),
            'defualt_lang'=>'en'
        ];
    }
}
