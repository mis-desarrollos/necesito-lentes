<template lang="html">
  <b-form id="get-glasses-page" @submit="onSubmit">
    <!-- Para ver el la INFORMACIÓN del formulario siempre visible -->
    <!-- <pre class="form-info-box">{{ form }}</pre> -->

    <!-- Plan / Paquete seleccionado -->
    <PlanSelected :plan="form.plan" v-if="form.plan"></PlanSelected>
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

      <!-- Paso 7 -->
      <Step7 v-if="step == 7"></Step7>
      <!--  -->
    </section>

    <section class="fourth-section">
      <!-- Paso 8 -->
      <Step8 v-if="step == 8"></Step8>
      <!--  -->

      <!-- Paso 9 -->
      <Step9 v-if="step == 9"></Step9>
      <!--  -->
    </section>

    <section class="five-section">
      <!-- Paso 10 -->
      <Step10 v-if="step == 10"></Step10>
      <!--  -->
    </section>

    <StepsComponent :nstep="step"></StepsComponent>
  </b-form>
</template>

<script>
import StepsComponent from '../steps-component.vue';
import PlanSelected from './plan-selected.vue';
import Step1 from './step-1.vue';
import Step2 from './step-2.vue';
import Step3 from './step-3.vue';
import Step3ModalMateriales from './step-3-modal-materiales.vue';
import Step3ModalRecubrimiento from './step-3-modal-recubrimiento.vue';
import Step3ModalArmazon from './step-3-modal-armazon.vue';
import Step4 from './step-4.vue';
import Step5 from './step-5.vue';
import Step6 from './step-6.vue';
import Step7 from './step-7.vue';
import Step8 from './step-8.vue';
import Step9 from './step-9.vue';
import Step10 from './step-10.vue';
export default {
  components: {
    StepsComponent,
    PlanSelected,
    Step1,
    Step2,
    Step3, Step3ModalMateriales, Step3ModalRecubrimiento, Step3ModalArmazon,
    Step4,
    Step5,
    Step6,
    Step7,
    Step8,
    Step9,
    Step10,
  },

  data() {
    return {
      step: 1,
      showModalMateriales: false,     // Modal materiales
      showModalRecubrimiento: false,  // Modal recubrimientos
      showModalArmazon: false,         // Modal armazón

      // Planes
      plans: [
        { id: 1, color: '#00226b', name: 'Ultra', price: '1,900' },
        { id: 2, color: '#006b78', name: 'Pro', price: '1,600' },
        { id: 3, color: '#eaedec', name: 'Novato', price: '1,200' },
      ],

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

      // Formulario principal
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
        fecha: null,
        hora: null,

        nombre: null,
        email: null,
        contrasena: null,
        confcontrasena: null,

        formadePago: null,
      },
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
      window.scrollTo(0,0);
      console.log('onSubmit');

      if(this.step == 10) {
        this.$router.push('/finalizado')
        // Codigo para el paso 10
      }

      if(this.step == 6) {
        this.step = 7;
        // Codigo para el paso 6
      }

      if(this.step == 4) {
        this.step = 5;
        // Codigo para el paso 4
      }

      if(this.step == 3) {
        this.step = 4;
        // Codigo para el paso 3
      }

      if(this.step == 2) {
        this.step = 3;
        // Codigo para el paso 2
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
        // X codigo
      },

      deep: true
    },

    'step'(val, oldVal) {
      window.scrollTo(0,0);
    },
  },
}
</script>
