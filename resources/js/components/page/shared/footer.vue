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
                <h5>¡Suscríbete al Newsletter!</h5>
              </div>

              <div class="col-lg col-form">
                <b-form class="row no-gutters" @submit="onSubmit">
                  <b-form-group class="col">
                    <b-form-input
                      v-model="form.email"
                      type="email"
                      placeholder="Escribe tu correo"
                      required
                    ></b-form-input>
                  </b-form-group>

                  <b-button type="submit" class="col btn-snewsletter">Suscribirse</b-button>
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
            <p class="mt-3 t-w-break">
              <a class="link-icon email" href="mailto:contacto@necesito-lentes.com"><i></i> contacto@necesito-lentes.com</a>
            </p>
            <p class="mt-2 t-w-break">
              <a class="link-icon help"><i></i> +55 323-4332-9438</a>
            </p>
            <!-- <p class="mt-2 t-w-break">
              <span class="link-icon map"><i></i> <span>Diamante #2680,<br />Bosques de la Victoria, Zapopan</span></span>
            </p> -->
          </div>

          <div class="col-lg-6 col-main-2">
            <div class="row justify-content-center">
              <div class="col-6 col-sm-4 col-xl-3 col-menu">
                <h5 class="title">General</h5>

                <p>
									<router-link to="">¿Necesitas lentes?</router-link><br />
                  <router-link to="">Sobre nosotros</router-link><br />
                  <router-link to="">Contacto</router-link>
                </p>
              </div>

              <div class="col-6 col-sm-4 col-xl-3 col-menu">
                <h5 class="title">Sitio</h5>

                <p>
                  <router-link to="/">Home</router-link><br />
                  <router-link to="">Productos</router-link><br />
                  <router-link to="">Promociones</router-link>
                </p>
              </div>

              <div class="col-6 col-sm-4 col-menu">
                <h5 class="title">Links de ayuda</h5>

                <p>
                  <router-link to="">Iniciar sesión</router-link><br />
                  <router-link to="">Crear cuenta</router-link><br />
                  <router-link to="">FAQ</router-link>
                </p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3 col-main-3">
            <p>
              <a class="_btn-net ig t-150" target="_blank"><span><i class="fab fa-instagram"></i></span></a>
              <a class="_btn-net fb t-150" target="_blank"><span><i class="fab fa-facebook-f"></i></span></a>
              <a class="_btn-net tw t-150" target="_blank"><span><i class="fab fa-twitter"></i></span></a>
              <a class="_btn-net lk t-150" target="_blank"><span><i class="fab fa-linkedin-in"></i></span></a>
            </p>

            <p class="mt-3">
              <router-link class="mini-text" to="/aviso-de-privacidad">Aviso de privacidad</router-link><br />
              <router-link class="mt-1 mini-text" to="/terminologia-legal">Términos y condiciones de uso</router-link><br />
              <span class="mt-1 mini-text">Copyright © 2023 Necesito lentes</span>
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
  }
}
</script>
