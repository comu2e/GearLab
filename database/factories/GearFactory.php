<?php

namespace Database\Factories;

use App\Models\Gear;
use Illuminate\Database\Eloquent\Factories\Factory;

class GearFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gear::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gear_name'  => $this->faker->sentence(),
            'gear_category'  => $this->faker->sentence(),
            'user_id'  => $this->faker->randomDigit,
            'maker_name'  => $this->faker->sentence(),
            'updated_at'  => $this->faker->time(),
            'content' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            ];
    }
}
