<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Menu::class;
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'icon' => 'fas fa-folder', // Default icon
            'route' => null,
            'order' => 0
        ];
    }
}
