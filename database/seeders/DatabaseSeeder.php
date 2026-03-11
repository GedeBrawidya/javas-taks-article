<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Role;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
 
    $allRoles = Role::factory()->count(4)->sequence(
        ['name' => 'super admin'],
        ['name' => 'author'],
        ['name' => 'reader'],
        ['name' => 'partner'],
    )->create();

    $adminRole = $allRoles->where('name', 'super admin');
    $normalRoles = $allRoles->where('name', '!=', 'super admin');

    $categories = Category::factory()->count(5)->create();
    $tags = Tag::factory()->count(10)->create();

    $admin = User::factory()->create([
        'name' => 'Gede Admin',
        'email' => 'admin@example.com',
    ]);
    $admin->roles()->attach($adminRole->pluck('id'));

   User::factory(10)->create()->each(function ($user) use ($normalRoles, $tags, $categories) { 
     $user->roles()->attach(
        collect($normalRoles->random(rand(1,2)))->pluck('id')->toArray()
    );


    Article::factory(3)->create([
        'user_id' => $user->id,
        'category_id' => $categories->random()->id, 
    ])->each(function ($article) use ($tags) {
        $article->tags()->attach(
            $tags->random(rand(1, 3))->pluck('id')
        );
    
        Comment::factory(5)->create([
            'article_id' => $article->id,
            'user_id' => User::inRandomOrder()->first()->id
        ]);
    });
});
}
}
