<template lang="html">
  <b-form id="order-glasses-page" @submit="onSubmit">

    <!-- Paso 1 -->
    <Step1></Step1>
    <!--  -->

  </b-form>
</template>

<script>
import Step1 from './step-1.vue';
export default {
  components: {
    Step1,
  },

  data() {
    return {
      step: 1,

      // Formulario principal
      form: {
        plan: null,
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
