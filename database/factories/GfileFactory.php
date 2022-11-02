<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gfile>
 */
class GfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $folderId = Folder::inRandomOrder()->first();
        $userId = User::findOrFail($folderId->user_id);
        return [
            'fileName' => fake()->word,
            'folder_id' => $folderId,
            'user_id' => $userId->id,

        ];
    }
}
