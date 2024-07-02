<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $nim = $this->faker->unique()->numerify('########');
        return [
            'name' => $this->faker->name,
            'email' => $nim . '@gmail.com',
            'password' => Hash::make($nim),
        ];
    }
}
