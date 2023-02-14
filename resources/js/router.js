import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//Componentes
//import Login from './components/admin/Login.vue';

const page="./components/page/";

const MyRouter = new VueRouter({
  	routes:[
      { path: '/', component: require(page+'home.vue').default },
      { path: '/test', component: require(page+'test/simple-test/index.vue').default, meta:{title:"Test de la vista"} },
	    { path: '/obtener-lentes', component: require(page+'test/crear-lentes/index.vue').default, meta:{title:"Obtén tus lentes"} },

	    // { path: '/checkout', component: require(page+'checkout.vue').default, meta:{title:"Checkout"}},
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
