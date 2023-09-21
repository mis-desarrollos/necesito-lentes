<template lang="html">
  <div id="home-page">

    <section class="suggestion-section">
      <div class="box-text">
        <h2 class="title-h1">Si, talvez<br />necesitas lentes</h2>
        <h5 class="txt-2">
          Si llegaste hasta aquí es porque tienes esa pequeña duda.<br />
          Pero, tranquilo, es fácil resolverla con un sencillo test.
        </h5>

        <p class="txt-w-btn">
          <router-link class="t-150 btn-s2" to="/test">Hacer test</router-link>
        </p>

        <h6 class="txt-3">
          Ya se que los necesito.<br />
          Solo quiero aprovechar la oferta.
        </h6>
      </div>

      <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/home/h-glasses-1.jpg)' }">
        <!-- <img src="public/images/pages/home/h-glasses-1.png"> -->
      </div>
    </section>

    <section class="design-lenses-section">
      <div class="box-text">
        <h2 class="title-h1">¿Sabes tu<br />graduación?</h2>

        <p class="txt-w-btn">
          <router-link class="t-150 btn-s2" to="/test">Diseña tus lentes</router-link>
        </p>
      </div>

      <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/home/h-glasses-2.jpg)' }">
        <!-- <img src="public/images/pages/home/h-glasses-2.png"> -->
      </div>
    </section>

    <section class="faqs-section">
      <div class="box-info">
        <h2 class="title-h1">Preguntas<br />frecuentes</h2>

        <div class="box-faqs">
          <div class="accordion" role="tablist">
            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <a class="btn-faq-toggle" v-b-toggle.accordion-1>Pregunta 1</a>
              </b-card-header>

              <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </b-card-body>
              </b-collapse>
            </b-card>

            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <a class="btn-faq-toggle" v-b-toggle.accordion-2>Pregunta 2</a>
              </b-card-header>
              <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </b-card-body>
              </b-collapse>
            </b-card>

            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <a class="btn-faq-toggle" v-b-toggle.accordion-3>Pregunta 3</a>
              </b-card-header>
              <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </b-card-body>
              </b-collapse>
            </b-card>

            <b-card no-body>
              <b-card-header header-tag="header" role="tab">
                <a class="btn-faq-toggle" v-b-toggle.accordion-4>Pregunta 3</a>
              </b-card-header>
              <b-collapse id="accordion-4" accordion="my-accordion" role="tabpanel">
                <b-card-body>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
                </b-card-body>
              </b-collapse>
            </b-card>
          </div>
        </div>
      </div>

      <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/home/h-glasses-3.jpg)' }">
        <!-- <img src="public/images/pages/home/h-glasses-3.png"> -->
      </div>
    </section>

    <section class="container form-section">
      <div class="box-titles">
        <h2 class="title-h1">¿Tienes<br />una óptica?</h2>

        <h5 class="title-2">Afiliate con nosotros</h5>
      </div>

      <div class="box-form">
        <b-form @submit="onSubmit">
          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.name"
              type="text"
              placeholder="Nombre"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.phone"
              type="text"
              placeholder="Teléfono"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.email"
              type="email"
              placeholder="Correo electrónico"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <p class="pt-2 text-center">
            <b-button type="submit" class="btn-s2">Afílitate con nosotros</b-button>
          </p>
        </b-form>
      </div>
    </section>

  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        phone: null,
        email: null,
      },
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
    },
  }
}
</script>
