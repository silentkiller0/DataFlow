<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','name', 'gln', 'adresse', 'description'
    ];


    public function partnerCompany()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
