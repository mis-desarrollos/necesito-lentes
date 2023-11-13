<template lang="html">
  <div class="box-step-wr padding-b-plan step-4">
    <div class="wr">
      <div class="col-12">
        <h2 class="h1s f-w-800 txt-blue">¡Diseñaste tus lentes!</h2>
      </div>

      <div class="container main-con">
        <div class="row">
          <div class="col-lg-12 col-info">
            <h5><small>Armazón:</small> Armazón 1</h5>
            <h5><small>Material:</small> B/Block</h5>
            <h5><small>Recubrimiento:</small> Matiz E</h5>
            <h5><small>Paquete:</small> Ultra por $ 1,900</h5>
          </div>
        </div>

        <div class="row">
          <div class="col-12 mt-5 text-center col-btn-navs">
            <b-button type="button" class="btn btn-lg btn-s1 outline-white" @click="$parent.step = 3;">Regresar</b-button>
            <b-button type="button" class="btn btn-lg btn-s1 bg-blue" @click="$parent.step = 5;">Continuar</b-button>
          </div>
        </div>
      </div>

      <div class="box-head-s1"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      material: {},
      recubrimiento: {},
      armazon: {},
    }
  },

  methods: {
    setMaterial() {
      this.material = this.$parent.materiales.find(x => x.id == this.$parent.form.material);
    },

    setRecubrimiento() {
      this.recubrimiento = this.$parent.recubrimientos.find(x => x.id == this.$parent.form.recubrimiento);
    },

    setArmazon() {
      this.armazon = this.$parent.armazones.find(x => x.id == this.$parent.form.armazon);
    },
  },

  watch: {
    '$parent.form.material'(val, oldVal) {
      this.setMaterial();
    },

    '$parent.form.recubrimiento'(val, oldVal) {
      this.setRecubrimiento();
    },

    '$parent.form.armazon'(val, oldVal) {
      this.setArmazon();
    },
  },
}
</script>
