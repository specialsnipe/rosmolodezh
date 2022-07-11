<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roles = Role::all();
        $roles_ids = [];
        foreach ($roles as $role) {
            $roles_ids[] = $role->id;
        }

        $genders = Gender::all();
        $genders_ids = [];
        foreach ($genders as $gender) {
            $genders_ids[] = $gender->id;
        }
        $occupations = Occupation::all();
        $occupations_ids = [];
        foreach ($occupations as $occupation) {
            $occupations_ids[] = $occupation->id;
        }

        return [
            'login' => fake()->name(),
            'first_name' => fake()->firstName(),
            'email' => fake()->safeEmail(),
            'last_name' => fake()->lastName(),
            'father_name' => fake()->firstNameMale() . 'вич',
            'role_id' => $roles_ids[array_rand($roles_ids)],
            'gender_id' => $genders_ids[array_rand($genders_ids)],
            'occupation_id' => $occupations_ids[array_rand($occupations_ids)],
            'avatar' => 'default_avatar.jpg',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
