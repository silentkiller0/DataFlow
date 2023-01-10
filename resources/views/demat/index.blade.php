@extends('layouts.master')
@section('title', '- Demat Invoice')

@section('content')

<!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25">Facture démat</h2>
                                </div>
                                
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>Assistant démat interactive des factures</p>
                                        <div class="alert alert-danger">
                                        <p>
                                        - Choisissez un fichier depuis votre ordinateur en cliquant sur le bouton 'Parcourir'. Le fichier doit être à la norme EDIFACT D96A.<br>
                                        - Attention, le fichier ne doit pas dépasser 100ko.<br>
                                        - Cliquez ensuite sur 'Valider' pour passer à l'étape suivante.<br>
                                        </p>
                                        </div>
                                        <div action="#" class="number-tab-steps wizard-circle">
                                        <br><br>
                                            <!-- Step 1 -->
                                            <h6>Charger le fichier EDI</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-12 dropzone dropzone-area">
                                                        <div class="dz-message">Glisser votre fichier ici (Facture, D96A)</div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6>Contrôle du fichier EDI</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit temporibus molestias, est sunt consequatur, eos, autem odio illo labore rerum dolore voluptatem minus velit veniam corporis amet mollitia? Beatae, atque!
                                                    
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 3 -->
                                            <h6>Voir la source EDI</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam amet adipisci suscipit aliquid! Temporibus est dicta voluptatum, nam totam eaque quam aspernatur odit tenetur hic placeat a. Magni, officia aperiam.
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 4 -->
                                            <h6>Voir le rondu</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum corrupti blanditiis sunt iste eos nemo, est perferendis voluptatem enim qui ducimus, doloribus tempora consequatur necessitatibus nulla nisi sint voluptates quam.
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
@endsection
