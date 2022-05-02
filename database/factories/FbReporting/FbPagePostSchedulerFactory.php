<?php

namespace Database\Factories\FbReporting;

use App\Models\FbReporting\FbPagePostScheduler;
use Illuminate\Database\Eloquent\Factories\Factory;

class FbPagePostSchedulerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FbPagePostScheduler::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'page_groups' => json_encode(['Group 1']),
            'start_date' => $this->faker->dateTime('tomorrow')
        ];
    }
}
