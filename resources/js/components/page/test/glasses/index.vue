<template lang="html">
  <b-form id="get-glasses-page" @submit="onSubmit">

    <section class="first-section">
      <div class="container">
        <!-- Paso 1 -->
        <div class="box-step-wr" v-if="step == 1 && !showInfoForm">
          <h2 class="mb-4 h1s f-w-800 txt-blue">¿Conoces tu graduación?</h2>

          <div class="d-block pb-5">
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.graduacion = 'no'">Si</b-button>

            <p class="mt-3 h4 f-w-600 txt-white">Sube tus datos</p>
          </div>

          <div>
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.graduacion = 'no'; showInfoForm = true">No</b-button>

            <p class="mt-3 h4 f-w-600 txt-white">Comienza el proceso de mandar a hacer tus lentes con nosotros y pedir que un profesional te realice el examen gratuito.</p>
          </div>
        </div>
        <!-- fin paso 1 -->

        <!-- Formulario "NO" del paso 1 -->
        <div class="box-step-wr" v-if="showInfoForm">
          <div class="row justify-content-center">
            <h2 class="mb-4 h1s f-w-800 txt-blue">Agrega tu información</h2>

            <div class="col-lg-7">
              <b-form-group label="1. Esta es una pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                  required
                  v-model="form.misdatos.pregunta1"
                  :aria-describedby="ariaDescribedby"
                  name="rad-1">
                  <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                  <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                  <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
                </b-form-radio-group>
              </b-form-group>

              <b-form-group label="2. Esta es otra pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                  required
                  v-model="form.misdatos.pregunta2"
                  :aria-describedby="ariaDescribedby"
                  name="rad-2">
                  <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                  <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                  <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
                </b-form-radio-group>
              </b-form-group>

              <b-form-group label="3. Esta es la tercer pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                  required
                  v-model="form.misdatos.pregunta3"
                  :aria-describedby="ariaDescribedby"
                  name="rad-3">
                  <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                  <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                  <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
                </b-form-radio-group>
              </b-form-group>

              <b-form-group label="4. Esta es una cuarta pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                  required
                  v-model="form.misdatos.pregunta4"
                  :aria-describedby="ariaDescribedby"
                  name="rad-4">
                  <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                  <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                  <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
                </b-form-radio-group>
              </b-form-group>

              <p>
                <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Guardar</b-button>
              </p>
            </div>
          </div>
        </div>
        <!--  -->
      </div>
    </section>

    <section class="second-section">
      <div class="box-top" v-if="form.plan">
        <div class="container">
          <div class="col-lg col-price">
            <div class="box">
              <div class="c1">1</div>
              <div class="c2">
                <h6>Paquete</h6>
                <h5>Ultra</h5>
              </div>

              <div class="c3">
                <h5>$1,900</h5>
              </div>
            </div>
          </div>

          <div class="col-lg col-icon">
            <i class="icon"></i>
          </div>
        </div>
      </div>

      <!-- Paso 2 -->
      <Step2 v-if="step == 2"></Step2>
      <!--  -->

      <!-- Paso 3 -->
      <Step3 v-if="step == 3"></Step3>
      <!--  -->

      <!-- Paso 4 -->
      <Step4 v-if="step == 4"></Step4>
      <!--  -->

    </section>

    <NextStepsComponent></NextStepsComponent>

  </b-form>
</template>

<script>
import NextStepsComponent from '../next-steps-component.vue'
import Step2 from './step-2.vue'
import Step3 from './step-3.vue'
import Step4 from './step-4.vue'
export default {
  components: {
    NextStepsComponent, Step2, Step3, Step4
  },

  data() {
    return {
      step: 1,
      showInfoForm: false,

      form: {
        graduacion: null,
        misdatos: {
          pregunta1: null,
        },
        plan: null,
      }
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
      console.log('onSubmit');

      if(this.step == 4) {
        this.step = 5;
        // Cosas del paso 4
      }

      if(this.step == 3) {
        this.step = 4;
        // Cosas del paso 3
      }

      if(this.step == 2) {
        this.step = 3;
        // Cosas del paso 2
      }

      if(this.step == 1) {
        if(!this.showInfoForm) {
          this.step = 2;
        }

        if(this.showInfoForm) {
          this.showInfoForm = false;
          this.step = 2;
        }
      }
    },
  },

  watch: {
    form: {
      handler(val){
        // this.step += 1;
        // window.scrollTo(0,0);
      },
      deep: true
    }
  }
}
</script>
