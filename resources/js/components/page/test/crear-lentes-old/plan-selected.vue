<template lang="html">
  <div class="box-plan-selected">
    <div class="container">
      <div class="col col-price">
        <div class="box" v-bind:class="{ 'pack-1': plan == 1, 'pack-2': plan == 2, 'pack-3': plan == 3 }">
          <div class="c1">1</div>
          <div class="c2">
            <h6>Paquete</h6>
            <h5>{{ selectedPlan.name }}</h5>
          </div>

          <div class="c3">
            <h5>${{ selectedPlan.price }}</h5>
          </div>
        </div>
      </div>

      <div class="col col-icon">
        <i class="icon"></i>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'plan'
  ],

  data() {
    return {
      selectedPlan: {}
    }
  },

  methods: {
    getPlan() {
      this.selectedPlan = {};

      for (var i = 0; i < this.$parent.plans.length; i++) {
        if(this.$parent.plans[i].id == this.plan) {
          this.selectedPlan = this.$parent.plans[i];
        }
      }
    }
  },

  beforeMount() {
    this.getPlan();
  },

  watch: {
    '$parent.form.plan'(val, oldVal) {
      this.getPlan();
    },
  }
}
</script>
