<template lang="html">
  <div id="about-us-page-v2">
    <section class="main-section">
      <div class="container">
        <div class="row box-info">
          <div class="col-lg-6 col-text">
            <h2 class="title-s1 txt-purple">Por qué<br />estás aquí</h2>

            <div class="txt">
              Hay mucha gente que necesita
              lentes, pero no lo sabe. Sí, es muy
              probable que tú seas una de ellas.
              Y si no tú, con seguridad alguien
              cercano a ti. No, no es un dato
              sacado de la manga, las
              estadísticas lo confirman: sólo en
              México, existen 60 millones de
              personas que necesitan lentes (es
              decir, ¡más de la mitad!), pero sólo
              15 millones los usan.
            </div>
          </div>

          <div class="col-lg-8 col-image">
            <div class="img">
              <img src="public/images/pages/about-us/image-1.png">
            </div>
          </div>
        </div>

        <div class="row box-info mt-5 pt-1">
          <div class="col-lg-6 col-text">
            <h2 class="title-s1 txt-purple">Necesitas lentes,<br />y eso está bien</h2>

            <div class="txt">
              Si eres parte de esa mayoría que
              necesita lentes, pero aún no te
              atreves a usarlos, tal vez te sirva
              saber que la cultura del uso de
              lentes está cada vez más extendida
              y las comodidades que los nuevos
              diseños y tecnologías ópticas te
              ofrecen son tales, que adaptarse a
              ellos es cada día más fácil.
            </div>
          </div>

          <div class="col-lg-8 col-image">
            <div class="img">
              <img src="public/images/pages/about-us/image-2.png">
            </div>
          </div>
        </div>

        <div class="row box-info mt-4 mt-sm-5 pt-sm-1">
          <div class="col-lg-6 col-text">
            <h2 class="title-s1 txt-purple">Tu salud,<br />de eso se trata</h2>

            <div class="txt">
              Como verás, además de ayudarte a
              saber si puedes o no necesitarlos,
              te ofrecemos soluciones muy
              accesibles para que te hagas de tus
              primeros lentes. Pero no sólo eso:
              en el mercado hay calidades muy
              variadas y, con facilidad, puedes
              encontrar lentes muy baratos, pero
              con tecnología y materiales que
              dejan mucho que desear. Nosotros
              nos hemos ocupado de sólo
              ofrecerte productos de calidad
              comprobada y tecnología de
              vanguardia, como las lentes
              procesadas en los
              laboratorios Augen.
            </div>
          </div>
        </div>

        <div class="row box-partner mt-5 pt-1">
          <div class="col-lg-6 col-info">
            <h2 class="title-s1 txt-purple">Nuestros<br />aliados</h2>

            <div class="box-images">
              <div class="b-logo">
                <img class="logo" src="public/images/pages/about-us/logo-1.jpg">
              </div>
              <div class="b-logo">
                <img class="logo" src="public/images/pages/about-us/logo-1.jpg">
              </div>
              <div class="b-logo">
                <img class="logo" src="public/images/pages/about-us/logo-1.jpg">
              </div>
              <div class="b-logo">
                <img class="logo" src="public/images/pages/about-us/logo-1.jpg">
              </div>
            </div>
          </div>
        </div>

        <div class="row box-form">
          <div class="col-lg-10 col-info">
            <div class="box-image">
              <img class="glasses" src="public/images/pages/home/h-glasses-3.jpg">
            </div>

            <div class="box-content">
              <h4 class="title-s1 txt-purple">¿Eres dueño<br />de una óptica?</h4>
              <h5 class="subtitle">
                Afiliate con nosotros,<br />es rápido, fácil y sin costo.
              </h5>

              <b-form class="form" @submit="onSubmitAf">
                <b-form-group class="custom-f-group-s1">
                  <b-form-input
                    v-model="formAf.name"
                    type="text"
                    placeholder="Nombre"
                    size="lg"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group class="custom-f-group-s1">
                  <b-form-input
                    v-model="formAf.phone"
                    type="text"
                    placeholder="Teléfono"
                    minlength="10"
                    maxlength="10"
                    size="lg"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group class="custom-f-group-s1">
                  <b-form-input
                    v-model="formAf.email"
                    type="email"
                    placeholder="Correo electrónico"
                    size="lg"
                    required
                  ></b-form-input>
                </b-form-group>

                <p class="pt-2 text-center">
                  <b-button type="submit" class="btn-s2 bg-purple">Afíliate con nosotros</b-button>
                </p>
              </b-form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data(){
    return{
      formAf: {
        name: null,
        form: null,
        email: null,
      },
    }
  },

  methods: {
    onSubmitAf(event) {
      event.preventDefault();
    },
  },
}
</script>
