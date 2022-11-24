import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const page="./components/admin/";

const MyRouter = new VueRouter({
  	routes:[
	    { path: '/', redirect:"/login"},
	    { path: '/login', component: require(page+'login.vue').default, meta:{title:"Login"}, name: 'Login'},
	    { path: '/home', component: require(page+'home.vue').default, meta:{title:"Home"}},
	    { path: '/profile', component: require(page+'me.vue').default, meta:{title:"Mi perfil"}},
	    //Usuarios
	    { path: '/users', component: require(page+'users/index.vue').default, meta:{title:"Usuarios"}},
	    { path: '/users/edit', component: require(page+'users/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
	    { path: '/users/edit/:id', component: require(page+'users/edit.vue').default, meta:{title:"Editar"}},//Con parametro
	    //Roles
	    { path: '/roles', component: require(page+'configuration/roles.vue').default, meta:{title:"Roles"}},
	    { path: '/roles/edit/:id', component: require(page+'configuration/permissions.vue').default, meta:{title:"Editar"}},

		//Banners
	    { path: '/banners', component: require(page+'banners/index.vue').default, meta:{title:"Banners"}},
	    { path: '/banners/edit', component: require(page+'banners/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
	    { path: '/banners/edit/:id', component: require(page+'banners/edit.vue').default, meta:{title:"Editar"}},//Con parametro

		//configuration
	    { path: '/informacion', component: require(page+'extras/redes.vue').default, meta:{title:"editar Información"}},//Con parametro
		{ path: '/terminos-condiciones', component: require(page+'extras/terminos.vue').default, meta:{title:"Terminos y condiciones"}},//Con parametro
		{ path: '/aviso-privacidad', component: require(page+'extras/privacidad.vue').default, meta:{title:"Aviso de Privacidad"}},//Con parametro
		{ path: '/preguntas-frecuentes', component: require(page+'extras/faq.vue').default, meta:{title:"Preguntas frecuentes"}},//Con parametro

		//Clientes
	    { path: '/customers', component: require(page+'customers/index.vue').default, meta:{title:"Clientes"}},
	    { path: '/customers/edit', component: require(page+'customers/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
		{ path: '/customers/edit/:id', component: require(page+'customers/edit.vue').default, meta:{title:"Editar"}},//Con parametro

		//Pedidos
        { path: '/orders', component: require(page+'orders/index.vue').default, meta:{title:"Pedidos"}},
		{ path: '/orders/detail/:id', component: require(page+'orders/edit.vue').default, meta:{title:"Ver Detalle"}},

		//Productos
	    { path: '/products', component: require(page+'products/index.vue').default, meta:{title:"Productos"}},
	    { path: '/products/edit', component: require(page+'products/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
		{ path: '/products/edit/:id', component: require(page+'products/edit.vue').default, meta:{title:"Editar"}},//Con parametro
		{ path: '/products/import', component: require(page+'products/import.vue').default, meta:{title:"Importar"}},

		//categorias
	    { path: '/categories', component: require(page+'categories/index.vue').default, meta:{title:"Categorias"}},
	    { path: '/categories/edit', component: require(page+'categories/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
		{ path: '/categories/edit/:id', component: require(page+'categories/edit.vue').default, meta:{title:"Editar"}},//Con parametro

		//subcategorias
	    { path: '/subcategories', component: require(page+'subcategories/index.vue').default, meta:{title:"Subcategorias"}},
	    { path: '/subcategories/edit', component: require(page+'subcategories/edit.vue').default, meta:{title:"Editar"}},//Cuando no envian parametro
		{ path: '/subcategories/edit/:id', component: require(page+'subcategories/edit.vue').default, meta:{title:"Editar"}},//Con parametro

		//noticias
		{ path: '/blogs', component: require(page+'blogs/index.vue').default, meta:{title:"Noticias" }},
		{ path: '/blogs/edit', component: require(page+'blogs/edit.vue').default, meta:{title:"Editar" }},
		{ path: '/blogs/edit/:id', component: require(page+'blogs/edit.vue').default, meta:{title:"Editar"}},

		//Materiales
		{ path: '/materials', component: require(page+'materials/index.vue').default, meta:{title:"Materiales" }},
		{ path: '/materials/edit', component: require(page+'materials/edit.vue').default, meta:{title:"Editar" }},
		{ path: '/materials/edit/:id', component: require(page+'materials/edit.vue').default, meta:{title:"Editar"}},

		//Paquetes
		{ path: '/packages', component: require(page+'packages/index.vue').default, meta:{title:"Paquetes" }},
		{ path: '/packages/edit', component: require(page+'packages/edit.vue').default, meta:{title:"Editar" }},
		{ path: '/packages/edit/:id', component: require(page+'packages/edit.vue').default, meta:{title:"Editar"}},

		//Armazones
		{ path: '/frames', component: require(page+'frames/index.vue').default, meta:{title:"Armazones" }},
		{ path: '/frames/edit', component: require(page+'frames/edit.vue').default, meta:{title:"Editar" }},
		{ path: '/frames/edit/:id', component: require(page+'frames/edit.vue').default, meta:{title:"Editar"}},

		//Opticas
		{ path: '/opticians', component: require(page+'opticians/index.vue').default, meta:{title:"Opticas" }},
		{ path: '/opticians/edit', component: require(page+'opticians/edit.vue').default, meta:{title:"Editar" }},
		{ path: '/opticians/edit/:id', component: require(page+'opticians/edit.vue').default, meta:{title:"Editar"}},

		//examanes
		{ path: '/exams', component: require(page+'exams/index.vue').default, meta:{title:"Examanes de la vista" }},
	  ]
});

MyRouter.beforeEach((to, from, next) => {
	if (to.path != '/login'){
		window.scrollTo(0,0);
		if(window.app.__vue__ && window.app.__vue__.$refs.loadingBar){
		window.app.__vue__.$refs.loadingBar.start();
		}
	}
	next();
});

MyRouter.afterEach((to, from) => {
	if (to.path != '/login'){
		if(window.app.__vue__ && window.app.__vue__.$refs.loadingBar){
			setTimeout(()=>{
				window.app.__vue__.$refs.loadingBar.done();
			},40);
		}
	}
});

//Titulos del website
import VueDocumentTitlePlugin from "vue-document-title-plugin";
Vue.use(VueDocumentTitlePlugin, MyRouter,
	{ defTitle: "Necesito lentes", filter: (title)=>{ return title+" - Necesito lentes"; } }
);

// export {routes};
export default MyRouter;
