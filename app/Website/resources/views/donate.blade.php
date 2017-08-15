@extends('website::master')

@section('content')
    {{--<header>--}}
        {{--<div class="container">--}}
            {{--<div class="intro-text">--}}
                {{--<div class="intro-lead-in">Associação Beneficiente Luz da Sabedoria</div>--}}
                {{--<div class="intro-heading">O poder que você tem é maior do que imagina!</div>--}}
                {{--<a href="#donate" class="page-scroll btn btn-xl">Nos ajude!</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</header>--}}
    <section class="bg-purple">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Doe com Segurança!</h2>
                    <h3 class="section-subheading text-muted">O poder que você tem é maior do que imagina!</h3>
                    <a href="#donate" class="page-scroll btn btn-xl">Nos ajude!</a>
                </div>
            </div>
        </div>
    </section>
    <section class="col-sm-12" id="donate">
        <donation-form></donation-form>
    </section>
@endsection