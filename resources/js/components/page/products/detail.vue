<template lang="html">
  <div id="product-description-page">

    <section class="breadcrumb-section">
      <div class="container oversized-container">
        <span>Home</span>
        <span class="line">/</span>
        <span>Armazones</span>
        <span class="line">/</span>
        <span>Armazón número 1</span>
      </div>
    </section>

    <section class="container oversized-container product-info-section">
      <div class="row">
        <div class="col-lg-6 col-gallery">
          <swiper class="swiper swiper-s1 pink" :options="galleryOptions">
            <swiper-slide>
              <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/test/glasses-1.jpg)' }">
                <img src="public/images/shared/glasses.png">
              </div>
            </swiper-slide>
            <swiper-slide>
              <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/test/glasses-1.jpg)' }">
                <img src="public/images/shared/glasses.png">
              </div>
            </swiper-slide>

            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
          </swiper>
        </div>

        <div class="col-lg-6 col-info">
          <h1 class="p-name">Armazón numero 1</h1>
          <h6 class="p-sku"><strong>SKU: </strong> AR01MDNC</h6>
          <h3 class="p-price"><span class="discount">$1,900</span> <span>$1,650</span></h3>

          <div class="mt-2 box-descr">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu deserunt mollit anim id est laborum.
          </div>

          <h6 class="mt-4 subtitle">Medidas:</h6>
          <div class="box-descr">
            <strong>Alto:</strong> 41mm | <strong>Ancho:</strong> 147mm | <strong>Largo:</strong> 145mm
          </div>

          <h6 class="mt-4 mb-1 subtitle">Material:</h6>
          <div class="box-descr">
            <div class="btn-opt" @click="showModalMateriales = true;">
              <span v-if="form.material"><small>Material: </small> {{ material.name }}</span>
              <span v-else>Selecciona un material</span>
            </div>
          </div>

          <h6 class="mt-4 mb-1 subtitle">Recubrimiento :</h6>
          <div class="box-descr">
            <div class="btn-opt" @click="showModalRecubrimiento = true;">
              <span v-if="form.recubrimiento"><small>Recubrimiento: </small> {{ recubrimiento.name }}</span>
              <span v-else>Selecciona un recubrimiento</span>
            </div>
          </div>

          <!-- <h6 class="mt-4 subtitle">Cantidad:</h6>
          <div class="col-quantity2 mt-2">
            <a class="form-control btn-q" @click="changeCantidad('-')">
              <i class="fas fa-minus"></i>
            </a>
            <b-form-input class="input-q" type="number" min="0" v-model="form.quantity" @keypress="isNumber($event)" @paste="noPaste" />
            <a class="form-control btn-q" @click="changeCantidad('+')">
              <i class="fas fa-plus"></i>
            </a>
          </div> -->

          <p class="mt-4">
            <button class="btn btn-s1 outline-blue px-5 btn-add" type="button" name="button">Agregar</button>
          </p>
        </div>
      </div>
    </section>

    <section class="container oversized-container related-products-section">
      <div class="d-block pb-4">
        <h4 class="txt-blue f-w-800">Productos relacionados</h4>
        <hr class="mt-1" />
      </div>

      <swiper class="swiper" :options="productsOptions">
        <swiper-slide v-for="(p, pInx) in products" :key="'pInx-'+pInx">
          <div class="col-12 px-0 box-product-sample-s1">
            <router-link class="box-link" to="/producto/1">
              <!-- <span class="bubble">Nuevo</span> -->
              <div class="placed-backg box-image" v-bind:style="{ backgroundImage: 'url('+p.imageUrl+')' }">
                <img src="public/images/shared/glasses.png">
              </div>

              <div class="box-descr">
                <h6 class="name">Armazón 1</h6>

                <div class="descr">
                  <p>Producto, descripción, información extra y más va aquí</p>
                </div>

                <h6 class="price">$ {{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(p.price) }}</h6>
              </div>
            </router-link>
          </div>
        </swiper-slide>

        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </section>

    <Step3ModalMateriales :opts="materiales" v-if="showModalMateriales"></Step3ModalMateriales>
    <Step3ModalRecubrimiento :opts="recubrimientos" v-if="showModalRecubrimiento"></Step3ModalRecubrimiento>

  </div>
</template>

<script>
import Step3ModalMateriales from '../test/crear-lentes/step-3-modal-materiales.vue';
import Step3ModalRecubrimiento from '../test/crear-lentes/step-3-modal-recubrimiento.vue';
export default {
  components: {
    Step3ModalMateriales,
    Step3ModalRecubrimiento
  },

  data() {
    return {
      showModalMateriales: false,     // Modal materiales
      showModalRecubrimiento: false,  // Modal recubrimientos
      material: {},
      recubrimiento: {},

      // Materieles
      materiales: [
        { id: 1, name: 'Trivex',          shortDescr: 'Ideal para todo tipo de actividades' },
        { id: 2, name: 'Parasol',         shortDescr: 'Ideal para exteriores e interiores' },
        { id: 3, name: 'B/Block',         shortDescr: 'Ideal para uso de dispositivos digitales' },
        { id: 4, name: 'Trivex Parasol',  shortDescr: 'Ideal para todo tipo de actividades tanto en exterior como en interior' },
        { id: 5, name: 'Trivex 1.60',     shortDescr: 'Ideal para altas graduaciones' },
      ],

      // Recubrimientos
      recubrimientos: [
        { id: 1, name: 'Matiz E',       shortDescr: 'Ideal para todo tipo de actividades' },
        { id: 2, name: 'Matiz E Azul',  shortDescr: 'Ideal para uso de dispositivos digitales' },
        { id: 3, name: 'Matiz E Gold',  shortDescr: 'Ideal para uso dentro del automóvil' },
      ],

      products: [
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '180' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '89' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '196' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '119' },
      ],

      // Formulario principal
      form: {
        quantity: 1,
        material: null,
        recubrimiento: null,
      },

      // == Carousel options ==
      galleryOptions: {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      },

      productsOptions: {
        slidesPerView: 4,
        spaceBetween: 30,

        pagination: {
          el: '.swiper-pagination',
          clickable: true
        },

        breakpoints: {
          1300: {
            slidesPerView: 4,
          },
          992: {
            slidesPerView: 3,
          },
          768: {
            slidesPerView: 2,
          },
          1: {
            slidesPerView: 1,
          },
        }
      }
      // == ==
    }
  },

  methods: {
    noPaste(evt){
      event.preventDefault();
    },

    isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode < 48 || charCode > 57) {
        evt.preventDefault();
      } else {
        return true;
      }
    },

    changeCantidad($type){
      this.form.quantity = parseInt(this.form.quantity);
      if ($type == '-') {
        this.form.quantity = (this.form.quantity > 1) ? --this.form.quantity : 1;
      }
      else{
        this.form.quantity = (this.form.quantity < 100) ? ++this.form.quantity : 100;
      }
    },

    setMaterial() {
      this.material = this.materiales.find(x => x.id == this.form.material);
    },

    setRecubrimiento() {
      this.recubrimiento = this.recubrimientos.find(x => x.id == this.form.recubrimiento);
    },
  },

  watch: {
    'form.material'(val, oldVal) {
      this.setMaterial();
    },

    'form.recubrimiento'(val, oldVal) {
      this.setRecubrimiento();
    },
  },
}
</script>
