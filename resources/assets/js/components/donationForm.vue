<template>
    <div class="col-md-8 col-sm-offset-2 col-sm-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Nos ajude!</h2>
                <h3 class="section-subheading" style="margin-bottom: 0px;">Sua doação é muito importante para nós.</h3>
            </div>
        </div>

        <div class="row" style="padding: 12px;">
            <div class="col-sm-12">
                <div class="funkyradio" style="height: auto;">
                    <div class="col-sm-12 col-md-offset-2 col-md-3 text-center funkyradio-theme">
                        <input type="radio" name="donation-type" v-model="donationType" value="donate-time" id="donateTime" />
                        <label for="donateTime"> Tempo</label>
                    </div>
                    <div class="col-sm-12 col-md-3 text-center funkyradio-theme">
                        <input type="radio" name="donation-type" v-model="donationType" value="be-partner" id="partner" />
                        <label for="partner">Parcerias</label>
                    </div>
                    <div class="col-sm-12 col-md-3 text-center funkyradio-theme">
                        <input type="radio" name="radio" id="radio6" />
                        <input type="radio" name="donation-type" v-model="donationType" value="donate-money" id="donateMoney" />
                        <label for="donateMoney">Bens</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding: 12px;height: auto;">
            <div class="col-sm-12">
                <transition name="component-fade" mode="out-in">
                    <component :is="donationType"></component>
                </transition>
            </div>
        </div>

        <form name="sentMessage" id="contactForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h4 class="">Nome:</h4>
                        <input type="text" class="form-control" placeholder="Seu nome *" id="name" required
                               data-validation-required-message="Por favor, insira seu nome.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <h4 class="">Email:</h4>
                        <input type="email" class="form-control" placeholder="Seu Email *" id="email" required
                               data-validation-required-message="Por favor, insira seu e-mail.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <h4 class="">Telefone:</h4>
                        <input type="tel" class="form-control" placeholder="Seu telefone *" id="phone" required
                               data-validation-required-message="Por favor, insira seu telefone.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h4 class="">Mensagem:</h4>
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
    .component-fade-enter-active, .component-fade-leave-active {
        transition: all .3s ease;
    }
    .component-fade-enter, .component-fade-leave-to {
        transform: translateX(10px);
        opacity: 0;
    }

</style>
<script>
    import BePartner from './donationMessages/bePartner.vue'
    import DonateMoney from './donationMessages/donateMoney.vue'
    import DonateTime from './donationMessages/donateTime.vue'

    export default{
        components: {
            bePartner: BePartner,
            donateMoney: DonateMoney,
            donateTime: DonateTime
        },
        data(){
            return{
                donationType: "donate-time"
            }
        }
    }

</script>
