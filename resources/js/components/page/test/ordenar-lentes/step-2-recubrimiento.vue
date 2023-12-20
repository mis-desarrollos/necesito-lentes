<template lang="html">
  <b-modal modal-class="modal-glasses-design" ref="modal-recubrimientos" title="Elige el antirreflejante" hide-footer centered no-close-on-esc no-close-on-backdrop @hidden="destroyComp">
    <div class="box-extra-info">
      El antirreflejante es un recubrimiento que se coloca en ambas superficies de las lentes y sus principal función es evitar los moletos reflejos.
    </div>

    <b-form-radio-group class="radio-opts-s1 w-asterisk"
      v-model="$parent.form.recubrimiento"
      name="radio-materiales">
      <b-form-radio :value="m.id" :class="m.color" v-for="(m, mInx) in opts" :key="'mInx-'+mInx">
        <div class="txt">
          <strong>{{ m.name }}</strong>
          <span>{{ m.description }}</span>
        </div>
      </b-form-radio>
    </b-form-radio-group>

    <div class="d-block mt-4 text-center" v-if="$parent.form.recubrimiento">
      <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$refs['modal-recubrimientos'].hide();">Agregar</button>
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
      this.$parent.showModalRecubrimientos = false;
    }
  },

  mounted() {
    this.$refs['modal-recubrimientos'].show();
  }
}
</script>
