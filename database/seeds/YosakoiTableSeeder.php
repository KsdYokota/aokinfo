<?php

use Illuminate\Database\Seeder;
use App\Item;


class YosakoiTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Item::create(
            [
                'title'=>'AOKよさこい通信',
                'item_type'=>'yosakoi',
                'date'=>\Carbon\Carbon::now(),
            ]
        );
    }
}
