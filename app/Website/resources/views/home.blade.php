@extends('website::master')

@section('content')
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Associação Beneficiente Luz da Sabedoria</div>
                <div class="intro-heading">Você é mais forte do que imagina!</div>
                <a href="#values" class="page-scroll btn btn-xl">Saiba como ajudar!</a>
            </div>
        </div>
    </header>
    
    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Alguns de nossos projetos</h2>
                    <h3 class="section-subheading text-muted">Conheça um pouco mais sobre os nossos projetos.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset_web('img/portfolio/roundicons.png') }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>CDAP</h4>
                        {{--<p class="text-muted">Graphic Design</p>--}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset_web('img/portfolio/startup-framework.png') }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Creche</h4>
                        {{--<p class="text-muted">Website Design</p>--}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset_web('img/portfolio/startup-framework.png') }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Creche</h4>
                        {{--<p class="text-muted">Website Design</p>--}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{ asset_web('img/portfolio/roundicons.png') }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Maria Socorro</h4>
                        {{--<p class="text-muted">Graphic Design</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section id="about" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Sobre nós</h2>
                    <h3 class="section-subheading text-muted">Conheça um pouco mais sobre a nossa história.</h3>
                </div>
            </div>
            <p class="large text-muted text-center">
                A Associação Luz da Sabedoria completa {{ Carbon\Carbon::now()->diffInYears(Carbon\Carbon::createFromFormat('Y', '1988')) }} anos em {{ Carbon\Carbon::now()->format('Y') }}.
                Com o intuito de ajudar crianças e suas famílias, nossa missão principal é cultivar sonhos nas vidas dos menores que muitas vezes vivem uma realidade que não os permite terem
                esperanças de um futuro saudável. Após anos de experiência, queremos não só oferecer o básico (como alimentação e vestimenta), mas também oferecer inspiração.
            </p>
            <p class="large text-muted text-center">
                Dessa maneira, nossa Associação, além de cuidar das crianças, dá suporte a seus responsáveis pois conta com assistente social,
                advogado e psicóloga, uma vez que muitas famílias possuem alguma fragilidade interna e não possuem oportunidades de acolhida em outro lugar.
            </p>
            <p class="large text-muted text-center">
                Queremos ser a transformação que essas famílias precisam para trazer uma juventude mais saudável e com sonhos.
            </p>
        
        </div>
    </section>
    
    <!-- Services Section -->
    <section id="values">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Institucional</h2>
                    <h3 class="section-subheading text-muted">Conheça um pouco mais sobre o que nos motiva.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="service-heading">Visão</h4>
                    <p class="text-muted">Ajudar crianças e suas famílias e dae suporte a seus responsáveis pois conta com assistente social,
                        advogado e psicóloga</p>
                </div>
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-thumb-tack fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="service-heading">Missão</h4>
                    <p class="text-muted">Cultivar sonhos nas vidas dos menores que muitas vezes vivem uma realidade que não os permite terem esperanças de um futuro saudável.</p>
                </div>
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-pagelines fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="service-heading">Valores</h4>
                    <p class="text-muted">Queremos ser a transformação que essas famílias precisam para trazer uma juventude mais saudável e com sonhos.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Team Section -->
    <section id="team" class="bg-light-gray img-ceter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nossa equipe</h2>
                    <h3 class="section-subheading text-muted">Conheça mais sobre os protagonistas da nossa história.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-offset-2 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/1.jpg') }}" class="img-responsive img-circle" alt="">
                        <h4>Rosa</h4>
                        <p class="text-muted">Lead Designer</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/2.jpg') }}" class="img-responsive img-circle" alt="">
                        <h4>Carlos</h4>
                        <p class="text-muted">Lead Marketer</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Clients Aside
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>-->
    
    
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Ajude-nos</h2>
                    <h3 class="section-subheading cor-saiba-mais">Com a sua ajuda poderemos ajudar mais crianças!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Seu nome *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Seu Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Seu telefone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Sua mensagem *" id="message" required data-validation-required-message="Por favor deixe um recado."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Enviar mensagem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection