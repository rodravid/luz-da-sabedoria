
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('productsSearch', require('./components/productsSearch.vue'));
Vue.component('promotionProductsSearch', require('./components/PromotionProductsSearch.vue'));
Vue.component('showcaseProductsSearch', require('./components/ShowcaseProductsSearch.vue'));
Vue.component('activityLogs', require('./components/ActivityLogs.vue'));
Vue.component('productsTableList', require('./components/ProductsTableList.vue'));
Vue.component('promotionProductsSearchList', require('./components/PromotionProductsSearchAndList.vue'));
Vue.component('showcaseProductsSearchList', require('./components/ShowcaseProductsSearchAndList.vue'));
Vue.component('menuEditorWrapper', require('./components/MenuEditorWrapper.vue'));
Vue.component('discountGroupsWrapper', require('./components/DiscountGroupsWrapper.vue'));