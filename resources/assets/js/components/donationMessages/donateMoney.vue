<template>
    <div>
        <div class="text-center">
            <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post" target="_blank">
                <input type="hidden" name="currency" value="BRL" />
                <input type="hidden" name="receiverEmail" value="associacaoluzdasabedoria@gmail.com" />
                <input type="hidden" name="iot" value="button" />
                <!--<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/209x48-doar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />-->
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
</template>
