<?php

namespace Database\Factories;

use App\Models\Awards;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Awards>
 */
class AwardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = Awards::class;

    public function definition()
    {
        return [
            'awards_type' => $this->faker->text,
            'awards_agency' => $this->faker->company,
            'awards_title' => $this->faker->text,
            'awards_recipients' => $this->faker->name,
            'awards_sponsor' => $this->faker->company,
            'awards_event' => $this->faker->address,
            'awards_place' => $this->faker->address,
            'awards_date' => $this->faker->date,
            
        ];
    }
}
