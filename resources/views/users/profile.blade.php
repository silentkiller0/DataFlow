@extends('layouts.master')
@section('title', '- Profile')

@section('content')

            <section class="horizontal-menu-wrapper">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 d-flex align-items-stretch">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25" data-i18n="userprofile">User profile</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-4 text-center">
                                                <img src="/app-assets/images/Dataflow_profile.png" class="rounded-circle img-border box-shadow-5" alt="Card image" style="width:70%"><br>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert alert-primary" style="background-color:#AAD0D2 !important">
                                                <b style="color:#ffffff;font-size:20px" data-i18n="profiledetails">Account details : </b><br><br>
                                                    @foreach($userDetails as $user)
                                                        <span data-i18n="username">Username</span> :<span> <b>{{$user->username}}</b></span><br>
                                                        <span data-i18n="prenom">Firstname</span> :<span> <b>{{$user->firstname}}</b></span><br>
                                                        <span data-i18n="name">Lastname</span> :<span> <b>{{$user->lastname}}</b></span><br>
                                                        <span>E-mail</span> :<span> <b>{{$user->email}}</b></span><br>
                                                        <span data-i18n="rule">Rule</span> :<span> <b>{{$user->userRule->rule}}</b></span><br>
                                                        <span data-i18n="siegecp">Head office</span> :<span> <b>{{$user->userCompany->name}}</b></span><br><br>
                                                        <span data-i18n="lastconnection" style="color:green">Last connexion</span> :<span> <b>{{$user->last_connection}}</b></span><br>

                                                    @endforeach
                                                </div>
                                                <div class="alert alert-primary" style="background-color:#AAD0D2 !important">
                                                    <b style="color:#ffffff;font-size:20px" data-i18n="Partner">Partenaires :</b><br><br>
                                                    <b data-i18n="nbrpartnersattached">Number of partners attached to your head office : <b>{{$PartnersCount}}</b></b>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
            </section>

@endsection
