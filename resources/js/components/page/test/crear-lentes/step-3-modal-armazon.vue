<template lang="html">
  <b-modal modal-class="modal-glasses-opts modal-g-step-material" ref="modal-lentes-armazon" size="xl" title="Elige el armazón que más te guste" centered hide-footer @hidden="destroyComp">
    <b-form id="get-glasses-page" @submit="onSubmit" class="row">
      <div class="col-lg-8 col-xl-6">
        xxxx
      </div>

      <div class="col-12 col-nav-buttons">
        <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Siguiente</b-button>
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
      this.$refs['modal-lentes-armazon'].hide();
    },

    destroyComp () { // Se activa al cerrar el modal. Destroye este componente
      this.$parent.showModalArmazon = false;
    }
  },

  mounted() {
    this.$refs['modal-lentes-armazon'].show();
  },
}
</script>
