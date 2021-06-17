/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('search-section', require('./components/searchSection.vue').default);  <-- Deprecato
Vue.component('home-jumbo', require('./components/HomeJumbo.vue').default);
Vue.component('header-guest', require('./components/HeaderGuest.vue').default);
Vue.component('img-slider', require('./components/ImgSlider.vue').default);
Vue.component('apartment-card', require('./components/apartmentCard.vue').default);
Vue.component('advanced-search-form', require('./components/AdvancedSearchForm.vue').default);
Vue.component('apartments-list', require('./components/apartmentList.vue').default);
Vue.component('locations-list', require('./components/locationList.vue').default);
Vue.component('back-to-top', require('./components/backToTop.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


/*
Toggle button on map
(search page)
*/

const apartmentList = document.querySelector('.apartments-list');
const mapSection = document.querySelector('.chalet-map');
const mapCloseBtn = document.querySelector('.chalet-map__button--close');
const mapOpenBtn = document.querySelector('.chalet-map__button--open');

mapCloseBtn.onclick = function() { toggleMap() };
mapOpenBtn.onclick = function() { toggleMap() };

var mapIsShown = true;


function toggleMap() {
    if(mapIsShown){        
        mapSection.classList.add("hidden");
        mapCloseBtn.classList.remove("hidden");
        apartmentList.classList.add("apartments-list--map-hidden");
        mapIsShown = false;
    }
    else {
        mapOpenBtn.classList.add("hidden");
        mapSection.classList.remove("hidden");
        apartmentList.classList.remove("apartments-list--map-hidden");
        mapIsShown = true;
    }
}
