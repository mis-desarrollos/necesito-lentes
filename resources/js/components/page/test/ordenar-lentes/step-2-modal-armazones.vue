<template lang="html">
  <b-modal modal-class="modal-glasses-design" ref="modal-armazones" title="Elige el armazón" hide-footer centered no-close-on-esc no-close-on-backdrop scrollable @hidden="destroyComp">
    <b-form-radio-group
      class="box-glasses"
      v-model="$parent.form.armazon"
      name="radio-armazones">
      <b-form-radio :disabled="a.disabled" class="col" :value="a.id" v-for="(a, aInx) in opts" :key="'aInx-'+aInx">
        <div class="box-eyeglasses-s1"  v-bind:class="{ 'not-av' : a.disabled }">
          <div class="not-available"><h6>Disponible en paquete Ultra</h6></div>

          <div class="img">
            <img src="public/images/pages/get-glasses/glasses-1.jpg">
          </div>

          <div class="info">
            <h6 class="name">{{ a.name }}</h6>

            <div class="descr">
              {{ a.shortDescr }}
            </div>
          </div>
        </div>
      </b-form-radio>
    </b-form-radio-group>

    <div class="box-btns-bottom" v-if="$parent.form.armazon">
      <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$refs['modal-armazones'].hide();">Agregar</button>
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
      this.$parent.showModalArmazones = false;
    }
  },

  mounted() {
    this.$refs['modal-armazones'].show();
  }
}
</script>
