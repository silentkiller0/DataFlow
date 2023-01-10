@extends('layouts.master')
@section('title', '- Logs')

@section('content')

<section>


                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12 d-flex align-items-stretch" style="height: calc(var(--vh, 1vh) * 100 - 10rem)">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25">Utilisateurs</h2>
                                </div>
                                <div class="card-content" style="overflow-y: auto">
                                    <div class="card-body">
                                        @foreach($Users as $User)
                                            <div class="alert alert-primary mt-1 alert-validation-msg userFrame" style="background-color:#AAD0D2 !important" data-user-id="{{$User->id}}" id="userFrame_{{$User->id}}">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <b>{{$User->firstname}} {{$User->lastname}}</b><br>
                                                        <span style="font-size:11px;color:#fff">Username : {{$User->username}}</span><br>
                                                        <span style="font-size:11px;color:#fff">Siège : {{$User->userCompany->name ?? '...'}}</span>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <i class="fa fa-eye" hidden style="padding-top:60%;padding-bottom:60%;font-size:20px;color:#0E5054"  id="view_eye_{{$User->id}}"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 col-md-12 col-12 d-flex align-items-stretch" style="height: calc(var(--vh, 1vh) * 100 - 10rem)">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25">Logs</h2>
                                </div>
                                <div class="card-content" style="overflow-y: auto">
                                    <div class="card-body" id="logsHeader">
                                        
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                        <tbody id="LogsContent"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</section>


                         



@endsection
@include('includes.logs')