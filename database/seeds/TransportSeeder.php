<?php

namespace Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transports = [
            [
                'transport_type' => 'AS2',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'transport_type' => 'X400',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'transport_type' => 'sFTP',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
             [
                'transport_type' => 'FTP',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('transports')->insert($transports);
    }
}
