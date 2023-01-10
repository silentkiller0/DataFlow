<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mainCompany extends Model
{
    use HasFactory;
    public function siegeCompanies()
    {
        return $this->hasOne(Company::class, 'maincompany_id', 'id');
    }

}
