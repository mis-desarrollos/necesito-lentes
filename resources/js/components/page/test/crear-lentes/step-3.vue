<template lang="html">
  <div class="box-step-wr padding-b-plan step-3">
    <div class="wr">
      <div class="col-12">
        <h2 class="h1s f-w-800 txt-blue">Diseña tus lentes a la medida</h2>
      </div>

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
              <div v-if="$parent.form.armazon">
                <small>Armazón:</small> {{ armazon.name }}
                <a class="icon-info" id="popover-armazon">
                  <i class="fal fa-info-circle"></i>

                  <b-popover target="popover-armazon" placement="top" custom-class="popover-glass-opt" triggers="hover">
                    {{ armazon.shortDescr }}
                  </b-popover>
                </a>
              </div>

              <div v-else>Elige el armazón</div>
            </div>
            <!--  -->
          </div>
        </div>

        <div class="row">
          <div class="col-12 mt-5 pt-4 text-center col-btn-navs"
            v-if="this.$parent.form.material && this.$parent.form.recubrimiento && this.$parent.form.armazon">
            <b-button type="button" class="btn btn-lg btn-s1 outline-white" @click="$parent.step = 2;">Regresar</b-button>
            <b-button type="button" class="btn btn-lg btn-s1 bg-blue" @click="$parent.step = 4;">Continuar</b-button>
          </div>
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

  mounted() {
    this.setMaterial();
    this.setRecubrimiento();
    this.setArmazon();
  }
}
</script>
