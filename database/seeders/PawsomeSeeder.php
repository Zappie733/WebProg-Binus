<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Article;
use App\Models\FavoritePet;
use App\Models\FavoriteArticle;

use Faker\Factory as Faker;

class PawsomeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        //bikin data untuk categories
            //menggunakan query builder dari Laravel.
        \DB::table('categories')->insert([
            'category' => 'Dog',
            'created_at' => now(),
            'updated_at' => now()
        ]);
            //menggunakan model Eloquent 
        Category::create([
            'category' => 'Cat'
        ]);
        Category::create([
            'category' => 'Fish'
        ]);


        //bikin data untuk pets
        $categories = Category::all();

        //$sentences = $faker->sentences(25);
        $sentences = [];
        for ($i = 0; $i < 25; $i++) {
            $sentence = $faker->sentence(15); // +- 15 huruf per baris
            $sentences[] = $sentence;
        }

        $paragraphs = array_chunk($sentences, 5);

        $description = '';

        foreach ($paragraphs as $paragraph) {
            $description .= implode(' ', $paragraph) . "\n\n";
        }

        $defaultImages = ['Dog' => 'dogDefault.jpg','Cat' => 'catDefault.jpg', 'Fish' => 'fishDefault.jpg'];

        foreach ($categories as $category) {
            foreach (range(1, 3) as $index) {
                $name = $category->category . " " . $faker->regexify('[A-Z]{3}');
                Pet::create([
                    'name' => $name,
                    'description' => $description,
                    'totalView' => $faker->numberBetween(100, 1000),
                    'categoryId' => $category->id,
                    'petImage' => $defaultImages[$category->category],
                ]);
            }
        }


        //bikin data untuk articles
        foreach ($categories as $category) {
            foreach (range(1, 6) as $index) {
                $title = "Article " . $category->category . " " . implode(' ', $faker->words(3));
                Article::create([
                    'title' => $title,
                    'description' => $description,
                    'totalView' => $faker->numberBetween(500, 2000),
                    'categoryId' => $category->id,
                    'articleImage' => $defaultImages[$category->category],
                ]);
            }
        }


        //bikin data untuk users 
        //(Admin)
        User::create([
            'username' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'dob' => $faker->date(),
            'gender' => 'male',
            'profilePhoto' => 'admin.jpg',
            'isAdmin' => true
        ]);
        User::create([
            'username' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin123'),
            'dob' => $faker->date(),
            'gender' => 'female',
            'profilePhoto' => 'admin.jpg',
            'isAdmin' => true
        ]);
        //User biasa manual
        User::create([
            'username' => 'User 1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'dob' => $faker->date(),
            'gender' => 'male',
            'profilePhoto' => 'user.jpg',
            'isAdmin' => false
        ]);
        //User biasa
        User::create([
            'username' => $faker->name(),
            'email' => $faker->email(),
            'password' => bcrypt($faker->password()),
            'dob' => $faker->date(),
            'gender' => 'female',
            'profilePhoto' => 'user.jpg',
            'isAdmin' => false
        ]);


        //bikin data untuk favoritePets
        $userAdmins = User::where('username', 'like', '%Admin%')->get();
        $pets = Pet::all();
        foreach($userAdmins as $user){
            foreach($pets as $pet){
                FavoritePet::create([
                    'userId' => $user->id,
                    'petId' => $pet->id
                ]);
            }
        }
        

        //bikin data untuk favoriteArticles
        $articles = Article::all();
        foreach($userAdmins as $user){
            foreach($articles as $article){
                FavoriteArticle::create([
                    'userId' => $user->id,
                    'articleId' => $article->id
                ]);
            }
        }
    }
}

