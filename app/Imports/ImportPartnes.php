<?php

namespace App\Imports;

use App\Models\Partner;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class ImportPartnes implements ToModel
{

    public function  __construct($company_id)
    {
        $this->company_id= $company_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        try {
            $check = Partner::where('gln','=',$row[1])->get();
            if($check->isEmpty()){
                $Partner = new Partner([
                "company_id" => $this->company_id,
                "name" => $row[0],
                "gln" => $row[1],
                "adresse" => $row[2] ?? "",
                "description" => $row[3] ?? "",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ]);
            return $Partner;
        }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
