<template>
    <div class="col-xs-12" id="containerProductsFilters">
        <div class="well panel panel-primary">
            <h4 class="panel-heading">Adicionar produtos</h4>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0 0 30px;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="selectProducts">Selecione o(s) produto(s):</label>
                                <p>
                                    <select selectProducts name="name" class="form-control input-sm select-filter" multiple style="width: 100%">
                                        <option v-for="(product, id) in filters.products" :value="id">{{ product }}</option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p>
                                    <a href="javascript: void(0);" v-on:click="searchSelected()" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                                        Adicionar produto(s)
                                    </a>
                                    <small id="messageAddProductShowcase"></small>
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px;">
                                <label for="name">Ou adicione a partir dos filtros:</label>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectCountries">Países</label>
                                        <select selectCountries name="selectCountries" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(country, id) in filters.countries" :value="id">{{ country }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectRegions">Regiões</label>
                                        <select selectRegions name="selectRegions" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(region, id) in filters.regions" :value="id">{{ region }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectProducers">Produtores</label>
                                        <select selectProducers name="selectProducers" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(producer, id) in filters.producers" :value="id">{{ producer }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectTypes">Tipos de vinho</label>
                                        <select selectTypes name="selectTypes" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(type, id) in filters.productTypes" :value="id">{{ type }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectPromotions">Promoções</label>
                                        <select selectPromotions name="selectPromotions" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(promotion, id) in filters.promotions" :value="id">{{ promotion }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-3 col-lg-6" style="margin-top: 15px;">
                                        <label for="selectShowcases">Vitrines</label>
                                        <select selectShowcases name="selectShowcases" class="form-control input-sm select-filter" multiple style="width: 100%">
                                            <option v-for="(showcase, id) in filters.showcases" :value="id">{{ showcase }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px;">
                                <button class="btn btn-info" v-on:click.prevent="searchFromFilters()">Adicionar produtos dos filtros selecionados</button>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px;">
                                <label>Você ainda pode:</label><br/>
                                <button class="btn btn-info" v-on:click.prevent="searchAll()">Adicionar todos produtos do site</button>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px;">
                                <label>Ou se preferir importar de uma planilha excel:</label><br/>

                                <div class="btn btn-info" dropzone-files>
                                    Selecionar arquivo...
                                    <div id="uploadPreview"></div>
                                    <div class="upload-progress pull-left"
                                         style="width: 100%; display: none;">
                                        <div class="progress mgTop15">
                                            <div class="progress-bar"
                                                 role="progressbar"
                                                 id="uploadProgress"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div id="upload-message" class="mgTop15"
                                         style="float: left; display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default{
        props: {
            basePath: {
                type: String,
                required: true
            },
            filtersEndpoint: {
                type: String,
                required: true
            }
        },
        data: function () {
            return {
                productsToAdd: [],
                filters: {},
                selectProducts: '[selectProducts]',
                selectCountries: '[selectCountries]',
                selectRegions: '[selectRegions]',
                selectProducers: '[selectProducers]',
                selectTypes: '[selectTypes]',
                selectPromotions: '[selectPromotions]',
                selectShowcases: '[selectShowcases]'
            }
        },
        mounted(){
            var $self = this;

            $self.selectProducts = $($self.selectProducts).removeAttr('selectProducts');
            $self.selectCountries = $($self.selectCountries).removeAttr('selectCountries');
            $self.selectRegions = $($self.selectRegions).removeAttr('selectRegions');
            $self.selectProducers = $($self.selectProducers).removeAttr('selectProducers');
            $self.selectTypes = $($self.selectTypes).removeAttr('selectTypes');
            $self.selectPromotions = $($self.selectPromotions).removeAttr('selectPromotions');
            $self.selectShowcases = $($self.selectShowcases).removeAttr('selectShowcases');

            $self.$http.get($self.filtersEndpoint).then(function(response) {
                $self.filters = response.data;

                $self.selectProducts.select2({placeholder: "Selecione os produtos"});
                $self.selectCountries.select2({placeholder: "Selecione os países"});
                $self.selectRegions.select2({placeholder: "Selecione as regioes"});
                $self.selectProducers.select2({placeholder: "Selecione os produtores"});
                $self.selectTypes.select2({placeholder: "Selecione os tipos de vinho"});
                $self.selectPromotions.select2({placeholder: "Selecione as promoções"});
                $self.selectShowcases.select2({placeholder: "Selecione as vitrines"});

                $('.select-filter')
                .parent()
                .find('.select2-selection__rendered, .select2-search, .select2-search__field')
                .css('width', '100%');

            });

            $self.initDropzone();
        },
        methods: {
            searchSelected() {
                let $select = this.selectProducts;
                let productsToAdd = [];

                $.each($select.val(), function (index, value) {
                    let $option = $select.find("option[value='" + value + "']");

                    productsToAdd.push({
                        'id': $option.val(),
                        'title': $option.text()
                    });
                });

                this.$emit('searched', productsToAdd);
                $select.select2('val', '');
            },
            searchFromFilters() {
                let countries = this.selectCountries.val();
                let regions = this.selectRegions.val();
                let producers = this.selectProducers.val();
                let types = this.selectTypes.val();
                let promotions = this.selectPromotions.val();
                let showcases = this.selectShowcases.val();

                if (countries == null && regions == null && producers == null && types == null && promotions == null && showcases == null) {
                    swal('', 'Nenhum filtro foi selecionado.', 'info');
                    return false;
                }

                this.showSweetAlert();

                this.$http.post(
                    this.getUrl('filters'),
                    {'countries': countries, 'regions': regions, 'producers': producers, 'types': types, 'promotions': promotions, 'showcases': showcases}
                ).then(function (response) {

                    if (! response.error) {
                        this.$emit('searched', response.data.products);
                    } else {
                        swal('', 'Ocorreu um erro ao adicionar os produtos', 'error');
                    }

                });

                this.resetSelects();
            },
            searchAll() {
                let $self = this;

                swal({
                    title: 'Atenção',
                    text: "Deseja realmente adicionar todos os produtos do site?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Não",
                    confirmButtonText: "Sim",
                    closeOnConfirm: false
                }, function() {
                    $self.showSweetAlert();

                    $self.$http.post(
                        $self.getUrl('all')
                    ).then(function (response) {

                        if (! response.error) {
                            this.$emit('searched', response.data.products);
                        } else {
                            swal('', 'Ocorreu um erro ao adicionar os produtos', 'error');
                        }

                    });
                });
            },
            initDropzone() {
                let $self = this;

                $('[dropzone-files]').dropzone({
                    url: $self.getUrl('excel'),
                    uploadMultiple: false,
                    maxFiles: 1,
                    acceptedFiles: '.xls,.xlsx',
                    previewsContainer: '#uploadPreview',
                    init: function () {
                        dropzone = this;

                        $('#btnImportProducts').bind('click', function () {
                            dropzone.removeAllFiles();
                        });

                    },
                    sending: function (file, xhr, formData) {
                        formData.append('_token', '{{ csrf_token() }}');

                        $("#upload-message").hide();
                        $('.upload-progress').fadeIn();

                    },
                    success: function (file, response) {
                        $("#upload-message").fadeIn();

                        if (! response.error) {

                            $self.$emit('searched', response.products);

                            swal({
                                title: "Pronto!",
                                text: 'Produtos adicionados com sucesso!',
                                type: 'success',
                                html: true
                            });

                            $("#upload-message").html("<i class='fa fa-thumbs-o-up green'></i> Importado com sucesso!");
                            $('#uploadProgress').css('width', '0');
                            $('.upload-progress').hide();

                        } else {

                            swal('Ops! Houve um erro...', '', 'error');

                            $("#upload-message").html("<i class='fa fa-thumbs-o-down red'></i> Falha ao importar.");

                        }

                    },
                    uploadprogress: function (file, progress) {

                        $('#uploadProgress').css('width', progress + '%');

                    }
                }).removeAttr('dropzone-files');
            },
            resetSelects() {
                this.selectCountries.select2('val', '');
                this.selectRegions.select2('val', '');
                this.selectProducers.select2('val', '');
                this.selectTypes.select2('val', '');
                this.selectPromotions.select2('val', '');
                this.selectShowcases.select2('val', '');
            },
            showSweetAlert() {
                swal({
                    title: "Preparando Produtos...<br /><center><img src='/assets/cms/dist/img/loading.gif' align='center' style='margin-top: 20px;'></center>",
                    text: "Por favor aguarde, isso pode levar alguns minutos.",
                    html: true,
                    showConfirmButton: false
                });
            },
            getUrl(path) {
                return this.basePath + path;
            }
        }
    }

</script>