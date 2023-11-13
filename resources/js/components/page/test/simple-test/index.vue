<template lang="html">
  <b-form id="basic-test-page-v2" @submit="onSubmit">

    <section class="questions-section" v-bind:class="{ 'res-0' : result == 0, 'res-1' : result == 1, 'res-2' : result == 2 }">
      <div class="container">
        <!-- <div class="d-block text-center mb-3">
          <h2 class="h1s f-w-800 txt-blue">Test de la vista</h2>
        </div> -->

        <div class="box-progress">
          <div class="box-icons">
            <div class="icon icon-1"></div>
            <div class="icon icon-2"></div>
          </div>

          <b-progress :max="max" height="50px">
            <b-progress-bar :value="step">
              <span class="num"><!--{{ step }}--></span>
            </b-progress-bar>
          </b-progress>
        </div>

        <!-- Pregunta 1 -->
        <div class="box-content" v-if="step == 1">
          <p class="text-center">
            <span class="box-step-icon ic-1"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Cuantos años tienes?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res1 = 1"><span>No llego </span><span>a los 25</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res1 = 2"><span>Entre 25 </span><span>y 40 años</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res1 = 3"><span>Más de </span><span>40 años</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 2 -->
        <div class="box-content" v-if="step == 2">
          <p class="text-center">
            <span class="box-step-icon ic-2"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Eres gamer?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res2 = 1"><span>No, </span><span>para nada</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res2 = 2"><span>Juego, </span><span>pero no tanto</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res2 = 3"><span>Si, </span><span>de los buenos</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 3 -->
        <div class="box-content" v-if="step == 3">
          <p class="text-center">
            <span class="box-step-icon ic-3"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Lo tuyo es el home office?</h2>
          <div class="box-answers a2">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res3 = 1"><span>Nop</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res3 = 2"><span>Ajá</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 4 -->
        <div class="box-content" v-if="step == 4">
          <p class="text-center">
            <span class="box-step-icon ic-4"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Pasas mucho tiempo<br />frente al celular?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res4 = 1"><span>No. Menos </span><span>de una hora al día</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res4 = 2"><span>Si. </span><span>La verdad sí</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 5 -->
        <div class="box-content" v-if="step == 5">
          <p class="text-center">
            <span class="box-step-icon ic-5"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Alguna vez has confundido<br />a un amigo a lo lejos?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res5 = 1"><span>No, Nunca</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res5 = 2"><span>Jajajjaj, si</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 6 -->
        <div class="box-content" v-if="step == 6">
          <p class="text-center">
            <span class="box-step-icon ic-6"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Aprietas los ojos<br />cuando ves de lejos?</h2>
          <div class="box-answers a2">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res6 = 1"><span>No, para nada</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res6 = 2"><span>Si</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 7 -->
        <div class="box-content" v-if="step == 7">
          <p class="text-center">
            <span class="box-step-icon ic-7"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿A veces tienes los ojos rojos<br />y no sabes por qué?</h2>
          <div class="box-answers a2">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res7 = 1"><span>Nop</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res7 = 2"><span>Sí</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 8 -->
        <div class="box-content" v-if="step == 8">
          <p class="text-center">
            <span class="box-step-icon ic-8"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Te cuesta trabajo leer<br />esas letritas del menú<br />del restaurante?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res8 = 1"><span>Nop</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res8 = 2"><span>Mmm, a veces</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res8 = 3"><span>Siempre</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 9 -->
        <div class="box-content" v-if="step == 9">
          <p class="text-center">
            <span class="box-step-icon ic-9"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Has estado tentado<br />a aumentar el tamaño<br />de letra de tu celular?</h2>
          <div class="box-answers a2">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res9 = 1"><span>Nunca</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res9 = 2"><span>Si</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Final -->
        <div class="box-content" v-if="step == 10">
          <!-- No necesitas lentes -->
          <div class="box-result" v-if="result == 0">
            <h2 class="mb-4 h1s f-w-800 txt-green">Todo indica que por lo pronto no necesitas lentes.</h2>
            <h3 class="mb-4 h3 f-w-500">Aunque nunca está de más estar pendiente de tu salud visual, asi que revísate continuamente.</h3>
            <h3 class="h3 f-w-800">Puedes volver acá cuando quieras.</h3>
          </div>
          <!--  -->

          <!-- Quizas necesitas lentes -->
          <div class="box-result" v-if="result == 1">
            <h2 class="mb-4 h1s f-w-800 txt-pink">Nop. Todo indica que aún no necesitas lentes.<br />Pero casi.</h2>
            <h3 class="mb-4 h3 f-w-500">Por tu estilo de vida es muy recomendable que estés pendiente de cualquier señal, asi que no está de más darte una vuelta por acá en unos 6 meses.</h3>
            <h3 class="h3 f-w-800">¡Nos vemos pronto!</h3>
          </div>
          <!--  -->

          <!-- Necesitas lentes -->
          <div class="box-result" v-if="result == 2">
            <h2 class="mb-4 h1s f-w-800 txt-purple">Sí, todo indica que necesites lentes.</h2>
            <h3 class="mb-3 h3 f-w-500">Igual que el 70% de la población, asi que nada de qué sorprenderse.</h3>
            <h3 class="mb-4 h3 f-w-500">Lo que sigue es que te hagas un examen de la vsta en una óptica cercana, para que te diagnostique y te dé la graduación exacta para tus primeros lentes.</h3>
            <h3 class="h3 mb-5 f-w-800">¡Obtenlos en 3 sencillos pasos!</h3>

            <p>
              <router-link class="btn btn-lg btn-s1 bg-blue" to="/obtener-lentes">Continuar</router-link>
            </p>
          </div>
          <!--  -->
        </div>
      </div>
    </section>

    <StepsComponent></StepsComponent>

  </b-form>
</template>

<script>
import StepsComponent from '../steps-component.vue'
export default {
  components: {
    StepsComponent
  },

  data() {
    return {
      step: 1,
      max: 10,
      result: null, // (0) Necesita & (1) Quizas & (2) No necesita lentes

      form: {
        res1: null,
        res2: null,
        res3: null,
        res4: null,
        res5: null,
        res6: null,
        res7: null,
        res8: null,
        res9: null,
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

        if(this.step == 10) {
          this.result = Math.floor(Math.random() * 3); // Random para mostrar
        }
      },
      deep: true
    }
  }
}
</script>
