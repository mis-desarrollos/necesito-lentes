<template lang="html">
  <b-form id="basic-test-page-v2" @submit="onSubmit">

    <section class="questions-section" v-bind:class="{ 'res-0' : result == 0, 'res-1' : result == 1, 'res-2' : result >= 2 && result <= 6 }">
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
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res1 = 10"><span>No llego </span><span>a los 25</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res1 = 50"><span>Entre 25 </span><span>y 40 años</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res1 = 75"><span>Más de </span><span>40 años</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 2 -->
        <div class="box-content" v-if="step == 2">
          <div>
            <p class="text-center">
              <span class="box-step-icon ic-2"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Eres gamer?</h2>
            <div class="box-answers">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res2 = 0"><span>No, </span><span>para nada</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res2 = 20"><span>Juego, </span><span>pero no tanto</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res2 = 70"><span>Si, </span><span>de los buenos</span></b-button>
            </div>
          </div>

          <div>
            <p class="text-center">
              <span class="box-step-icon ic-3"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Lo tuyo es el home office?</h2>
            <div class="box-answers a2">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res2 = 0"><span>Nop</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res2 = 70"><span>Ajá</span></b-button>
            </div>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 3 -->
        <div class="box-content" v-if="step == 3">
          <p class="text-center">
            <span class="box-step-icon ic-4"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿Pasas mucho tiempo<br />frente al celular?</h2>
          <div class="box-answers">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res3 = 0"><span>No. Menos </span><span>de una hora al día</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res3 = 40"><span>Si. </span><span>La verdad sí</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 4 -->
        <div class="box-content" v-if="step == 4">
          <div>
            <p class="text-center">
              <span class="box-step-icon ic-5"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Alguna vez has confundido<br />a un amigo a lo lejos?</h2>
            <div class="box-answers">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res4 = 0"><span>No, Nunca</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res4 = 30"><span>Jajajjaj, si</span></b-button>
            </div>
          </div>

          <div>
            <p class="text-center">
              <span class="box-step-icon ic-6"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Aprietas los ojos<br />cuando ves de lejos?</h2>
            <div class="box-answers a2">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res4 = 0"><span>No, para nada</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res4 = 35"><span>Si</span></b-button>
            </div>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 5 -->
        <div class="box-content" v-if="step == 5">
          <p class="text-center">
            <span class="box-step-icon ic-7"></span>
          </p>

          <h2 class="mt-3 mb-3 question">¿A veces tienes los ojos rojos<br />y no sabes por qué?</h2>
          <div class="box-answers a2">
            <b-button type="submit" class="btn btn-sp-1 green" @click="form.res5 = 0"><span>Nop</span></b-button>
            <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res5 = 20"><span>Sí</span></b-button>
          </div>
        </div>
        <!--  -->

        <!-- Pregunta 6 -->
        <div class="box-content" v-if="step == 6">
          <div>
            <p class="text-center">
              <span class="box-step-icon ic-8"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Te cuesta trabajo leer<br />esas letritas del menú<br />del restaurante?</h2>
            <div class="box-answers">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res6 = 10"><span>Nop</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 pink" @click="form.res6 = 20"><span>Mmm, a veces</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res6 = 30"><span>Siempre</span></b-button>
            </div>
          </div>

          <div>
            <p class="text-center">
              <span class="box-step-icon ic-9"></span>
            </p>

            <h2 class="mt-3 mb-3 question">¿Has estado tentado<br />a aumentar el tamaño<br />de letra de tu celular?</h2>
            <div class="box-answers a2">
              <b-button type="submit" class="btn btn-sp-1 green" @click="form.res6 = 0"><span>Nunca</span></b-button>
              <b-button type="submit" class="btn btn-sp-1 purple" @click="form.res6 = 30"><span>Si</span></b-button>
            </div>
          </div>
        </div>
        <!--  -->

        <!-- Final -->
        <div class="box-content" v-if="step == 7">
          <!-- No necesitas lentes -->
          <div class="box-result" v-if="result == 0">
            <h2 class="mb-4 h1s f-w-700 txt-green">Todo indica que por lo pronto no necesitas lentes.</h2>
            <h3 class="mb-4 h3 f-w-400">Aunque nunca está de más estar pendiente de tu salud visual, asi que revísate continuamente.</h3>
            <h3 class="h3 f-w-700">Puedes volver acá cuando quieras.</h3>
          </div>
          <!--  -->

          <!-- Quizas necesitas lentes -->
          <div class="box-result" v-if="result == 1">
            <h2 class="mb-4 h1s f-w-700 txt-pink">Nop. Todo indica que aún no necesitas lentes.<br />Pero casi.</h2>
            <h3 class="mb-4 h3 f-w-400">Por tu estilo de vida es muy recomendable que estés pendiente de cualquier señal, asi que no está de más darte una vuelta por acá en unos 6 meses.</h3>
            <h2 class="h2 f-w-700">¡Nos vemos pronto!</h2>
          </div>
          <!--  -->

          <!-- Necesitas lentes (General) -->
          <div class="box-result" v-if="result == 2">
            <h2 class="mb-4 h1s f-w-700 txt-purple">Sí, todo indica que necesites lentes.</h2>
            <h3 class="mb-3 h3 f-w-400">Igual que el 70% de la población, asi que nada de qué sorprenderse.</h3>
            <h3 class="mb-4 h3 f-w-400">Lo que sigue es que te hagas un examen de la vsta en una óptica cercana, para que te diagnostique y te dé la graduación exacta para tus primeros lentes.</h3>
            <h2 class="h2 mb-5 f-w-700">¡Obtenlos en 3 sencillos pasos!</h2>

            <p>
              <router-link class="btn btn-lg btn-s1 bg-blue" to="/obtener-lentes">Continuar</router-link>
            </p>
          </div>
          <!--  -->

          <!-- Necesitas lentes (Tras paso 1) -->
          <div class="box-result" v-if="result == 3">
            <h2 class="mb-3 h1s f-w-700 txt-purple">¡Ey!, no tienes que seguir haciendo el test.<br />Casi todas las personas mayores de 40 necesitan lentes sí o sí.</h2>
            <h3 class="mb-4 h3 f-w-400">Lo que sigue es que te hagas un examen de la vista en una óptica cercana, para que te diagnostique y te dé la graduación exacta para tus primeros lentes.</h3>
            <h2 class="h2 mb-5 f-w-700">¡Obtenlos en 3 sencillos pasos!</h2>

            <p>
              <router-link class="btn btn-lg btn-s1 bg-blue" to="/obtener-lentes">Continuar</router-link>
            </p>
          </div>
          <!--  -->

          <!-- Necesitas lentes (Tras paso 2-A) -->
          <div class="box-result" v-if="result == 4">
            <h2 class="mb-3 h1s f-w-700 txt-purple">¡Bien! Pero seguro pasas horas frente a la pantalla. Tus ojos necesitan lentes sí o sí.</h2>
            <h3 class="mb-4 h3 f-w-400">Lo que sigue es que te hagas un examen de la vista en una óptica cercana, para que te diagnostique y te recomiende los lentes que mejor vayan a tu forma de vida.</h3>
            <h2 class="h2 mb-5 f-w-700">¡Obtenlos en 3 sencillos pasos!</h2>

            <p>
              <router-link class="btn btn-lg btn-s1 bg-blue" to="/obtener-lentes">Continuar</router-link>
            </p>
          </div>
          <!--  -->

          <!-- Necesitas lentes (Tras paso 2-B) -->
          <div class="box-result" v-if="result == 5">
            <h2 class="mb-3 h1s f-w-700 txt-purple">Seguro pasas horas frente a la pantalla. Tus ojos necesitan lentes sí o sí.</h2>
            <h3 class="mb-4 h3 f-w-400">Lo que sigue es que te hagas un examen de la vista en una óptica cercana, para que te diagnostique y te recomiende los lentes que mejor vayan a tu forma de vida.</h3>
            <h2 class="h2 mb-5 f-w-700">¡Obtenlos en 3 sencillos pasos!</h2>

            <p>
              <router-link class="btn btn-lg btn-s1 bg-blue" to="/obtener-lentes">Continuar</router-link>
            </p>
          </div>
          <!--  -->

          <!-- Necesitas lentes (Tras paso 4) -->
          <div class="box-result" v-if="result == 6">
            <h2 class="mb-3 h1s f-w-700 txt-purple">Definitivamente necesitas lentes. Pero no te preocupes, la mayoría los necesitamos en algún momento.</h2>
            <h3 class="mb-4 h3 f-w-400">Lo que sigue es que te hagas un examen de la vista en una óptica cercana, para que te diagnostique y te recomiende los lentes que mejor vayan a tu forma de vida.</h3>
            <h2 class="h2 mb-5 f-w-700">¡Obtenlos en 3 sencillos pasos!</h2>

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
      max: 7,
      result: null, // (0) No Necesita & (1) Quizas & (2 al 6) Necesita lentes

      form: {
        res1: null,
        res2: null,
        res3: null,
        res4: null,
        res5: null,
        res6: null,
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

        if(this.step == 7) {
          this.result = Math.floor(Math.random() * 7); // Random para mostrar
        }
      },
      deep: true
    }
  }
}
</script>
