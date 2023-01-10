@include('assets.header')
@include('assets.auth_css')
@section('title', '- Login')

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-0 py-0" style="
                                    min-width:380px; 
                                    height:100%; 
                                    background-image: url('../../../imgs/Dataflow_img.png')!important;
                                    background-position: center!important;
                                    background-size: cover!important;"
                                >
                                </div>
                                <div class="col-lg-6 col-12 p-0" style="background-color: #fff;">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Authentification</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Bienvenue, veuillez vous connecter à votre compte</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1 mb-2" >
                                                <form class="mb-2"  method="POST" action="{{ route('login') }}">
                                                @csrf
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Nom d'utilisateur</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Mot de passe</label>
                                                    </fieldset>
                                                    <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" name="remember">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Se souvenir de moi</span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-end mt-2">
                                                        <!-- Session Status -->
                                                        <x-auth-session-status class="mb-2" :status="session('status')" />

                                                        <!-- Validation Errors -->
                                                        <x-auth-validation-errors class="mb-2" :errors="$errors" />
                                                     </div>

                                                    <div class="flex items-center justify-end mt-2">
                                                        @if (Route::has('password.request'))
                                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                                {{ __('Mot de passe oublié ?') }}
                                                            </a>
                                                        @endif
                                                        <button type="submit" class="btn btn-primary float-right btn-inline" style="width:100%">S'authentifier</button><br>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
</body>
@include('assets.auth_js')
