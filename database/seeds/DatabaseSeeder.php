<?php

// use Database\TruncateTable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RulesSeeder;
use Database\Seeders\TransportSeeder;
use Database\Seeders\TypeDocumentSeeder;
use Database\Seeders\FluxStatusSeeder;
use Database\Seeders\UserPermissionsSeeder;





class DatabaseSeeder extends Seeder
{
    // use TruncateTable;


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PermissionsSeeder::class);
        $this->call(RulesSeeder::class);
        $this->call(TransportSeeder::class);
        $this->call(TypeDocumentSeeder::class);
        $this->call(FluxStatusSeeder::class);        
        $this->call(UserPermissionsSeeder::class);        
        
    }
}
