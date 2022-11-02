<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gfile;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();

        \App\Models\User::factory()->create([
            'name' => 'Htetshine',
            'email' => 'hhz@gmail.com',
            'password' => Hash::make('asdffdsa')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'luffy',
            'email' => 'example@gmail.com',
            'password' => Hash::make('asdffdsa')
        ]);

        $this->call([
            FolderSeeder::class,
            GfileSeeder::class,
        ]);

        // $file = new FileSystem;
        // $file->cleanDirectory('storage/app/public');

        // echo "\e[93mStorage Cleaned \n";
    }
}
