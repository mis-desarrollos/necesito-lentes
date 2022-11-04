import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//Componentes
//import Login from './components/admin/Login.vue';

const page="./components/page/";

const MyRouter = new VueRouter({
  	routes:[
	    { path: '/', component: require(page+'home.vue').default, meta:{title:"Home"}},
	    { path: '/instalation', component: require(page+'instalation/index.vue').default, meta:{title:"Instalacion"}},
	    { path: '/backend', component: require(page+'backend/index.vue').default, meta:{title:"Backend"}},
	    { path: '/frontend', component: require(page+'frontend/index.vue').default, meta:{title:"Frontend"}},
	    { path: '/tutorials', component: require(page+'tutorials/index.vue').default, meta:{title:"Tutoriales"}},
	    { path: '/checkout', component: require(page+'checkout.vue').default, meta:{title:"Checkout"}},
	  ]
});

MyRouter.beforeEach((to, from, next) => {
	window.scrollTo(0,0);
	if(window.app.__vue__ && window.app.__vue__.$refs.loadingBar){
		window.app.__vue__.$refs.loadingBar.start();
	}
	next();
});

MyRouter.afterEach((to, from) => {	

	if(window.app.__vue__ && window.app.__vue__.$refs.loadingBar){
		setTimeout(()=>{
			window.app.__vue__.$refs.loadingBar.done();
		},500);
	}

	
});

//Titulos del website
import VueDocumentTitlePlugin from "vue-document-title-plugin";
Vue.use(VueDocumentTitlePlugin, MyRouter, 
	{ defTitle: "Necesito lentes", filter: (title)=>{ return title+" - Necesito lentes"; } }
);
	  
// export {routes};
export default MyRouter;