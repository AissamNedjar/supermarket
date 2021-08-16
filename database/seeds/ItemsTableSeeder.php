<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'user_id' => 1,
            'name' => "رقم",
            'price' => "0",
            'barcode' => "0",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $file = file_get_contents('json.php');
        $code = json_decode($file, true);

        foreach ($code['Sheet'] as $value) {
            DB::table('items')->insert([
                'user_id' => 1,
                'name' => $value['Désignation'],
                'price' => "0",
                'barcode' => $value['Code Barre'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
