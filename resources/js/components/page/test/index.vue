<template lang="html">
  <b-form id="basic-test-page" @submit="onSubmit">

    <section class="questions-section" v-bind:class="{ 'step6' : step == 6 }">
      <div class="container">
        <div class="box-progress">
          <div class="box-icons">
            <div class="icon icon-1"></div>
            <div class="icon icon-2"></div>
          </div>

          <b-progress :max="max" height="40px">
            <b-progress-bar :value="step">
              <span class="num">{{ step }}</span>
            </b-progress-bar>
          </b-progress>
        </div>

        <!-- Pregunta 1 -->
        <div class="box-content" v-if="step == 1">
          <p class="text-center">
            <span class="num-circle">1</span>
          </p>

          <h2 class="mt-4 mb-3 question">Aquí la primera pregunta del test</h2>
          <div class="box-answers">
            <p class="mb-3">
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res1 = 1">Respuesta 1</b-button>
            </p>
            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res1 = 2">Respuesta 2</b-button>
            </p>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 2 -->
        <div class="box-content" v-if="step == 2">
          <p class="text-center">
            <span class="num-circle">2</span>
          </p>

          <h2 class="mt-4 mb-3 question">Aquí la segunda pregunta del test</h2>
          <div class="box-answers">
            <p class="mb-3">
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res2 = 1">Respuesta 1</b-button>
            </p>
            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res2 = 2">Respuesta 2</b-button>
            </p>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 3 -->
        <div class="box-content" v-if="step == 3">
          <p class="text-center">
            <span class="num-circle">3</span>
          </p>

          <h2 class="mt-4 mb-3 question">Aquí la tercer pregunta del test</h2>
          <div class="box-answers">
            <p class="mb-3">
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res3 = 1">Respuesta 1</b-button>
            </p>
            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res3 = 2">Respuesta 2</b-button>
            </p>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 4 -->
        <div class="box-content" v-if="step == 4">
          <p class="text-center">
            <span class="num-circle">4</span>
          </p>

          <h2 class="mt-4 mb-3 question">Aquí la cuarta pregunta del test</h2>
          <div class="box-answers">
            <p class="mb-3">
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res4 = 1">Respuesta 1</b-button>
            </p>
            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res4 = 2">Respuesta 2</b-button>
            </p>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 5 -->
        <div class="box-content" v-if="step == 5">
          <p class="text-center">
            <span class="num-circle">5</span>
          </p>

          <h2 class="mt-4 mb-3 question">Aquí la quinta pregunta del test</h2>
          <div class="box-answers">
            <p class="mb-3">
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res5 = 1">Respuesta 1</b-button>
            </p>
            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="form.res5 = 2">Respuesta 2</b-button>
            </p>
          </div>
        </div>
        <!--  -->

        <!-- Final -->
        <div class="box-content" v-if="step == 6">
          <!-- No necesitas lentes -->
          <div v-if="result == 0">
            <h2 class="mb-4 h1s f-w-800 txt-blue">Todo indica que <span class="txt-white">no</span> necesitas lentes</h2>
            <p class="mb-4 h2 f-w-600 txt-blue">De cualquier manera te recomendamos estar al pendiente periódicamente de tu salud visual.</p>
            <p class="mb-2">
              <router-link class="h4 f-w-600 txt-white" to="/obtener-lentes"><u>De cualquier forma, quiero unos lentes</u></router-link>
            </p>

            <p>
              <img class="img-fluid" src="public/images/pages/test/head-1.png">
            </p>
          </div>
          <!--  -->

          <!-- Necesitas lentes -->
          <div v-if="result == 1">
            <h2 class="mb-4 h1s f-w-800 txt-blue">Todo indica que <span class="txt-white">sí</span> necesitas lentes</h2>
            <p class="mb-4 h2 f-w-600 txt-blue">Aquí tus lentes en 3 simples pasos.</p>
            <p class="mb-2">
              <router-link class="link-go-glasses" to="/obtener-lentes"><i class="fas fa-chevron-circle-down"></i></router-link>
            </p>

            <p>
              <img class="img-fluid" src="public/images/pages/test/head-1.png">
            </p>
          </div>
          <!--  -->
        </div>
      </div>
    </section>

    <NextStepsComponent></NextStepsComponent>

  </b-form>
</template>

<script>
import NextStepsComponent from './next-steps-component.vue'
export default {
  components: {
    NextStepsComponent
  },

  data() {
    return {
      step: 1,
      max: 6,
      result: null, // Necesita & No necesita lentes

      form: {
        res1: null,
        res2: null,
        res3: null,
        res4: null,
        res5: null,
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
