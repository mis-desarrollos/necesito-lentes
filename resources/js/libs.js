/*
 *
 * Estas librerias estan presentes tanto en la website como en el dashboard
 *
 */

//Librerias necesarias
import VeeValidate, { Validator } from 'vee-validate';
import es from 'vee-validate/dist/locale/es';
import Datetime from 'vue-datetime';
import vSelect from 'vue-select';
import vueTopprogress from 'vue-top-progress';
import '@fortawesome/fontawesome-free/js/all.js';
import Vue2Editor from "vue2-editor";

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

import * as VueGoogleMaps from 'vue2-google-maps';

import VueGoogleAutocomplete from 'vue-google-autocomplete';

//Funcion para añadirlas a Vue
function fire(Vue){
	//Vee-validate
	Validator.localize('es', es);
	Vue.use(VeeValidate,{locale:"es"});
	//vue-datetime
	Vue.use(Datetime);
	//Vue-select
	Vue.component('v-select', vSelect);
	//Loading bar
	Vue.use(vueTopprogress);
	//vue2Editor
	Vue.use(Vue2Editor);
	Vue.component('vue-dropzone', vue2Dropzone);

	//Google map
	Vue.use(VueGoogleMaps, {
		load: {
			key: 'AIzaSyAYBEZUWUw3xAWW22zyxtbXCR--cSXoXJQ',
		   libraries: 'places', // This is required if you use the Autocomplete plugin
				   // OR: libraries: 'places,drawing'
				   // OR: libraries: 'places,drawing,visualization'
				   // (as you require)
	   },
	   installComponents: true,
   });

   Vue.component('vue-google-autocomplete', VueGoogleAutocomplete);
}



// Install by default if using the script tag
if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(plugin)
}

export default fire;
