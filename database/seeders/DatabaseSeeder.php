<?php

namespace Database\Seeders;

use App\Models\Flat;
use Database\Factories\CategoryFactory;
use Database\Factories\CommentFactory;
use Database\Factories\FlatFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = UserFactory::new()->create();

        FlatFactory::new()->count(10)->create([
            'user_id' => $user->id,
        ]);

        CommentFactory::new()->count(10)->create([
            'user_id' => $user->id,
            'flat_id' => fn () => Flat::inRandomOrder()->first()->id,
        ]);

        CategoryFactory::new()->count(10)->create();
    }
}
