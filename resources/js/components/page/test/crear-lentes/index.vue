<template lang="html">
  <b-form id="get-glasses-page" @submit="onSubmit">
    <!-- Plan / Paquete seleccionado -->
    <div class="box-plan-selected" v-if="form.plan">
      <div class="container">
        <div class="col col-price">
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

        <div class="col col-icon">
          <i class="icon"></i>
        </div>
      </div>
    </div>
    <!--  -->

    <section class="first-section">
      <div class="container">
        <!-- Paso 1 -->
        <Step1 v-if="step == 1"></Step1>
        <!-- -->
      </div>
    </section>

    <!-- Sección amarilla (pasos 2, 3, 4) -->
    <section class="second-section">
      <!-- Paso 2 -->
      <Step2 v-if="step == 2"></Step2>
      <!--  -->

      <!-- Paso 3 -->
      <Step3 v-if="step == 3"></Step3>

      <Step3ModalMateriales :opts="materiales" v-if="showModalMateriales"></Step3ModalMateriales>
      <Step3ModalRecubrimiento :opts="recubrimientos" v-if="showModalRecubrimiento"></Step3ModalRecubrimiento>
      <Step3ModalArmazon :opts="armazones" v-if="showModalArmazon"></Step3ModalArmazon>
      <!--  -->

      <!-- Paso 4 -->
      <Step4 v-if="step == 4"></Step4>
      <!--  -->
    </section>

    <section class="third-section">
      <!-- Paso 5 -->
      <Step5 v-if="step == 5"></Step5>
      <!--  -->

      <!-- Paso 6 -->
      <Step6 v-if="step == 6"></Step6>
      <!--  -->
    </section>

    <StepsComponent :nstep="step"></StepsComponent>
  </b-form>
</template>

<script>
import StepsComponent from '../steps-component.vue';
import Step1 from './step-1.vue';
import Step2 from './step-2.vue';
import Step3 from './step-3.vue';
import Step3ModalMateriales from './step-3-modal-materiales.vue';
import Step3ModalRecubrimiento from './step-3-modal-recubrimiento.vue';
import Step3ModalArmazon from './step-3-modal-armazon.vue';
import Step4 from './step-4.vue';
import Step5 from './step-5.vue';
import Step6 from './step-6.vue';
export default {
  components: {
    StepsComponent,
    Step1,
    Step2,
    Step3, Step3ModalMateriales, Step3ModalRecubrimiento, Step3ModalArmazon,
    Step4,
    Step5,
    Step6,
  },

  data() {
    return {
      step: 6,
      showModalMateriales: false,     // Modal materiales
      showModalRecubrimiento: false,  // Modal recubrimientos
      showModalArmazon: false,         // Modal armazón

      // Materieles
      materiales: [
        { id: 1, name: 'Trivex',          shortDescr: 'Ideal para todo tipo de actividades' },
        { id: 2, name: 'Parasol',         shortDescr: 'Ideal para exteriores e interiores' },
        { id: 3, name: 'B/Block',         shortDescr: 'Ideal para uso de dispositivos digitales' },
        { id: 4, name: 'Trivex Parasol',  shortDescr: 'Ideal para todo tipo de actividades tanto en exterior como en interior' },
        { id: 5, name: 'Trivex 1.60',     shortDescr: 'Ideal para altas graduaciones' },
      ],

      // Recubrimientos
      recubrimientos: [
        { id: 1, name: 'Matiz E',       shortDescr: 'Ideal para todo tipo de actividades' },
        { id: 2, name: 'Matiz E Azul',  shortDescr: 'Ideal para uso de dispositivos digitales' },
        { id: 3, name: 'Matiz E Gold',  shortDescr: 'Ideal para uso dentro del automóvil' },
      ],

      // Armazones
      armazones: [
        { id: 1, imageUrl: 'public/images/pages/test/glasses-1.jpg', disabled: false, selected: false, name: 'Armazón 1',  shortDescr: 'Negro - Transparente / Pasta' },
        { id: 2, imageUrl: 'public/images/pages/test/glasses-2.jpg', disabled: false, selected: false, name: 'Armazón 2',  shortDescr: 'Negro / Pasta' },
        { id: 3, imageUrl: 'public/images/pages/test/glasses-3.jpg', disabled: true, selected: false, name: 'Armazón 3',  shortDescr: 'Negro - Rojo / Pasta' },
      ],

      form: {
        graduacion: null,
        misdatos: {
          pregunta1: null,
        },
        plan: null,
        material: null,
        recubrimiento: null,
        armazon: null,
        optica: null,
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
  },
}
</script>
