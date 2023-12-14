<template lang="html">
  <div id="user-access-page" class="placed-backg">

    <div class="container">
      <div class="row mx-0 flex-center-xy page-size">

        <div class="form-container">
          <div class="box-color"><i><u class="fas fa-user"></u></i></div>

          <b-form class="form" @submit.prevent="register">

            <h1 class="mb-3">Registrarse</h1>

            <b-form-group>
              <b-form-input type="text" v-model="form.name" required placeholder="Nombre"></b-form-input>
            </b-form-group>

            <b-form-group>
              <b-form-input type="text" v-model="form.lastname" required placeholder="Apellidos"></b-form-input>
            </b-form-group>

            <b-form-group>
              <b-form-input type="email" v-model="form.email" required placeholder="Correo electrónico"></b-form-input>
            </b-form-group>

            <b-form-group>
              <b-form-input type="password" v-model="form.password" required placeholder="Contraseña"></b-form-input>
            </b-form-group>

            <b-form-group>
              <b-form-input type="password" v-model="form.password_confirmation" required placeholder="Confirmar contraseña"></b-form-input>
            </b-form-group>

            <div class="d-inline-block mb-3">
              <b-form-checkbox v-model="form.tos" name="usertype" value="1" unchecked-value="" required>
                Acepto los términos y condiciones
              </b-form-checkbox>
            </div>

            <p class="mb-1">
              <router-link to="/login">¿Ya tiene una cuenta?</router-link>
            </p>

            <div class="mb-4 form-errors" v-if="formErrors.length">
              <hr />
              <ul>
                <li class="text-danger" v-for="formError in formErrors">
                  <small>{{ formError }}</small>
                </li>
              </ul>
            </div>

            <b-form-group class="mt-3">
              <b-button type="submit" class="btn-blue" variant="primary">Crear una cuenta</b-button>
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
      formErrors: [],

      form: {
        name: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: ''
      },

      modal:{
        msg:'',
        icon:'',
        block:false,
      },
    }
  },

  methods: {
    register(evt){
      this.formErrors = [];
      if(this.form.password.length < 6){
          this.formErrors.push("La contraseña debe tener por lo menos 6 caracteres");
          this.modal.block = false;
          this.modal.icon = 'error';
          this.modal.msg = 'La contraseña debe tener por lo menos 6 caracteres';
          this.$refs.modal.open();
      } else {
        if(this.form.password !== this.form.password_confirmation){
            this.formErrors.push("Los campos contraseña y confirmación de contraseña deben coincidir");
            this.modal.block = false;
            this.modal.icon = 'error';
            this.modal.msg = 'Los campos contraseña y confirmación de contraseña deben coincidir';
            this.$refs.modal.open();
        } else {
             axios.post(tools.url('/api/user/register'),this.form).then((response)=>{
                this.$parent.user = response.data;
                this.$parent.logged = true;

                axios.get(tools.url('/sanctum/csrf-cookie')).then(() => {
                    this.$router.push("/usuario");
                });

            }).catch((error)=>{
                this.handleErrors(error);
            });
        }
      }
    },

    handleErrors:function(errors){
        var err="";

        if (errors.response) {
            if(errors.response.data.errors){
                jQuery.each(errors.response.data.errors,(k,v)=>{
                    err+="*"+v[0]+"\n";
                });
            }
        }
        else{
            console.log(errors);
            err="Error desconocido.";
        }

        this.modal.icon = "error";
        this.modal.msg = err;
        this.modal.block = false;
        this.$refs.modal.open();

    },
  },

  mounted()
  {
    if(this.$root.logged){
        this.$router.push("/usuario");
    }
  }
}
</script>
