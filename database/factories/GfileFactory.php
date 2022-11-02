<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $filetypes = ['png','jpg','svg','csv','zip','txt','mp4','rar'];


            return [
                'fileName' => fake()->text($maxNbChars = 10) .Arr::random($filetypes),
                'folder_id' => $folderId,
                'user_id' => $userId->id,
            ];
    }
}
