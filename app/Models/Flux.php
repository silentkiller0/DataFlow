<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Flux extends Model
{
    use HasFactory;

    protected $fillable = [
        'syslog_id','partner_id','company_id','status_id','type_flux','date_document','ref_order','date_order','ref_desadv','date_reception_desadv','ref_invoice','date_invoicing','gln_client','gln_fournisseur','gln_livraison','date_livraison','adresse_livraison','content','status_edi'
    ];


    public function fluxPartner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }
    public function fluxStatus()
    {
        return $this->belongsTo(FluxStatus::class, 'status_id', 'id');
    }
}
