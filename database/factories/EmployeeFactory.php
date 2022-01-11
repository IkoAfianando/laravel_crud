<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->streetName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'post' => $this->faker->jobTitle(),
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}
