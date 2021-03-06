/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./notification');
require('./form');

window.Vue = require('vue');


import VCalendar from 'v-calendar';
import VueChatScroll from 'vue-chat-scroll';

// vue-chat-scroll option
Vue.use(VueChatScroll);

// Use v-calendar & v-date-picker components
Vue.use(VCalendar, {
  componentPrefix: 'v'
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('auto-postal-code', require('./components/AutoPostalCode.vue').default);
Vue.component('records-table', require('./components/RecordsTable.vue').default);
Vue.component('payment-records', require('./components/PaymentRecords.vue').default);
Vue.component('reservation-form', require('./components/ReservationForm.vue').default);
Vue.component('reservation-list', require('./components/ReservationList.vue').default);
Vue.component('reservation-item', require('./components/ReservationItem.vue').default);
Vue.component('form-guest', require('./components/FormGuest.vue').default);
Vue.component('form-info', require('./components/FormInformation.vue').default);
Vue.component('form-list', require('./components/FormList.vue').default);
Vue.component('conversation', require('./components/Conversation.vue').default);
Vue.component('schedule-picker',require('./components/SchedulePicker.vue').default);
Vue.component('check-in-out',require('./components/CheckInOut.vue').default);
Vue.component('chats', require('./components/Chats.vue').default);
Vue.component('space-view', require('./components/SpaceView.vue').default);
Vue.component('space-form', require('./components/SpaceForm.vue').default);
Vue.component('space-item', require('./components/SpaceItem.vue').default);
Vue.component('space-list', require('./components/SpaceList.vue').default);
Vue.component('space-post-list', require('./components/SpacePostList.vue').default);
Vue.component('space-post-create', require('./components/SpacePostCreate.vue').default);
Vue.component('space-post-update', require('./components/SpacePostUpdate.vue').default);
Vue.component('space-post-delete', require('./components/SpacePostDelete.vue').default);
Vue.component('dd-date-picker', require('./components/DropdownDatePicker.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(() => {
    var app = new Vue({
        el: '#app',
    });
    initNotifications();
    initForm();
});
