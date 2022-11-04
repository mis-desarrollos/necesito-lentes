<template>
  <div id="home">
      <h2 class="title text-center">LaraVue</h2>
      <div class="container text-center seccion">
          <p>Este proyecto utiliza las tecnologias estandar de que Laravel propone para el desarrollo en su framework, en este caso tiene como intencion que el programador use las tecnologias de Vue para el front-end haciendo uso de webpack con laravel-mix para la compilacion de archivos css, less,sass y js.</p>
      </div>

      <!-- ======================= Documentacion ======================= -->
      <div class="container seccion">
          <div class="row">
              <div class="col-md-3 col-sm-6 col-12">
                  <router-link to="/instalation" tag="div" class="tarjeta">
                      <h4 class="title">Instalación</h4>
                      <div class="image">
                          <i class="fas fa-archive fa-3x"></i>
                      </div>
                      <p class="descript">Guia basica de instalacion.</p>
                  </router-link>
              </div>
              <div class="col-md-3 col-sm-6 col-12">
                  <router-link to="/backend" tag="div" class="tarjeta">
                      <h4 class="title">Backend</h4>
                      <div class="image">
                          <i class="fas fa-cogs fa-3x"></i>
                      </div>
                      <p class="descript">Documentacion basica del backend</p>
                  </router-link>
              </div>
              <div class="col-md-3 col-sm-6 col-12">
                  <router-link to="/frontend" tag="div" class="tarjeta">
                      <h4 class="title">Frontend</h4>
                      <div class="image">
                          <i class="fas fa-desktop fa-3x"></i>
                      </div>
                      <p class="descript">Documentacion basica del frontend</p>
                  </router-link>
              </div>
              <div class="col-md-3 col-sm-6 col-12">
                  <router-link to="/tutorials" tag="div" class="tarjeta">
                      <h4 class="title">Tutoriales</h4>
                      <div class="image">
                          <i class="far fa-clone fa-3x"></i>
                      </div>
                      <p class="descript">Tutoriales sobre componentes y plugins</p>
                  </router-link>
              </div>
          </div>
      </div>
      <!-- ======================= Documentacion ======================= -->
  </div>
</template>

<script type="text/javascript">
	export default {
    data(){
      return{
        swiperOption: {
          effect: 'fade',
          spaceBetween: 30,

          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },

          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
        }
      }
    },

    methods: {
    showAlert() {
      // Use sweetalert2
      this.$swal('Hello Vue world!!!');
    },
  },
        mounted() {
            console.log('Home mounted.');
        }
    }
</script>
