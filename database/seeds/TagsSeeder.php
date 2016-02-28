<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strftimeFormat = '%Y-%m-%d %H:%M:%S';
        $createdAt = date('Y-m-d H:i:s'); // Y-m-d H:i:s
        $tags = array(
            [
                'name' => 'Edu',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ],
            [
                'name' => 'Fun',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ],
            [
                'name' => 'RNG',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ],
            [
                'name' => 'Discussion',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ],
        );
        App\Tag::insert($tags);
    }
}
