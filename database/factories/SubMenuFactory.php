<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubMenu>
 */
class SubMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Submenu::class;

    public function definition()
    {
        return [
            'menu_id' => \App\Models\Menu::factory(),
            'name' => $this->faker->word(),
            'route' => '/',
            'order' => 0
        ];
    }
}
