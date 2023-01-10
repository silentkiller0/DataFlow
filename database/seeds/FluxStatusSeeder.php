<?php

namespace Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FluxStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $FluxStatus = [
            [
                'status' => 'Success',
                'color' => '#03c9a9',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'status' => 'Error',
                'color' => '#f22613',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('flux_statuses')->insert($FluxStatus);    
    }
}
