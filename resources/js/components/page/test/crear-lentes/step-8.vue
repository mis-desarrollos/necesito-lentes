<template lang="html">
  <b-form class="box-step-wr padding-b-plan step-8" @submit="onSubmitRegister">
    <div class="wr">
      <div class="col-12 col-xl-5 mx-auto">
        <h2 class="h1s f-w-800 txt-blue">Vamos a crear tu cuenta</h2>
      </div>

      <div class="container main-con">
        <div class="row">
          <div class="col-lg-7 col-form">
            <b-form-group class="custom-form-group-s1"
              label="Nombre completo:">
              <b-form-input
                v-model="$parent.form.nombre"
                type="text"
                placeholder=""
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1"
              label="Correo electrónico:">
              <b-form-input
                v-model="$parent.form.email"
                type="email"
                placeholder=""
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1"
              label="Contraseña:">
              <b-form-input
                v-model="$parent.form.contrasena"
                type="password"
                placeholder=""
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1"
              label="Confirmar contraseña:">
              <b-form-input
                v-model="$parent.form.confcontrasena"
                type="password"
                placeholder=""
                required
              ></b-form-input>
            </b-form-group>

            <div class="txt-white d-block text-left" v-if="formErrors.length">
              <ul class="f-w-500">
                <li v-for="(e, eInx) in formErrors" :key="'eInx-'+eInx">{{ e }}</li>
              </ul>
            </div>
          </div>

          <div class="col-12 mt-5 text-center col-btn-navs">
            <b-button type="button" class="btn btn-s1 outline-white no-border"><u>Regresar</u></b-button>
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Registrarse</b-button>
          </div>
        </div>
      </div>
    </div>
  </b-form>
</template>

<script>
export default {
  data() {
    return {
      formErrors: [],
    }
  },

  methods: {
    onSubmitRegister(event) {
      event.preventDefault();
      this.formErrors = [];

      if(this.$parent.form.contrasena.length >= 8 && this.$parent.form.confcontrasena.length >= 8) {
        if(this.$parent.form.contrasena == this.$parent.form.confcontrasena) {
          this.$parent.step = 9;
        }else {
          this.formErrors.push('Los campos Contraseña y Confirmación de contraseña, deben coincidir.');
        }
      }
      else {
        this.formErrors.push('La contraseña debe tener al menos 8 caracteres.');
      }
    }
  }
}
</script>
