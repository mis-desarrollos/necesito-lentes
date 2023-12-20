<template lang="html">
  <b-form id="order-glasses-page" @submit="onSubmit">

    <!-- Paso 1 -->
    <Step1 v-if="step == 1"></Step1>
    <!--  -->

    <!-- Paso 2 -->
    <Step2 v-if="step == 2"></Step2>
    <ModalMateriales :opts="materiales" v-if="showModalMateriales"></ModalMateriales>
    <ModalRecubrimientos :opts="recubrimientos" v-if="showModalRecubrimientos"></ModalRecubrimientos>
    <ModalArmazones :opts="armazones" v-if="showModalArmazones"></ModalArmazones>
    <!--  -->

    <!-- Paso 3 -->
    <Step3 v-if="step == 3"></Step3>
    <!--  -->

    <!-- Paso 4 -->
    <Step4 v-if="step == 4"></Step4>
    <!--  -->

    <!-- Paso 5 -->
    <Step5 v-if="step == 5"></Step5>
    <!--  -->

    <!-- Paso 6 -->
    <Step6 v-if="step == 6"></Step6>
    <!--  -->

  </b-form>
</template>

<script>
import Step1 from './step-1.vue';
import Step2 from './step-2.vue';
import ModalMateriales from './step-2-modal-materiales.vue';
import ModalRecubrimientos from './step-2-recubrimiento.vue';
import ModalArmazones from './step-2-modal-armazones.vue';
import Step3 from './step-3.vue';
import Step4 from './step-4.vue';
import Step5 from './step-5.vue';
import Step6 from './step-6.vue';

export default {
  components: {
    Step1,
    Step2,
    ModalMateriales, ModalRecubrimientos, ModalArmazones,
    Step3,
    Step4,
    Step5,
    Step6,
  },

  data() {
    return {
      step: 1,
      showModalMateriales: false,     // Modal materiales
      showModalRecubrimientos: false,  // Modal recubrimientos
      showModalArmazones: false,         // Modal armazón

      // Materieles
      materiales: [
        { id: 1, name: 'Trivex',          description: 'Ideal para todo tipo de actividades.' },
        { id: 3, name: 'B/Block',         description: 'Ideal para uso de dispositivos digitales.' },
        { id: 2, name: 'Parasol',         description: 'Ideal para exteriores e interiores.' },
        { id: 4, name: 'Trivex Parasol',  description: 'Ideal para todo tipo de actividades en interiores y exteriores.' },
        { id: 5, name: 'Alto Índice',     description: 'Ideal para altas graduaciones.' },
      ],

      // Recubrimientos
      recubrimientos: [
        { id: 1, name: 'AR Green', color: 'green',  description: 'Ideal para personas muy sencibles a destellos.' },
        { id: 2, name: 'AR Blue', color: 'blue',    description: 'Ideal para uso de dispositivos digitales.' },
        { id: 3, name: 'AR Gold', color: 'gold',    description: 'Ideal para conducir de noche.' },
      ],

      // Armazones
      armazones: [
        { id: 1, imageUrl: 'public/images/pages/get-glasses/glasses-1.jpg', disabled: false, selected: false, name: 'Schopenhauer',  description: 'Pasta color negro' },
        { id: 2, imageUrl: 'public/images/pages/get-glasses/glasses-2.jpg', disabled: false, selected: false, name: 'Chomsky',  description: 'Metal color azul' },
        { id: 3, imageUrl: 'public/images/pages/get-glasses/glasses-3.jpg', disabled: true,  selected: false, name: 'Saturnino',  description: 'Pasta color café' },
        { id: 4, imageUrl: 'public/images/pages/get-glasses/glasses-4.jpg', disabled: false, selected: false, name: 'Arvo Pärt',  description: 'Metal color negro' },
        { id: 5, imageUrl: 'public/images/pages/get-glasses/glasses-5.jpg', disabled: false, selected: false, name: 'Chomsky',  description: 'Metal color café' },
        { id: 6, imageUrl: 'public/images/pages/get-glasses/glasses-6.jpg', disabled: false, selected: false, name: 'Saturnino',  description: 'Pasta color azul' },
        { id: 7, imageUrl: 'public/images/pages/get-glasses/glasses-1.jpg', disabled: false, selected: false, name: 'Schopenhauer',  description: 'Pasta color negro' },
        { id: 8, imageUrl: 'public/images/pages/get-glasses/glasses-2.jpg', disabled: false, selected: false, name: 'Chomsky',  description: 'Metal color azul' },
        { id: 9, imageUrl: 'public/images/pages/get-glasses/glasses-3.jpg', disabled: false,  selected: false, name: 'Saturnino',  description: 'Pasta color café' },
        { id: 10, imageUrl: 'public/images/pages/get-glasses/glasses-4.jpg', disabled: true, selected: false, name: 'Arvo Pärt',  description: 'Metal color negro' },
        { id: 11, imageUrl: 'public/images/pages/get-glasses/glasses-5.jpg', disabled: false, selected: false, name: 'Chomsky',  description: 'Metal color café' },
      ],

      // Formulario principal
      form: {
        plan: null,
        material: null,
        recubrimiento: null,
        tienda: {},
        paymentType: 'tarjeta',
      }
    }
  },

  methods: {
    onSubmit(event) {
      // event.preventDefault();
      // window.scrollTo(0,0);
      // console.log('onSubmit');
    }
  }
}
</script>
