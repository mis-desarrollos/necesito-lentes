<template lang="html">
  <section class="next-steps-section">

    <!-- Paso 2 al 4 -->
    <div class="box-step s-2" v-if="nstep <= 1">
      <div class="container"><i class="icon"></i></div>
    </div>
    <!--  -->

    <!-- Paso 5 al ... -->
    <div class="box-step s-3" v-if="nstep <= 4">
      <div class="container"><i class="icon"></i></div>
    </div>

    <div class="box-step s-4">
      <div class="container"><i class="icon"></i></div>
    </div>
    <!-- <div class="box-step s-5">
      <div class="container"><i class="icon"></i></div>
    </div> -->
  </section>
</template>

<script>
export default {
  props: [
    'nstep'
  ],

  data() {
    return {
    }
  },
}
</script>
