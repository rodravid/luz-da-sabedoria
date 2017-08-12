<template>
    <div>
        <div id="productsSearch" class="col-xs-12">
            <promotion-products-search
                    :promotion-id="resourceId"
                    :current-module-name="currentModuleName"
                    :filters-endpoint="filtersEndpoint"
                    :base-path="basePath"></promotion-products-search>
        </div>

        <div class="col-xs-12" style="margin-top: 20px;">
            <products-table-list
                    :resource-id="resourceId"
                    :resource-type="resourceType"
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
            resourceId: {
                required: true
            },
            resourceType: {
                required: true
            },
            filtersEndpoint: {
                required: true
            },
            basePath: {
                required: true
            },
            currentModuleName: {
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
