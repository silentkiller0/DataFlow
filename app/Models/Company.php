<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'maincompany_id','name', 'email', 'telephone', 'website', 
    ];


    public function societyPartner()
    {
        return $this->hasOne(Partner::class, 'company_id', 'id');
    }


}
