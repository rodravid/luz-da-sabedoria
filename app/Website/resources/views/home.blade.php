@extends('website::master')

@section('nav-items')
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden">
            <a href="#page-top"></a>
        </li>
        <li>
            <a class="page-scroll" href="#portfolio">Projetos</a>
        </li>
        <li>
            <a class="page-scroll" href="#about">Sobre nós</a>
        </li>
        <li>
            <a class="page-scroll" href="#values">Valores</a>
        </li>
        <li>
            <a class="page-scroll" href="#team">Nossa equipe</a>
        </li>
        <li>
            <a class="page-scroll" href="#contact">Contato</a>
        </li>
        <li>
            <a class="page-scroll" href="/donate">Doe com segurança!</a>
        </li>
    </ul>
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Associação Beneficiente Luz da Sabedoria</div>
                <div class="intro-heading">Você é mais forte do que imagina!</div>
                <a href="{{ route('donate') }}" class="page-scroll btn btn-xl">Saiba como ajudar!</a>
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
                @foreach($projects as $project)
                    <div class="col-md-3 col-sm-6 portfolio-item">
                        <a href="{{ sprintf("#project_%s_%s", $project->getId(), $project->getTitle()) }}" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <div style="width: 100%;height: 190px;margin-bottom: 5px;overflow: hidden; @if(! $project->hasBanner())background: url(images/bg-nots.png) center center no-repeat #d4d4d4; @endif">
                                @if($project->hasBanner())
                                    <img src="{{ $project->getBanner()->getWebPath() }}" class="img-responsive" width="100%">
                                @endif
                            </div>
                        </a>
                        <div class="portfolio-caption">
                            <h4>{{ $project->getTitle() }}</h4>
                            <p class="text-muted">{{ $project->getSubtitle() }}</p>
                        </div>
                    </div>
                @endforeach
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
                A Associação Luz da Sabedoria
                completa {{ Carbon\Carbon::now()->diffInYears(Carbon\Carbon::createFromFormat('Y', '1988')) }} anos
                em {{ Carbon\Carbon::now()->format('Y') }}.
                Com o intuito de ajudar crianças e suas famílias, nossa missão principal é cultivar sonhos nas vidas dos
                menores que muitas vezes vivem uma realidade que não os permite terem
                esperanças de um futuro saudável. Após anos de experiência, queremos não só oferecer o básico (como
                alimentação e vestimenta), mas também oferecer inspiração.
            </p>
            <p class="large text-muted text-center">
                Dessa maneira, nossa Associação, além de cuidar das crianças, dá suporte a seus responsáveis pois conta
                com assistente social,
                advogado e psicóloga, uma vez que muitas famílias possuem alguma fragilidade interna e não possuem
                oportunidades de acolhida em outro lugar.
            </p>
            <p class="large text-muted text-center">
                Queremos ser a transformação que essas famílias precisam para trazer uma juventude mais saudável e com
                sonhos.
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
                    <p class="text-muted">Ajudar crianças e suas famílias e dae suporte a seus responsáveis pois conta
                        com assistente social,
                        advogado e psicóloga</p>
                </div>
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-thumb-tack fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="service-heading">Missão</h4>
                    <p class="text-muted">Cultivar sonhos nas vidas dos menores que muitas vezes vivem uma realidade que
                        não os permite terem esperanças de um futuro saudável.</p>
                </div>
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-pagelines fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="service-heading">Valores</h4>
                    <p class="text-muted">Queremos ser a transformação que essas famílias precisam para trazer uma
                        juventude mais saudável e com sonhos.</p>
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
                    <h3 class="section-subheading text-muted">Conheça mais sobre os protagonistas da nossa
                        história.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/erma_mayumi.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Érika Mayume Ozahata</h4>
                        <p class="text-muted" style="margin-bottom: 0px">Diretora do Cei Cantinho da Tia Isaura</p>
                        <p class="text-muted" style="margin-bottom: 0px">Licenciada em Pedagogia</p>
                        <p class="text-muted" style="margin-bottom: 0px">Pós Graduada em Educação Infatil</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/adriana.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Adriana Jerónimo de Araújo</h4>
                        <p class="text-muted" style="margin-bottom: 0px">Coordenadora no CEI cantinho da Tia Isaura</p>
                        <p class="text-muted" style="margin-bottom: 0px">Licenciada em Pedagogia</p>
                        <p class="text-muted" style="margin-bottom: 0px">Pós Graduada em psicopedagogia</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/jessica_sayuri.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Jessica Sayuri Ozahata</h4>
                        <p class="text-muted" style="margin-bottom: 0px">Auxiliar administrativa no CEI Cantinho da tia Isaura</p>
                        <p class="text-muted" style="margin-bottom: 0px">Estudante de Pedagogia</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/estalamar.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Estalamar Monteiro da Costa</h4>
                        <p class="text-muted" style="margin-bottom: 0px">Diretora do CEI Luz da Sabedoria</p>
                        <p class="text-muted" style="margin-bottom: 0px">Licenciada em Pedagogia</p>
                        <p class="text-muted" style="margin-bottom: 0px">Autora do livro: "O Lápis Preto"</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/rita_cassia.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Rita de Cassia da Silva Barros</h4>
                        <p class="text-muted">Coordenadora do CEI Luz da Sabedoria</p>
                        <p class="text-muted">Licenciada em Pedagogia</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="team-member">
                        <img src="{{ asset_web('img/team/breatriz_martins.jpeg') }}" class="img-responsive img-circle" alt="" style="width: 360px; height: 360px;">
                        <h4>Beatriz Silva Martins</h4>
                        <p class="text-muted" style="margin-bottom: 0px">Aux. Adimistrativo no CEI Luz da Sabedoria</p>
                        <p class="text-muted" style="margin-bottom: 0px">Estudante de pedagogia e Matemática</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"></p>
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
                    <div class="col-lg-12 text-center">
                        <div id="success"></div>
                        <a href="{{ route('donate') }}" class="btn btn-xl">Saiba como agora!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->
    @foreach($projects as $project)
        <div class="portfolio-modal modal fade" id="{{ sprintf("project_%s_%s", $project->getId(), $project->getTitle()) }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2>{{ $project->getTitle() }}</h2>
                                    <p class="item-intro text-muted">{{ $project->getSubtitle() }}</p>
                                    @if($project->hasBanner())
                                        <img class="img-responsive img-centered"
                                             src="{{ $project->getBanner()->getWebPath() }}" alt="">
                                    @endif
                                    <p>
                                        {!! $project->getDescription() !!}
                                    </p>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Fechar projeto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection