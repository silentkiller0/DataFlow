<?php

namespace Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $permissions = [
            //Invoice Permission
            [
                'id' => 1,
                'display_name' => 'View invoices',
                'name' => 'view_invoices',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Orders Permission
            [
                'id' => 2,
                'display_name' => 'View orders',
                'name' => 'view_orders',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Desadv Permission
            [
                'id' => 3,
                'display_name' => 'View desadv',
                'name' => 'view_desadv',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Partners Permission
            [
                'id' => 4,
                'display_name' => 'View partners',
                'name' => 'view_partners',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'display_name' => 'Edit partners',
                'name' => 'edit_partners',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'display_name' => 'Delete partners',
                'name' => 'delete_partners',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'display_name' => 'Add partners',
                'name' => 'add_partners',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Companies Permission
            [
                'id' => 8,
                'display_name' => 'View societies',
                'name' => 'view_societies',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'display_name' => 'Edit societies',
                'name' => 'edit_societies',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'display_name' => 'Delete societies',
                'name' => 'delete_societies',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 11,
                'display_name' => 'Add societies',
                'name' => 'add_societies',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Siege Permission
            [
                'id' => 12,
                'display_name' => 'View siege',
                'name' => 'view_main_company',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 13,
                'display_name' => 'Edit siege',
                'name' => 'edit_main_company',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 14,
                'display_name' => 'Delete siege',
                'name' => 'delete_main_company',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 15,
                'display_name' => 'Add siege',
                'name' => 'add_main_company',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Users Permission
            [
                'id' => 16,
                'display_name' => 'View users',
                'name' => 'view_users',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 17,
                'display_name' => 'Edit users',
                'name' => 'edit_users',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 18,
                'display_name' => 'Delete users',
                'name' => 'delete_users',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 19,
                'display_name' => 'Add users',
                'name' => 'add_users',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Permissions manager Permission
            [
                'id' => 20,
                'display_name' => 'View permissions',
                'name' => 'view_permissions',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Demat Permission
            [
                'id' => 21,
                'display_name' => 'View demat invoice',
                'name' => 'view_demat_invoice',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Logs Permission
            [
                'id' => 22,
                'display_name' => 'View logs',
                'name' => 'view_logs',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Configurations Permission
            [
                'id' => 23,
                'display_name' => 'View configuration',
                'name' => 'view_configuration',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Downloading files Permission
            [
                'id' => 24,
                'display_name' => 'Download PDF DESADV',
                'name' => 'download_pdf_desadv',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 25,
                'display_name' => 'Download CSV DESADV',
                'name' => 'download_csv_desadv',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 26,
                'display_name' => 'Download EDI DESADV',
                'name' => 'download_edi_desadv',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 27,
                'display_name' => 'Download PDF INVOICE',
                'name' => 'download_pdf_invoice',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 28,
                'display_name' => 'Download CSV INVOICE',
                'name' => 'download_csv_invoice',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 29,
                'display_name' => 'Download EDI INVOICE',
                'name' => 'download_edi_invoice',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 30,
                'display_name' => 'Download PDF ORDER',
                'name' => 'download_pdf_order',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 31,
                'display_name' => 'Download CSV ORDER',
                'name' => 'download_csv_order',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 32,
                'display_name' => 'Download EDI ORDER',
                'name' => 'download_edi_order',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Importation Permission
            [
                'id' => 33,
                'display_name' => 'Importation des partenaires',
                'name' => 'import_partners',
                'can_be_edited' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            
            
        ];

        DB::table('permissions')->insert($permissions);

    }
}
