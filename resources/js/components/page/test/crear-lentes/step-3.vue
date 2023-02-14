<template lang="html">
  <div class="box-step-wr step-4">
    <h2 class="h1s f-w-800 txt-blue">Diseña tus lentes a la medida</h2>

    <div class="container main-con">
      <div class="row">
        <div class="col-lg-6">
          <!-- Materiales -->
          <div class="mb-5 box-opt" @click="$parent.showModalMateriales = true">
            <div v-if="$parent.form.material">
              <small>Material:</small> {{ material.name }}
              <a class="icon-info" id="popover-material">
                <i class="fal fa-info-circle"></i>

                <b-popover target="popover-material" placement="top" custom-class="popover-glass-opt" triggers="hover">
                  {{ material.shortDescr }}
                </b-popover>
              </a>
            </div>

            <div v-else>Elige el material</div>
          </div>
          <!--  -->

          <!-- Recubrimiento -->
          <div class="mb-5 box-opt" @click="$parent.showModalRecubrimiento = true">
            <div v-if="$parent.form.recubrimiento">
              <small>Recubrimiento:</small> {{ recubrimiento.name }}
              <a class="icon-info" id="popover-recubrimiento">
                <i class="fal fa-info-circle"></i>

                <b-popover target="popover-recubrimiento" placement="top" custom-class="popover-glass-opt" triggers="hover">
                  {{ recubrimiento.shortDescr }}
                </b-popover>
              </a>
            </div>

            <div v-else>Elige el recubrimiento</div>
          </div>
          <!--  -->

          <!-- Armazón -->
          <div class="box-opt" @click="$parent.showModalArmazon = true">
            <div>Elige el armazón</div>
          </div>
          <!--  -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      material: {},
      recubrimiento: {},
    }
  },

  methods: {
    setMaterial() {
      this.material = this.$parent.materiales.find(x => x.id == this.$parent.form.material);
    },

    setRecubrimiento() {
      this.recubrimiento = this.$parent.recubrimientos.find(x => x.id == this.$parent.form.recubrimiento);
    },
  },

  watch: {
    '$parent.form.material'(val, oldVal) {
      this.setMaterial();
    },

    '$parent.form.recubrimiento'(val, oldVal) {
      this.setRecubrimiento();
    }
  },
}
</script>
