<template lang="html">
  <div id="user-access-page" class="placed-backg">

    <div class="container">
      <div class="row mx-0 flex-center-xy page-size">

        <div class="form-container">
          <div class="box-color"><i><u class="fas fa-user"></u></i></div>

          <b-form class="form" @submit.prevent="login()">

            <h1 class="mb-3">Iniciar Sesión</h1>

            <b-form-group>
              <b-form-input type="email" v-model="form.email" required placeholder="Correo electrónico"></b-form-input>
            </b-form-group>

            <!-- <b-form-group>
              <b-form-input type="password" v-model="form.password" required placeholder="Contraseña"></b-form-input>
            </b-form-group> -->
             
              <b-form-group
                label="Contraseña*"
                label-for="il-2">
                <div class="eye-box" style="position:relative;">
                  <b-form-input
                    id="il-2"
                    size="sm"
                    v-model="form.password"
                    type="password"
                    required
                  ></b-form-input>
                  <i style="background-color: #fff;cursor: pointer; padding: 6px 10px; position: absolute;right: 2px;top: 2px; z-index: 4" class="fas ic-eye" v-bind:class="{ 'fa-eye' : showpass, 'fa-eye-slash' : !showpass }"  @click="showpass = !showpass"></i>
                </div>
              </b-form-group>
            

            <p class="mb-3">
              <router-link to="/recuperar-contrasena">¿Olvidó su contraseña?</router-link>
            </p>

            <b-form-group>
              <b-button type="submit" class="btn-blue" variant="primary">Acceder</b-button>
            </b-form-group>

          </b-form>
        </div>

      </div>
    </div>

    <sweet-modal :icon="modal.icon" :blocking="modal.block" :hide-close-button="modal.block" ref="modal">
        <div class="fa-3x" v-if="modal.icon== ''"><i class="fas fa-spinner fa-pulse"></i></div><br/>
        {{modal.msg}}
        <div class="col-12 text-center" style="padding-top: 20px;" v-if="modal.icon == 'success'">
        <b-button class="btn btn-primary" slot="button" v-on:click.prevent="$refs.modal.close();">OK</b-button>
        </div>
    </sweet-modal>

  </div>
</template>

<script>
export default {
  data(){
    return{
      form: {
        email: '',
        password: ''
      },

      modal:{
        msg:'',
        icon:'',
        block:false,
      },
      showpass:false,
    }
  },
  watch:{
    'showpass':function (val) {
          if (val == true) {
              $("#il-2").prop('type','text');
          }
          else if (val == false) {
            $("#il-2").prop('type','password');
          }
      },
  },
  methods: {
    login(){
      

      //axios.get(tools.url('/sanctum/csrf-cookie')).then(() => {
         axios.post(tools.url("/api/login"), this.form).then((response)=>{
             this.$parent.user = response.data;
             this.$parent.logged = true;
             this.$root.auth();
             this.$router.push('/usuario');
               }).catch((error)=>{
             this.handleErrors(error);
         });
      //});
    },

    handleErrors:function(errors){
        var err="";

        if (errors.response) {
            if(errors.response.data.errors){
                jQuery.each(errors.response.data.errors,(k,v)=>{
                    err+="*"+v[0]+"\n";
                });
            }

            if(errors.response.data.message && !errors.response.data.errors){
                err = errors.response.data.message;
            }
        }
        else{
            console.log(errors);
            err="Error desconocido.";
        }

        this.modal.icon = "error";
        this.modal.msg = 'Las credenciales con las que accediste son incorrectas, si necesitas ayuda comunícate a ayuda@mexicolimited.com o al WhatsApp de +52 1 33 1708 5870';
        this.modal.block = false;
        this.$refs.modal.open();

    },

  },

  mounted(){
    if(this.$root.logged){
        this.$router.push("/usuario");
    }
  }
}
</script>
