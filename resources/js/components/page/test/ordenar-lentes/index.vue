<template lang="html">
  <b-form id="order-glasses-page" @submit="onSubmit">

    <!-- Paso 1 -->
    <Step1 v-if="step == 1"></Step1>
    <!--  -->

    <!-- Paso 2 -->
    <Step2 v-if="step == 2"></Step2>
    <!--  -->

  </b-form>
</template>

<script>
import Step1 from './step-1.vue';
import Step2 from './step-2.vue';
export default {
  components: {
    Step1,
    Step2,
  },

  data() {
    return {
      step: 2,

      // Formulario principal
      form: {
        plan: 3,
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
