<template lang="html">
  <section class="step-1">
    <div class="container">
      <div class="box-title-top-1">
        <h2 class="title-s1 txt-purple">Elige tu paquete</h2>
      </div>

      <div class="box-packages">
        <swiper class="swiper" :options="packsOptions">
          <swiper-slide v-for="pkg in packages">
            <div class="box-package bg-aqua" v-bind:class="{ active: $parent.form.plan == pkg.id }"
              @click="handleSelectPackage(pkg)" :style="'background-color:' + pkg.color ?? '#00ffff'">
              <div class="box-name">
                <h6>{{ pkg.name }}</h6>
              </div>
              <div class="box-info">
                <h6 class="mb-2 title-1">Incluye</h6>
                <ul>
                  <li>Micas y antirreflejantes básicos.</li>
                  <li>Armazones básicos.</li>
                </ul>
              </div>
              <div class="box-price">
                <h6>${{ pkg.price }}</h6>
              </div>
            </div>
          </swiper-slide>

          <!-- <swiper-slide>
            <div class="box-package bg-pink" v-bind:class="{ active: $parent.form.plan == 2 }"
              @click="$parent.form.plan = 2">
              <div class="box-name">
                <h6>Paquete Pro</h6>
              </div>

              <div class="box-info">
                <h6 class="mb-2 title-1">Incluye</h6>

                <ul>
                  <li>Micas y antirreflejantes amplios y especializados.</li>
                  <li>Armazones Pro.</li>
                </ul>
              </div>

              <div class="box-price">
                <h6>$1,600</h6>
              </div>
            </div>
          </swiper-slide>

          <swiper-slide>
            <div class="box-package bg-purple" v-bind:class="{ active: $parent.form.plan == 3 }"
              @click="$parent.form.plan = 3">
              <div class="box-name">
                <h6>Paquete Ultra</h6>
              </div>

              <div class="box-info">
                <h6 class="mb-2 title-1">Incluye</h6>

                <ul>
                  <li>Micas y antirreflejantes amplios y especializados.</li>
                  <li>Armazones Ultra.</li>
                </ul>
              </div>

              <div class="box-price">
                <h6>$1,900</h6>
              </div>
            </div>
          </swiper-slide> -->

          <div class="swiper-button-prev" slot="button-prev"></div>
          <div class="swiper-button-next" slot="button-next"></div>
        </swiper>
      </div>

      <div class="box-bottom-navs">
        <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$parent.step = 2"
          v-if="$parent.form.plan">Siguiente</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      // == Carousels ==
      packsOptions: {
        slidesPerView: 3,
        spaceBetween: 10,

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },

        breakpoints: {
          1100: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          992: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          78: {
            slidesPerView: 1,
            spaceBetween: 0,
          },
        }
      },
      // == ==
      packages: []
    }
  },
  methods: {
    getPackages() {
      axios.get(tools.url("/api/packages")).then((response) => {
        this.packages = response.data.data;
        console.log("🚀 ~ file: step-1.vue:130 ~ axios.get ~ response.data:", response.data)
        jQuery('#table').bootstrapTable('removeAll');
        jQuery('#table').bootstrapTable('append', this.rows);
      }).catch((error) => {
        // console.log("🚀 ~ file: step-1.vue:153 ~ axios.get ~ error:", error)
      });
    },

    handleSelectPackage(pkg) {
      this.$parent.form.plan = pkg.id
      this.$parent.armazones = pkg.frames
      this.$parent.recubrimientos = pkg.antireflectives
      this.$parent.materiales = pkg.materials
    }
  },

  mounted() {
    this.getPackages()
  }
}
</script>
