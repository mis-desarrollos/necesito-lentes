<template lang="html">
  <section class="step-2" v-bind:class="{ 'plan-1' : $parent.form.plan == 1, 'plan-2' : $parent.form.plan == 2, 'plan-3' : $parent.form.plan == 3 }">
    <div class="container">
      <div class="box-title-top-1">
        <h2 class="title-s1">Diseña tus lentes</h2>
      </div>

      <div class="box-glasses-design">
        <div class="row">
          <!-- Material -->
          <div class="col-sm-10 col-md-8 col-lg-4 col-design">
            <div class="box-design" @click="$parent.showModalMateriales = true;">
              <div class="box-icon">
                <img src="public/images/pages/get-glasses/icon-material.svg" alt="">
              </div>

              <div class="box-title">
                <h5>Material</h5>
              </div>

              <div class="box-selected centered" v-if="material">
                <h6 class="name">{{ material.name }}</h6>
              </div>
            </div>
          </div>
          <!--  -->

          <!-- Recubrimiento -->
          <div class="col-sm-10 col-md-8 col-lg-4 col-design">
            <div class="box-design" @click="$parent.showModalRecubrimientos = true;">
              <div class="box-icon">
                <img src="public/images/pages/get-glasses/icon-recubrimiento.svg" alt="">
              </div>

              <div class="box-title">
                <h5>Recubrimiento</h5>
              </div>

              <div class="box-selected centered" v-if="recubrimiento">
                <h6 class="name"><i :class="'far fa-asterisk ic-asterisk '+recubrimiento.color"></i> {{ recubrimiento.name }}</h6>
              </div>
            </div>
          </div>
          <!--  -->

          <!-- Armazón -->
          <div class="col-sm-10 col-md-8 col-lg-4 col-design">
            <div class="box-design" @click="$parent.showModalArmazones = true;">
              <div class="box-icon">
                <img src="public/images/pages/get-glasses/icon-armazon.svg" alt="">
              </div>

              <div class="box-title">
                <h5>Armazón</h5>
              </div>

              <div class="box-selected centered" v-if="armazon">
                <div class="selected-glasses">
                  <div class="glasses">
                    <img :src="armazon.imageUrl">
                  </div>

                  <h6 class="name">{{ armazon.name }}</h6>
                  <p class="descr">{{ armazon.shortDescr }}</p>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
        </div>
      </div>

      <div class="box-bottom-navs nav-multi-btns">
        <button type="button" name="button" class="btn _btn btn-s2 outline-gray btn-sm" @click="$parent.step = 1">Anterior</button>
        <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$parent.step = 3" v-if="showNextBTN">Agregar al carrito</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      showNextBTN: false,

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

    checkStatus() {
      if(this.material && this.recubrimiento && this.armazon) {
        this.showNextBTN = true;
      }
    },
  },

  watch: {
    '$parent.form.material'(val, oldVal) {
      this.setMaterial();
      this.checkStatus();
    },

    '$parent.form.recubrimiento'(val, oldVal) {
      this.setRecubrimiento();
      this.checkStatus();
    },

    '$parent.form.armazon'(val, oldVal) {
      this.setArmazon();
      this.checkStatus();
    },
  },

  mounted() {
    this.setMaterial();
    this.setRecubrimiento();
    this.setArmazon();
  },
}
</script>
