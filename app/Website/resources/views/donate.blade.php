@extends('website::master')

@section('content')
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Associação Beneficiente Luz da Sabedoria</div>
                <div class="intro-heading">O poder que você tem é maior do que imagina!</div>
                <a href="#donate" class="page-scroll btn btn-xl">Nos ajude!</a>
            </div>
        </div>
    </header>
    <section class="col-sm-12" id="contact">
        <donation-form></donation-form>
    </section>
@endsection