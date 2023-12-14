/*
 *
 * Estos componentes estan presentes solo en el website
 *
 */

const page="./page/";
// import slick from 'vue-slick';
import BootstrapVue from 'bootstrap-vue';
import VueAwesomeSwiper from 'vue-awesome-swiper';
import VCalendar from 'v-calendar';
// import VueSweetalert2 from 'vue-sweetalert2';

function plugin (Vue) {
	//Componentes llamados
  Vue.component('my-header', require(page+'shared/header.vue').default);
	Vue.component('my-footer', require(page+'shared/footer.vue').default);
	// Vue.component('slick',slick);
  Vue.use(BootstrapVue);
  Vue.use(VueAwesomeSwiper, /* { default options with global component } */);
  Vue.use(VCalendar);
  // Vue.use(VueSweetalert2);
}

// Install by default if using the script tag
if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(plugin)
}

export default plugin
