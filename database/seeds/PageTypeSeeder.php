<?php

use Illuminate\Database\Seeder;
use App\PageType;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pageTypes = [
            [
                "name" => "Youtube Video"
            ],
            [
                "name" => "Website"
            ],
            [
                "name" => "Youtube Channel"
            ]
        ];

        PageType::insert($pageTypes);
    }
}
