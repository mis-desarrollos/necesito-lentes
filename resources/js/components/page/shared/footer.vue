<template lang="html">
  <footer class="placed-backg" id="footer">

    <section class="newsletter-section">
      <div class="container oversized-container">
        <div class="row align-items-center">
          <div class="col-lg-2 col-logo">
            <router-link to="/"><img src="public/images/logo.svg" alt="Necesito lentes"></router-link>
          </div>

          <div class="col-lg col-newsletter">
            <div class="row align-items-center">
              <div class="col-lg col-text">
                <h5>¡Suscríbete a nuestro newsletter!</h5>
              </div>

              <div class="col-lg col-form">
                <b-form class="row no-gutters" @submit="onSubmit">
                  <b-form-group class="col">
                    <b-form-input
                      v-model="form.email"
                      type="email"
                      placeholder="Correo electrónico"
                      required
                    ></b-form-input>
                  </b-form-group>

                  <b-button type="submit" class="col btn-snewsletter">Enviar</b-button>
                </b-form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="footer-section">
      <div class="container oversized-container">
        <div class="row">
          <div class="col-sm-6 col-lg-3 col-main-1">
            <p class="mt-3 mt-lg-5 t-w-break">
              <a class="link-icon" href="mailto:contacto@necesitolentes.club"><i></i> contacto@necesitolentes.club</a>
            </p>
            <p class="mt-2 t-w-break">
              <a class="link-icon"><i></i> +55 323-4332-9438</a>
            </p>
          </div>

          <div class="col-lg col-main-2">
            <div class="row justify-content-center">
              <div class="col-12 col-sm-4 col-xl-3 col-menu">
                <h5 class="title">General</h5>

                <p>
									<router-link class="t-150 btn-test" to="/test">Hacer test</router-link><br />
                  <router-link to="/nosotros">Nosotros</router-link><br />
                  <router-link to="/contacto">Contacto</router-link>
                </p>
              </div>

              <div class="col-12 col-sm-4 col-xl-3 col-menu">
                <h5 class="title">Sitio</h5>

                <p>
                  <router-link to="/">Inicio</router-link><br />
                  <router-link to="/busqueda">Armazones</router-link><br />
                  <router-link to="/obtener-lentes">Obtén tus lentes</router-link>
                </p>
              </div>

              <div class="col-12 col-sm-4 col-menu">
                <h5 class="title">Ayuda</h5>

                <p>
                  <router-link to="/cart">Carrito de compras</router-link><br />
                  <router-link to="/login">Iniciar sesión</router-link><br />
                  <router-link to="/registrarse">Registrarse</router-link>
                </p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg col-main-3">
            <p>
              <a class="_btn-net fb t-150" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a>
              <a class="_btn-net ig t-150" target="_blank"><span><i class="fab fa-instagram"></i></span></a>
              <a class="_btn-net tw t-150" target="_blank"><span><i class="fab fa-twitter"></i></span></a>
              <a class="_btn-net lk t-150" target="_blank"><span><i class="fab fa-linkedin-in"></i></span></a>
            </p>

            <p class="mt-3">
              <router-link class="mini-text" to="/aviso-de-privacidad">Aviso de privacidad</router-link><br />
              <router-link class="mt-1 mini-text" to="/terminos-y-condiciones">Términos y condiciones de uso</router-link><br />
              <span class="mt-2 d-inline-block mini-text f-w-600">Copyright © {{ currentYear }} Necesito lentes</span>
            </p>
          </div>
        </div>
      </div>
    </section>

  </footer>
</template>

<script>
export default {
  data(){
    return{
      currentYear: null,

      form: {
        email: null
      },

      info: {}
    }
  },

  methods:{
    makeToast(variant = null, msg, title) {
      this.$bvToast.toast(msg, {
        title: title,
        variant: variant,
        solid: true,
        toaster: 'b-toaster-top-right',
        appendToast: true
      });
    },

    onSubmit(evt) {
      evt.preventDefault();
      var r = confirm("¿Deseas regístrate en newsletter? ");
      if (r == true) {
        axios.post(tools.url("/api/newsletter"), this.form).then((response)=>{
          this.makeToast('default', response.data.response, 'Correo registrado');
          this.form = {
            name: null,
            email: null,
            msg: null,
            check: null
          };
        }).catch( (error)=> {
          // console.log(error.response);
          let errors = error.response.data;
          // console.log(errors);
          this.makeToast('danger', error.response.data.name, 'Error');
          this.makeToast('danger', error.response.data.email, 'Error');
          this.makeToast('danger', error.response.data.phone, 'Error');
          this.makeToast('danger', error.response.data.msg, 'Error');
        });
      }
    },
  },

  beforeMount(){
    this.currentYear = new Date().getFullYear();
  }
}
</script>
