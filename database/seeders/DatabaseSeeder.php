<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->admin()->has(
            Post::factory()->count(3)
        )->create();

        $users = User::factory(9)->has(
            Post::factory()->count(3)
        )->create()->push($admin);

        $posts = Post::all();

        $posts->each(function ($post) use ($users) {
            for ($i = 0; $i < 5; $i++) {
                $user = $users->random();
                Comment::factory()->for($post)->for($user, 'author')->create();
            }

            for ($i = 0; $i < 10; $i++) {
                $user = $users->random();
                $user->likes()->attach($post);
            }

            for ($i = 0; $i < 10; $i++) {
                $user = $users->random();
                $user->bookmarks()->attach($post);
            }
        });
    }
}
