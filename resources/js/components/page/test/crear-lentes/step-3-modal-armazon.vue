<template lang="html">
  <b-modal modal-class="modal-glasses-opts modal-g-step-armazon" ref="modal-lentes-armazon" size="lg" title="Elige el armazón que más te guste" centered hide-footer no-close-on-backdrop no-close-on-esc @hidden="destroyComp">
    <b-form id="get-glasses-page" @submit="onSubmit" class="row">
      <div class="col-lg-10 col-carousel" v-bind:class="{ 'loading' : !showCarousel }">
        <swiper class="swiper" :options="carouselOptions" v-if="showCarousel">
          <swiper-slide v-for="(a, aInx) in $parent.armazones" :key="'aInx-'+aInx">
            <div class="box-opt" v-bind:class="{ 'disabled' : a.disabled, 'active' : a.selected }">
              <div class="inside" @click="selectArmazon(aInx)">
                <div class="box-legend">
                  <div>No disponible en éste paquete</div>
                </div>

                <div class="box-image">
                  <div class="image" v-bind:style="{ backgroundImage: 'url('+a.imageUrl+')' }">
                    <img src="public/images/pages/test/glasses.png">
                  </div>
                </div>

                <div class="box-info">
                  <h5 class="name">{{ a.name }}</h5>
                  <div class="descr" v-html="a.shortDescr"></div>
                </div>
              </div>
            </div>
          </swiper-slide>


          <div class="swiper-button-prev" slot="button-prev"></div>
          <div class="swiper-button-next" slot="button-next"></div>
        </swiper>
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

  data() {
    return {
      showCarousel: false,

      // == Carousels options ==
      carouselOptions: {
        loop: true,

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      }
      // == ==
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();

      if(this.$parent.form.armazon) {
        this.$refs['modal-lentes-armazon'].hide();
      }
    },

    resetArmazones() {
      for (var i = 0; i < this.$parent.armazones.length; i++) {
        this.$parent.armazones[i].selected = false;
      }
    },

    selectArmazon(idx) {
      this.$parent.form.armazon = this.$parent.armazones[idx].id;
      this.resetArmazones();
      this.$parent.armazones[idx].selected = true;
    },

    destroyComp () { // Se activa al cerrar el modal. Destroye este componente
      this.$parent.showModalArmazon = false;
    }
  },

  mounted() {
    this.$refs['modal-lentes-armazon'].show();

    // Resetear
    this.$parent.form.armazon = null;
    this.resetArmazones();

    setTimeout(() => {
      this.showCarousel = true;
    }, 600);
  },
}
</script>
