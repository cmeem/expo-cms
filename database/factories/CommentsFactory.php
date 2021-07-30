<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'admin_id'=>1,
           'user_id'=>NULL,
           'post_id'=>NULL,
           'comments_id'=>random_int(1,207),
           'writer'=>$this->faker->unique()->name(),
           'status'=>'Approved',
           'content'=>Str::random(200),
           'attachments'=>NULL,
            //
        ];
    }
}
