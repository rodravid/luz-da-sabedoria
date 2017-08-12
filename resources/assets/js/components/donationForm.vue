<template>
    <div class="col-md-8 col-md-offset-2 col-sm-offset-0 col-sm-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Nos ajude!</h2>
                <h3 class="section-subheading">Sua doação é muito importante para nós.</h3>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 col-md-offset-2 col-md-3 text-center">
                <input v-model="donationType" type="radio" name="donation-type" value="1"> <span> Tempo</span>
            </div>
            <div class="col-sm-12 col-md-3 text-center">
                <input v-model="donationType" type="radio" name="donation-type" value="2"> <span>Parcerias</span>
            </div>
            <div class="col-sm-12 col-md-3 text-center">
                <input v-model="donationType" type="radio" name="donation-type" value="3"> <span>Bens</span>
            </div>
        </div>

        <div class="text-center" v-show="donationType == 3">
            <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
                <input type="hidden" name="currency" value="BRL" />
                <input type="hidden" name="receiverEmail" value="digo.david.oliveira@gmail.com" />
                <input type="hidden" name="iot" value="button" />
                <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/120x53-doar-azul.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
            </form>
        </div>

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
</template>
<script>
    export default{
        data(){
            return{
                donationType: 1
            }
        }
    }
</script>
