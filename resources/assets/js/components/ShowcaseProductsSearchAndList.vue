<template>
    <div class="row">
        <div id="productsSearch" class="col-xs-12">
            <showcase-products-search
                    :showcase-id="showcaseId"
                    :filters-endpoint="filtersEndpoint"
                    :base-path="basePath"></showcase-products-search>
        </div>

        <div class="col-xs-12" style="margin-top: 20px;">
            <products-table-list
                    :resource-id="showcaseId"
                    :resource-type="showcaseType"
                    :data-url="dataUrl"
                    :update-position-url="updatePositionUrl"
                    :delete-selected-url="deleteSelectedUrl"
                    :delete-all-url="deleteAllUrl"></products-table-list>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default{
        props: {
            filtersEndpoint: {
                required: true
            },
            basePath: {
                required: true
            },
            showcaseId: {
                required: true
            },
            showcaseType: {
                required: true
            },
            dataUrl: {
                required: true
            },
            deleteSelectedUrl: {
                required: false
            },
            deleteAllUrl: {
                required: false
            },
            updatePositionUrl: {
                required: false
            }
        }
    }
</script>
