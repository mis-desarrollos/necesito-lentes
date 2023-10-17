<template lang="html">
  <b-modal modal-class="modal-glasses-design" ref="modal-material" title="Elige el armazón" hide-footer centered no-close-on-esc no-close-on-backdrop @hidden="destroyComp">
    <div class="box-glasses">
      <div class="col-lg-6 col-eyeglasses">
        <div class="box-eyeglasses">

        </div>
      </div>

      <div class="col-lg-6 col-eyeglasses">
        xx
      </div>
    </div>

    <div class="d-block mt-4 text-center" v-if="$parent.form.material">
      <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$refs['modal-material'].hide();">Agregar</button>
    </div>
  </b-modal>
</template>

<script>
export default {
  props: [
    'opts'
  ],

  methods: {
    destroyComp () { // Se activa al cerrar el modal. Destroye este componente
      this.$parent.showModalMateriales = false;
    }
  },

  mounted() {
    this.$refs['modal-material'].show();
  }
}
</script>
