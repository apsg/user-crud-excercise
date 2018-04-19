
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('users-list', require('./components/UsersList.vue'));
Vue.component('users-modify', require('./components/UsersModify.vue'));
Vue.component('users-create', require('./components/UsersCreate.vue'));

const app = new Vue({
    el: '#app'
});

window.ensure = function(){
	return confirm('This action cannot be reverted. Are you sure you want to do it?');
}