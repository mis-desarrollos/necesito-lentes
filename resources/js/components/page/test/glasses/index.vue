<template lang="html">
  <b-form id="get-glasses-page" @submit="onSubmit">

    <section class="first-section">
      <div class="container">
        <div v-if="step == 1">
          <h2 class="mb-4 h1s f-w-800 txt-blue">¿Conoces tu graduación?</h2>

          <div class="d-block pb-5">
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.graduacion = 'si'">Si</b-button>

            <p class="mt-3 h4 f-w-600 txt-white">Sube tus datos</p>
          </div>

          <div>
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.graduacion = 'no'">No</b-button>

            <p class="mt-3 h4 f-w-600 txt-white">Comienza el proceso de mandar a hacer tus lentes con nosotros y pedir que un profesional te realice el examen gratuito.</p>
          </div>
        </div>

        <div v-if="step == 2">
          <div class="row justify-content-center">
            <h2 class="mb-4 h1s f-w-800 txt-blue">Agrega tu información</h2>

            <div class="col-lg-7">
              <b-form-group label="Esta es una pregunta" class="form-group-qa" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                  v-model="form.misdatos.pregunta1"
                  :aria-describedby="ariaDescribedby"
                  name="radio-sub-component">
                  <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                  <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                  <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
                </b-form-radio-group>
              </b-form-group>
            </div>
          </div>
        </div>
      </div>
    </section>

    <NextStepsComponent></NextStepsComponent>

  </b-form>
</template>

<script>
import NextStepsComponent from '../next-steps-component.vue'
export default {
  components: {
    NextStepsComponent
  },

  data() {
    return {
      step: 1,

      form: {
        graduacion: null,
        misdatos: {
          pregunta1: null,
        },
      }
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
    },
  },

  watch: {
    form: {
      handler(val){
        this.step += 1;
        window.scrollTo(0,0);

        if(this.step == 6) {
          this.result = Math.floor(Math.random() * 2); // Random para mostrar
        }
      },
      deep: true
    }
  }
}
</script>
