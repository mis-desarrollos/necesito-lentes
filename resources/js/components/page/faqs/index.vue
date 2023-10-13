<template lang="html">
  <div id="faqs-page">

    <section class="main-section">
      <div class="box-titles">
        <h2 class="title-s1 txt-purple">Preguntas frecuentes</h2>

        <h5 class="title-2">¿Tienes dudas? Revisa nuestro apartado de preguntas.</h5>

        <!-- <p class="mt-3 mt-sm-2 txt-info">
          Un asesor se pondrá en contacto contigo lo antes posible.
        </p> -->
      </div>

      <div class="box-faqs-s1">
        <div class="accordion" role="tablist">
          <b-card no-body v-for="(item, qaInx) in faqs" :key="'qaInx'+qaInx">
            <b-card-header header-tag="header" role="tab">
              <a class="btn-faq-toggle" v-b-toggle="'accordion-'+qaInx">{{ item.q }}</a>
            </b-card-header>

            <b-collapse :id="'accordion-'+qaInx" accordion="my-accordion" role="tabpanel">
              <b-card-body>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </b-card-body>
            </b-collapse>
          </b-card>
        </div>
      </div>
    </section>

  </div>
</template>

<script>
export default {
  data() {
    return {
      faqs: [
        { q: 'Pregunta 1' },
        { q: 'Pregunta 2' },
        { q: 'Pregunta 3' },
        { q: 'Pregunta 4' },
      ],
    }
  }
}
</script>
