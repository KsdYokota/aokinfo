<?php

use Illuminate\Database\Seeder;
use App\Item;


class UserSupportsTableSeeder extends Seeder
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
                'title'=>'ユーザーサポート情報',
                'item_type'=>'user_support',
                'date'=>\Carbon\Carbon::now(),
            ]
        );
    }
}
