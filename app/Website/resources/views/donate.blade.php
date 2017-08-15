@extends('website::master')

@section('content')
    <section class="bg-purple">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Doe com Segurança!</h2>
                    <h3 class="section-subheading text-muted">O poder que você tem é maior do que imagina!</h3>
                    <a href="#contact" class="page-scroll btn btn-xl">Nos ajude!</a>
                </div>
            </div>
        </div>
    </section>
    <section class="col-sm-12" id="contact">
        <donation-form></donation-form>
    </section>
@endsection