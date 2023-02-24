<template lang="html">
  <div class="d-flex account-page">
    <div class="container">

      <div class="row">
        <div class="col-xl-10 offset-xl-1 main-box">

          <div class="row">
            <div class="col-12 px-2">
              <h1 class="mb-3 page-title">{{ title }}</h1>
            </div>
            <div class="col-lg-4 px-2 col-menu">
              <div class="white-box">
                <div class="d-none d-lg-block box-profile">
                  <div class="d-block mt-4 pb-3">
                    <span class="fa-stack fa-4x user-icon">
                      <i class="fas fa-circle fa-stack-2x"></i>
                      <i class="fas fas fa-user fa-stack-1x fa-inverse"></i>
                    </span>

                    <h5 class="txt-username">Bienvenido {{ $root.user.name }}</h5>
                  </div>
                </div>

                <hr class="d-none d-lg-block" />

                <div class="box-menu">
                  <p class="item">
                    <router-link class="btn-menu" to="/usuario"><i class="far fa-edit"></i> Mis datos</router-link>
                  </p>
                  <p class="item">
                    <router-link class="btn-menu" to="/usuario/contrasena"><i class="fas fa-lock"></i> Mi contraseña</router-link>
                  </p>
                  <p class="item">
                    <router-link class="btn-menu" to="/usuario/historial-compras"><i class="fas fa-clipboard-list"></i> Historial de compras</router-link>
                  </p>
                  <!-- <p class="item">
                    <router-link class="btn-menu" to="/"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</router-link>
                  </p> -->
                  <p class="item">
                    <a class="btn-menu" v-on:click="logout()" style="cursor: pointer;"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                  </p>
                </div>

              </div>
            </div>

            <div class="col-lg px-2">
              <div class="white-box p-4">

                <router-view></router-view>

              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      title: 'Mi cuenta'
    }
  },

  methods:{
    getUrlName(){
      var urlName = this.$route.path;

      if(urlName == '/usuario'){ this.title = 'Mis datos' }
      if(urlName == '/usuario/contrasena'){ this.title = 'Cambiar contraseña' }
    },

    logout(){
        axios.post(tools.url("/api/logout")).then((response)=>{
            this.$parent.user = {};
            this.$parent.logged = false;
            this.$router.push('/login');
        }).catch(()=>{});
    },
  },

  beforeMount(){
    this.getUrlName();
  },

  watch: {
    $route(to, from) {
      this.getUrlName();
    },
  },

  mounted(){
    if(this.$root.logged == false){
        this.$router.push("/");
    }
  }
}
</script>
