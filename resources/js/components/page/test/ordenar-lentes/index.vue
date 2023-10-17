<template lang="html">
  <b-form id="order-glasses-page" @submit="onSubmit">

    <!-- Paso 1 -->
    <Step1 v-if="step == 1"></Step1>
    <!--  -->

    <!-- Paso 2 -->
    <Step2 v-if="step == 2"></Step2>
    <ModalMateriales :opts="materiales" v-if="showModalMateriales"></ModalMateriales>
    <ModalRecubrimiento :opts="recubrimientos" v-if="showModalRecubrimientos"></ModalRecubrimiento>
    <!--  -->

  </b-form>
</template>

<script>
import Step1 from './step-1.vue';
import Step2 from './step-2.vue';
import ModalMateriales from './step-2-modal-materiales.vue';
import ModalRecubrimiento from './step-2-recubrimiento.vue';

export default {
  components: {
    Step1,
    Step2,
    ModalMateriales, ModalRecubrimiento,
  },

  data() {
    return {
      step: 2,
      showModalMateriales: false,     // Modal materiales
      showModalRecubrimientos: false,  // Modal recubrimientos
      showModalArmazon: false,         // Modal armazón

      // Materieles
      materiales: [
        { id: 1, name: 'Trivex',          shortDescr: 'Ideal para todo tipo de actividades.' },
        { id: 3, name: 'B/Block',         shortDescr: 'Ideal para uso de dispositivos digitales.' },
        { id: 2, name: 'Parasol',         shortDescr: 'Ideal para exteriores e interiores.' },
        { id: 4, name: 'Trivex Parasol',  shortDescr: 'Ideal para todo tipo de actividades en interiores y exteriores.' },
        { id: 5, name: 'Alto Índice',     shortDescr: 'Ideal para altas graduaciones.' },
      ],

      // Recubrimientos
      recubrimientos: [
        { id: 1, name: 'AR Green', color: 'green',  shortDescr: 'Ideal para personas muy sencibles a destellos.' },
        { id: 2, name: 'AR Blue', color: 'blue',    shortDescr: 'Ideal para uso de dispositivos digitales.' },
        { id: 3, name: 'AR Gold', color: 'gold',    shortDescr: 'Ideal para conducir de noche.' },
      ],

      // Formulario principal
      form: {
        plan: 3,
        material: null,
        recubrimiento: null,
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
