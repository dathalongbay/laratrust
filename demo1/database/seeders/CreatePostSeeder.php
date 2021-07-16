<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class CreatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $posts = [
            [
                'name'=>'Post name',
                'desc'=>'Post desc',
                'status'=>'1'
            ],
            [
                'name'=>'Post name',
                'desc'=>'Post desc',
                'status'=>'1'
            ],
            [
                'name'=>'Post name',
                'desc'=>'Post desc',
                'status'=>'1'
            ],
            [
                'name'=>'Post name',
                'desc'=>'Post desc',
                'status'=>'1'
            ],
            [
                'name'=>'Post name',
                'desc'=>'Post desc',
                'status'=>'1'
            ]
        ];

        foreach ($posts as $key => $value) {
            Post::create($value);
        }
    }
}
