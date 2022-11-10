<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coins')->insert([
            [
                'name' => 'Bitcoin',
                'symbol' => 'btc',
                'coingecko_id' => 'bitcoin'
            ],[
                'name' => 'Ethereum',
                'symbol' => 'eth',
                'coingecko_id' => 'ethereum'
            ],[
                'name' => 'Cardano',
                'symbol' => 'cda',
                'coingecko_id' => 'cardano'
            ],[
                'name' => 'Tether',
                'symbol' => 'ttr',
                'coingecko_id' => 'tether'
            ]
        ]);

        DB::table('users')->insert([
                'name' => 'user',
                'email' => 'user@user.nl',
                'password' => Hash::make('password')
        ]);

        DB::table('transactions')->insert([
                [
                'user_id' => '1',
                'coin_id' => '1',
                'price' => '17809',
                'amount' => '00.1',
                'type' => 'buy'
                ],[
                'user_id' => '1',
                'coin_id' => '2',
                'price' => '1324',
                'amount' => '00.1',
                'type' => 'buy'
                ],[
                'user_id' => '1',
                'coin_id' => '3',
                'price' => '1',
                'amount' => '1',
                'type' => 'buy'
                ],[
                'user_id' => '1',
                'coin_id' => '4',
                'price' => '0.30',
                'amount' => '1',
                'type' => 'buy'
                ]
        ]);
    }
}
