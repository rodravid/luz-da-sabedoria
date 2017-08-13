<template>
    <div class="col-md-8 col-sm-offset-2 col-sm-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Nos ajude!</h2>
                <h3 class="section-subheading" style="margin-bottom: 0px;">Sua doação é muito importante para nós.</h3>
            </div>
        </div>

        <div class="form-group" style="padding: 12px;">
            <div class="funkyradio" style="height: 50px;">
                <div class="col-sm-12 col-md-offset-2 col-md-3 text-center funkyradio-theme">
                    <input type="radio" name="donation-type" v-model="donationType" value="time" id="donateTime" />
                    <label for="donateTime"> Tempo</label>
                </div>
                <div class="col-sm-12 col-md-3 text-center funkyradio-theme">
                    <input type="radio" name="donation-type" v-model="donationType" value="partner" id="partner" />
                    <label for="partner">Parcerias</label>
                </div>
                <div class="col-sm-12 col-md-3 text-center funkyradio-theme">
                    <input type="radio" name="radio" id="radio6" />
                    <input type="radio" name="donation-type" v-model="donationType" value="money" id="donateMoney" />
                    <label for="donateMoney">Bens</label>
                </div>
            </div>
            <!--<div class="col-sm-12 col-md-offset-2 col-md-3 text-center">-->
            <!--<input type="radio" name="donation-type" v-model="donationType" value="time" id="donateTime"> <label for="donateTime"> Tempo</label>-->
            <!--</div>-->
            <!--<div class="col-sm-12 col-md-3 text-center">-->
            <!--<input type="radio" name="donation-type" v-model="donationType" value="partner" id="partner"> <label for="partner">Parcerias</label>-->
            <!--</div>-->
            <!--<div class="col-sm-12 col-md-3 text-center">-->
            <!--<input type="radio" name="donation-type" v-model="donationType" value="money" id="donateMoney"> <label for="donateMoney">Bens</label>-->
            <!--</div>-->
        </div>

        <transition name="fade">
            <div v-show="donationType == 'money'">
                <div class="text-center">
                    <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="POST">
                        <input type="hidden" name="currency" value="BRL" />
                        <input type="hidden" name="receiverEmail" value="digo.david.oliveira@gmail.com" />
                        <input type="hidden" name="iot" value="button" />
                        <!--<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/120x53-doar-azul.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />-->
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-default btn-block" name="submit"
                                   value="Doe pelo PagSeguro" style="height: 50px;" />
                        </div>
                    </form>
                </div>

                <div class="col-sm-12 text-center">
                    <h3>OU</h3>
                    <h3 class="section-subheading" style="margin: -6px 0px 15px 0px;">Entre em contato.</h3>
                </div>
            </div>
        </transition>

        <form name="sentMessage" id="contactForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Seu nome *" id="name" required
                               data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Seu Email *" id="email" required
                               data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" placeholder="Seu telefone *" id="phone" required
                               data-validation-required-message="Please enter your phone number.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Sua mensagem *" id="message" required
                                  data-validation-required-message="Por favor deixe um recado."></textarea>
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
<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .35s
    }
    .fade-enter, .fade-leave-to {
      opacity: 0
    }

</style>
<script>
    export default{
        data(){
            return{
                donationType: "time"
            }
        }
    }

</script>
