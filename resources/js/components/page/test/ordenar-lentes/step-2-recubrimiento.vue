<template lang="html">
  <b-modal modal-class="modal-glasses-design" ref="modal-material" title="Elige el recubrimiento" hide-footer centered no-close-on-esc no-close-on-backdrop @hidden="destroyComp">
    <b-form-radio-group class="radio-opts-s1"
      v-model="$parent.form.material"
      name="radio-materiales">
      <b-form-radio :value="m.id" v-for="(m, mInx) in opts" :key="'mInx-'+mInx">
        <div class="txt">
          <strong>{{ m.name }}</strong>
          <span>{{ m.shortDescr }}</span>
        </div>
      </b-form-radio>
    </b-form-radio-group>

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
