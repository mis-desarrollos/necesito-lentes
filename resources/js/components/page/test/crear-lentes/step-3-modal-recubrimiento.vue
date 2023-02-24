<template lang="html">
  <b-modal modal-class="modal-glasses-opts modal-g-step-material" ref="modal-lentes-recubrimiento" size="xl" title="Elige el recubrimiento indicado para ti" centered hide-footer no-close-on-backdrop no-close-on-esc @hidden="destroyComp">
    <b-form id="get-glasses-page" @submit="onSubmit" class="row">
      <div class="col-lg-8 col-xl-6">
        <b-form-radio-group class="box-radio-options-s1" required v-model="$parent.form.recubrimiento" name="r-material">
          <b-form-radio :value="m.id" v-for="(m, mInx) in opts" :key="'mInx-'+mInx">
            <div class="col-5 col-lg-6 col-name">{{ m.name }}</div>
            <div class="col-7 col-lg-6 col-descr">{{ m.shortDescr }}</div>
          </b-form-radio>
        </b-form-radio-group>
      </div>

      <div class="col-12 col-nav-buttons">
        <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Continuar</b-button>
      </div>
    </b-form>
  </b-modal>
</template>

<script>
export default {
  props: [
    'opts'
  ],

  methods: {
    onSubmit(event) {
      event.preventDefault();
      this.$refs['modal-lentes-recubrimiento'].hide();
    },

    destroyComp () { // Se activa al cerrar el modal. Destroye este componente
      this.$parent.showModalRecubrimiento = false;
    }
  },

  mounted() {
    this.$refs['modal-lentes-recubrimiento'].show();
  },
}
</script>
