<!doctype html>
<html lang="en">

@include('assets.home.header')

<body data-spy="scroll" data-target=".navbar">

    <!-- ==============================================
    PRELOADER
    =============================================== -->

    <div class="preloader-holder">
        <div class='loader loader1'>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============================================
    HEADER
    =============================================== -->

    <header id="home">

        <!-- /// Navbar /// -->

        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <!-- // Brand // -->

                <a class="navbar-brand" style="width: 30%">
                    <img src="imgs/Dataflow_logo_veresion1.png" style="width:100%">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><i
                        class="material-icons">menu</i></button>
                <div class="collapse navbar-collapse" id="navbarNav" style="width:100%">
                    <!-- / NavLinks / -->

                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#home">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#features">Fonctionnalités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#testimonials">Témoignages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#partenaires">Partenaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#contact">Contact</a>
                        </li>
                        <li>
                            <a style="color:#fff;" href="{{ url('login') }}" class="btn btn-primary">Connexion</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- /// BANNER /// -->
        <div class="banner" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- // Caption // -->
                        <div class="caption">

                            <h1 style="color:#000"><b style="color:#329697">Diriger</b> la révolution de l'EDI</h1>
                            <p class="sub" style="margin-bottom:450px;color:#000000">
                                <b>DataFlow</b>, Votre compagnon d'affaires quotidien
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ==============================================
    ABOUT 
    =============================================== -->
    <section id="features">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-offset-2 text-center mx-auto">
                    <p><b style="color:#329697">DataFlow</b> est une solution de gestion et de superviser des flux EDI conçue pour les entreprises. <br>
                        Elle permet de gérer les échanges de données électroniques de manière efficace, sécurisée et autonome.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-offset-2 text-center mx-auto">
                    <h2 class="section-title">Fonctionnalités</h2>
                </div>
            </div><br><br>
            <div class="row">
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".3s">
                    <i data-vi="graph-poly" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Supervision des flux EDI</h4>
                </div>
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".2s">
                    <i data-vi="layers" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Archivages des messages EDI</h4>
                </div>
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".1s">
                    <i data-vi="doc" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Rapports détaillés</h4>
                </div>
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".1s">
                    <i data-vi="export" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Exportation des messages EDI</h4>
                </div>
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".2s">
                    <i data-vi="building" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Gestions des partenaires/clients</h4>
                </div>
                <div class="col-md-2 wow bounceIn text-center" data-wow-duration=".5s" data-wow-delay=".3s">
                    <i data-vi="shield" data-vi-size="70" data-vi-primary="#16575B" data-vi-accent="#76AEAF" data-vi-prop="#c7c6c3"></i>
                    <h4>Transport sécurisé</h4>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row seconde">
                <div class="col-md-2 wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <img src="imgs/Dataflow_logo_part1.png" class="img-fluid" style="width:100%">
                </div>
                <div class="col-md-10 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".5s">
                        <p><b style="color:#329697">DataFlow</b> automatisent les échanges de données avec vos partenaires commerciaux, réduisant ainsi les erreurs et les retards dans les processus de vente et de livraison. <br>
                                La solution propose un monitoring en temps réel qui permet de suivre l'avancée des flux et de détecter rapidement tout problème éventuel.
                        </p>
                </div>
            </div>
            <div class="row seconde">
                <div class="col-md-7 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".5s">
                    <div class="caption">
                        <h3>Les avantages liés à l’utilisation de la solution</h3><br>
                        <ul class="list-unstyled">
                            <li><i data-vi="check" data-vi-size="40" data-vi-primary="#16575B" data-vi-accent="#329697" data-vi-prop="#CEFAFF"></i>
                                <span>Une réduction des coûts et un gain en terme de temps</span>
                            </li>
                            <li><i data-vi="check" data-vi-size="40" data-vi-primary="#16575B" data-vi-accent="#329697" data-vi-prop="#CEFAFF"></i>
                                <span>Possibilité d’archivage de vos factures</span>
                            </li>
                            <li><i data-vi="check" data-vi-size="40" data-vi-primary="#16575B" data-vi-accent="#329697" data-vi-prop="#CEFAFF"></i>
                                <span>Une amélioration de traitement des informations</span>
                            </li>
                            <li><i data-vi="check" data-vi-size="40" data-vi-primary="#16575B" data-vi-accent="#329697" data-vi-prop="#CEFAFF"></i>
                                <span>La dématérialisation fiscale des factures fait partie des possibilités de la solution</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".2s">
                    <img src="imgs/Dataflow_img.png" class="img-fluid" alt="update">
                </div>
            </div>
        </div>
    </section>




    <!-- ==============================================
    TESTIMONIALS 
    =============================================== -->

    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-offset-2 carousel-container" style="color:#000 !important">
                    <h2 class="section-title">
                        <b style="color:#16575B">DataFlow</b>, vous accompagne au quotidien
                    </h2>
                    <p>
                        De nombreux professionnels font confiance à notre solution pour la supervision de leurs flux EDI et la gestion de leurs partenaires
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-offset-2 carousel-container" style="color:#000 !important">
                    <div id="owl-testimonials" class="owl-carousel owl-theme">
                        <div class="item">
                            <p class="quote">“ Un réel gain dans notre trésorerie. DataFlow est un outil simple et efficace, qui n’engendre aucun coûts supplémentaire. ”</p>
                            <h4>Expert EDI
                            </h4>
                        </div>
                        <div class="item">
                            <p class="quote">“ Une solution complète et fonctionnelle, qui a séduit nos commerciaux. ”
                            </p>
                            <h4>Résponsable EDI</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ==============================================
    VIDEO POP UP 
    ===============================================  -->

   <!-- <div id="video-popup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 video-box">
                    <img src="imgs/video-bg.png" class="img-fluid wow rotateIn" data-wow-duration=".5s"
                        data-wow-delay=".2s" alt="popup">
                    <div class="play-button">
                        <a class="bla-2 wow flipInY" data-wow-duration=".5s" data-wow-delay=".4s" href=""></a>
                        <div class="waves-block">
                            <div class="waves wave-1"></div>
                            <div class="waves wave-2"></div>
                            <div class="waves wave-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

   
    <!-- ==============================================
    BRAND
    =============================================== -->

    <section id="partenaires">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-sm-offset-2 col-md-offset-3 text-center title-container">
                    <h2 class="section-title">Des milliers d'entreprises <b style="color:#329697">nous font confiance</b></h2>
                </div>
            </div>
            <div class="row">
                <div id="owl-brands">
                    <div class="item"><img src="imgs/brands/intermarche.png" class="img-fluid" style="width:40%" alt="intermarche"></div>
                    <div class="item"><img src="imgs/brands/metro.png" class="img-fluid" style="width:40%" alt="metro"></div>
                    <div class="item"><img src="imgs/brands/castorama.png" class="img-fluid" style="width:40%" alt="castorama"></div>
                    <div class="item"><img src="imgs/brands/coca-cola.png" class="img-fluid" style="width:40%" alt="coca-cola"></div>
                    <div class="item"><img src="imgs/brands/carrefour.png" class="img-fluid" style="width:40%" alt="carrefour"></div>
                    <div class="item"><img src="imgs/brands/bricodepot.png" class="img-fluid" style="width:40%" alt="bricodepot"></div>
                    <div class="item"><img src="imgs/brands/auchan.png" class="img-fluid" style="width:40%" alt="auchan"></div>
                    <div class="item"><img src="imgs/brands/sage.png" class="img-fluid" style="width:40%" alt="sage"></div>
                    <div class="item"><img src="imgs/brands/ebp.png" class="img-fluid" style="width:40%" alt="ebp"></div>
                    <div class="item"><img src="imgs/brands/gs1-partenaires.png" class="img-fluid" style="width:40%" alt="gs1-partenaires"></div>
                    <div class="item"><img src="imgs/brands/francefood.png" class="img-fluid" style="width:40%" alt="franefood"></div>
                    <div class="item"><img src="imgs/brands/asiafood.png" class="img-fluid" style="width:40%" alt="asiafood"></div>
                    <div class="item"><img src="imgs/brands/association-laurette-fugain.png" class="img-fluid" style="width:40%" alt="association-laurette-fugain"></div>
                </div>
            </div><br><br>
        </div>
    </section>

    <!-- ==============================================
    FOOTER
    =============================================== -->

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-3 text-center title-container"
                    style="text-align: left !important;color: #000">
                    <br>
                    <h4 style="text-align: left !important">A propos</h4><br>
                    <p style="text-align: left !important;font-size: 14px;color:#fff">
                    <b style="color:#000">DataFlow</b> est une solution commerciale qui vous permettra de superviser vos échanges EDI avec vos clients.<br>
                    La transparence et les gains économiques de cette solution ainsi que sa capacité de superviser vos messages EDI font de cette plateforme un réel atout commercial.

                    </p>
                </div>

                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-3 text-center title-container"
                    style="text-align: left !important;color: #000">
                    <br>
                    <h4 style="text-align: left !important">Liens internes</h4><br>
                    <ul class="m-top-20" style="color:#fff">
                        <li><a href="#home" class="m-top-20" style="color:#fff">Acceuil</a></li>
                        <li><a class="m-top-20" href="#features" style="color:#fff">Fonctionnalités</a></li>
                        <li><a class="m-top-20" href="#testimonials" style="color:#fff">Témoignages</a></li>
                        <li><a class="m-top-20" href="#partenaires" style="color:#fff">Partenaires</a></li>
                        <li><a class="m-top-20" href="#contact" style="color:#fff">Contactez-nous</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-3 text-center title-container"
                    style="text-align: left !important;color: #000">
                    <br>
                    <h4 style="text-align: left !important">Contact</h4><br>
                    <div class="widget_ab_item m-top-30"
                        style="text-align: left !important;font-size: 14px;color:#47aa9b">
                        <div class="item_icon" style="color:#fff"><i class="fa fa-location-arrow"></i> Location <br>
                            <b style="color:#000000">17/19 Bd de la Muette, 95140 Garges les Gonesse, France.</b>
                        </div>
                    </div><br>
                    <div class="widget_ab_item m-top-30"
                        style="text-align: left !important;font-size: 14px;color:#47aa9b">
                        <div class="item_icon" style="color:#fff"><i class="fa fa-phone"></i>
                            Telephone <br>
                            <b style="color:#000000">+33 1 77 62 46 89</b>

                        </div>

                    </div><br>
                    <div class="widget_ab_item m-top-30"
                        style="text-align: left !important;font-size: 14px;color:#47aa9b">
                        <div class="item_icon" style="color:#fff"><i class="fa fa-envelope"></i> Adresse email <br>
                            <b style="color:#000000">Commercial@anexys.fr</b>
                        </div>

                    </div>
                </div>
            </div>
            <br><br>
            <p style="color:#000">&copy; All Right Reserved 2022. DataFlow développer par <a style="color:#000"
                    href="https://BigDataConsulting.fr">Anexys - Big Data Consulting</a></p>
        </div>
    </section>


    @include('assets.home.js')

</body>

</html>