<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFluxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fluxes', function (Blueprint $table) {
            $table->id('id');
            $table->integer('syslog_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('type_flux')->nullable();
            $table->dateTime('date_document');
            $table->string('ref_order')->nullable();
            $table->dateTime('date_order');
            $table->string('ref_desadv')->nullable();
            $table->dateTime('date_reception_desadv');
            $table->string('ref_invoice')->nullable();
            $table->dateTime('date_invoicing');
            $table->string('gln_client')->nullable();
            $table->string('gln_fournisseur')->nullable();
            $table->string('gln_livraison')->nullable();
            $table->dateTime('date_livraison');
            $table->string('adresse_livraison')->nullable();
            $table->string('content')->nullable();
            $table->string('status_edi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fluxes');
    }
}
