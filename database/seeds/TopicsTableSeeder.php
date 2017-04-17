<?php

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $user = User::find(1);

        $topics = factory(Topic::class)->times(rand(100, 200))->make()->each(function ($topic) use ($faker, $user) {
            $topic->user_id = 1;
            $topic->category_id = 1;
            $topic->is_excellent = rand(0, 1) ? 'yes' : 'no';
        });
        Topic::insert($topics->toArray());
    }
}
