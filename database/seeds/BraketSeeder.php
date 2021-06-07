<?php

use Illuminate\Database\Seeder;

class BraketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brakets')->insert([
            'name' => 'Metálicos',
        ]);
        DB::table('brakets')->insert([
            'name' => 'Zafiro',
        ]);
        DB::table('brakets')->insert([
            'name' => 'Cerámica',
        ]);
        DB::table('brakets')->insert([
            'name' => 'Resina, policarbonato y plástico',
        ]);
        DB::table('brakets')->insert([
            'name' => 'Invisible',
        ]);

    }
}
