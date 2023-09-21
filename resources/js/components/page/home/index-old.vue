<template lang="html">
  <div id="home-page">

    <section class="banner-section">
      <swiper class="swiper swiper-s1 blue desktop" :options="bannersOptions">
        <swiper-slide v-for="(b, bhInx) in banners" :key="'bhInx-'+bhInx">
          <router-link class="placed-backg box" v-bind:style="{ backgroundImage: 'url('+b.imageUrl+')' }" to="/test">
            <img src="public/images/pages/home/banner.png">
          </router-link>
        </swiper-slide>

        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
      </swiper>

      <swiper class="swiper swiper-s1 blue mobile" :options="bannersOptions">
        <swiper-slide v-for="(b, bhmInx) in banners" :key="'bhmInx-'+bhmInx">
          <router-link class="placed-backg box" v-bind:style="{ backgroundImage: 'url('+b.imageMobUrl+')' }" to="/test">
            <img src="public/images/pages/home/banner-m.png">
          </router-link>
        </swiper-slide>

        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
      </swiper>
    </section>

  </div>
</template>

<script>
export default {
  data() {
    return {
      banners: [
        { imageUrl: 'public/images/pages/home/banner-1.jpg', imageMobUrl: 'public/images/pages/home/banner-1-m.jpg' },
      ],

      // == Carousel options ==
      bannersOptions: {
        loop: true,
        speed: 800,
        effect: 'fade',

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },

        autoplay: {
          delay: 6000,
          disableOnInteraction: false
        },
      },
      // == ==
    }
  },
}
</script>
