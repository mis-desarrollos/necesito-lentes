import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//Componentes
//import Login from './components/admin/Login.vue';

const page="./components/page/";

const MyRouter = new VueRouter({
  	routes:[
      { path: '/', component: require(page+'home/index-old.vue').default },
      { path: '/home', component: require(page+'home/index.vue').default },
      { path: '/nosotros', component: require(page+'about-us/index.vue').default, meta:{title:"Sobre nosotros"}},
      { path: '/contacto', component: require(page+'contact/index.vue').default, meta:{title:"Contacto"}},

      { path: '/test', component: require(page+'test/simple-test/index.vue').default, meta:{title:"Test de la vista"} },
      { path: '/obtener-lentes', component: require(page+'test/crear-lentes/index.vue').default, meta:{title:"Obtén tus lentes"} },
	    { path: '/finalizado', component: require(page+'test/pagado/index.vue').default, meta:{title:"Pagado correctamente"} },

      { path: '/productos/:id?', component: require(page+'products/results.vue').default, meta:{title:"Productos"}},
      { path: '/producto/:id', component: require(page+'products/detail.vue').default, meta:{title:"Producto"}},

      { path: '/aviso-de-privacidad', component: require(page+'text-pages/aviso.vue').default, meta:{title:"Aviso de privacidad"}},
      { path: '/terminos-y-condiciones', component: require(page+'text-pages/terminos.vue').default, meta:{title:"Términos y condiciones de uso"}},

      { path: '/cart/:step?', component: require(page+'carrito/index.vue').default, meta:{title:"Mi carrito de compras"}},

      { path: '/login', component: require(page+'user-access/login.vue').default, meta:{title:"Iniciar sesión"}},
      { path: '/recuperar-contrasena', component: require(page+'user-access/reset-password.vue').default, meta:{title:"Recuperar contraseña"}},
      { path: '/registrarse', component: require(page+'user-access/register.vue').default, meta:{title:"Registrarse"}},

      { path: '/usuario', component: require(page+'usuario-cuenta/index.vue').default, meta:{ title: 'Mi datos' },
  			children: [
  			{
  				path: '/',
  				component: require(page+'usuario-cuenta/mis-datos.vue').default,
  				meta:{ title: 'Mis datos' }
  			},
  			{
  				path: 'contrasena',
  				component: require(page+'usuario-cuenta/contrasena.vue').default,
  				meta:{ title: 'Cambiar contraseña' }
  			},
        {
            path: 'historial-compras',
            component: require(page+'usuario-cuenta/historial-compras.vue').default,
            meta:{ title: 'Mis pedidos' }
        },
        // {
        //     path: 'pedido/:id',
        //     component: require(page+'usuario-cuenta/orderdetails.vue').default,
        //     meta:{ title: 'Mis pedidos' }
        // },
  	  	]
  		},

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
