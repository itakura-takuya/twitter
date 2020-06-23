<?php

use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //ユーザーID、つぶやき内容
      DB::table('tweets')->insert([
          ['user_id' => '1','tweet' => 'つぶやき１'],
          ['user_id' => '2','tweet' => 'つぶやき２'],
          ['user_id' => '3','tweet' => 'つぶやき３'],
          ['user_id' => '4','tweet' => 'つぶやき４'],
          ['user_id' => '5','tweet' => 'つぶやき５'],
          ['user_id' => '1','tweet' => 'つぶやき１−２'],
          ['user_id' => '2','tweet' => 'つぶやき２−２'],
          ['user_id' => '3','tweet' => 'つぶやき３−３'],
          ['user_id' => '1','tweet' => 'つぶやき１−３']
      ]);
    }
}
