<template lang="html">
  <b-form id="products-results-page" @submit="onSubmit">

    <section class="products-section">
      <div class="container oversized-container">
        <div class="row">
          <div class="col-12 box-breadcrumb-s1">
            <span>Home</span>
            <span>Armazones</span>
            <router-link to="">Para Hombre</router-link>
          </div>
        </div>

        <div class="row">
          <!-- Mobile filters -->
          <div class="col-12 col-filters-mobile">
            <div class="bg-filter-mv" v-if="showFilters == true" @click="showFilters = false"></div>
            <a class="btn-filters" @click="showFilters = !showFilters">
              <i class="fas fa-filter"></i><span>Ver filtros</span>
            </a>
          </div>
          <!--  -->

          <!-- Col filters -->
          <div class="col-lg col-filters" v-bind:class="{ 'show-filters': showFilters == true }">
            <h4 class="d-lg-none _title">
              <span><strong>Filtrar</strong></span>
              <a class="btn-hide" @click="showFilters = false"><i class="fas fa-chevron-left"></i></a>
            </h4>

            <div class="filters-container">
              <div class="box-filters">
                  <h6 class="group-f-title">Forma</h6>

                <b-form-group class="box-filters-group" v-slot="{ ariaDescribedby }">
                  <b-form-checkbox-group
                    v-model="formSearch.category"
                    :aria-describedby="ariaDescribedby"
                    name="fil-1">
                    <b-form-checkbox
                      :value="c.id"
                      v-for="(c, cInx) in formas"
                      :key="'cInx-'+cInx">
                      {{ c.name }}
                    </b-form-checkbox>
                  </b-form-checkbox-group>
                </b-form-group>
              </div>

              <div class="box-filters">
                <h6 class="group-f-title">Materiales</h6>

                <b-form-group class="box-filters-group" v-slot="{ ariaDescribedby }">
                  <b-form-checkbox-group
                    v-model="formSearch.brand"
                    :aria-describedby="ariaDescribedby"
                    name="fil-2">
                    <b-form-checkbox
                      :value="b.id"
                      v-for="(b, bInx) in materiales"
                      :key="'bInx-'+bInx">
                      {{ b.name }}
                    </b-form-checkbox>
                  </b-form-checkbox-group>
                </b-form-group>
              </div>

              <div class="box-filters">
                <h6 class="group-f-title">Recubrimiento </h6>

                <b-form-group class="box-filters-group" v-slot="{ ariaDescribedby }">
                  <b-form-checkbox-group
                    v-model="formSearch.recubrimiento"
                    :aria-describedby="ariaDescribedby"
                    name="fil-3">
                    <b-form-checkbox
                      :value="b.id"
                      v-for="(b, bInx) in recubrimientos"
                      :key="'bInx-'+bInx">
                      {{ b.name }}
                    </b-form-checkbox>
                  </b-form-checkbox-group>
                </b-form-group>
              </div>

              <div class="box-filters">
                <h6 class="group-f-title">Precio</h6>

                <b-form-group class="box-filters-group" v-slot="{ ariaDescribedby }">
                  <b-form-radio-group
                    v-model="formSearch.price"
                    :aria-describedby="ariaDescribedby"
                    name="fil-3">
                    <b-form-radio
                      :value="p.id"
                      v-for="(p, pInx) in price"
                      :key="'pInx-'+pInx">
                      {{ p.name }}
                    </b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
              </div>

              <div class="box-filters">
                <h6 class="group-f-title">Descuentos</h6>

                <b-form-group class="box-filters-group" v-slot="{ ariaDescribedby }">
                  <b-form-radio-group
                    v-model="formSearch.discount"
                    :aria-describedby="ariaDescribedby"
                    name="fil-4">
                    <b-form-radio
                      :value="d.id"
                      v-for="(d, dInx) in discounts"
                      :key="'dInx-'+dInx">
                      {{ d.name }}
                    </b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
              </div>

            </div>
          </div>
          <!--  -->

          <!-- Col products -->
          <div class="col-lg col-results">
            <div class="row">
              <div class="col-12 col-title">
                <h4 class="f-w-800 txt-blue">Para Hombre</h4>
              </div>

              <div class="col-sm-6 col-lg-6 col-xl-4 box-product-sample-s1" v-for="(p, pInx) in products" :key="'pInx-'+pInx">
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
            </div>

            <div class="row mt-4" v-if="pagination.total_products > 6">
              <div class="col-12 text-center">
                <div class="d-inline-block mx-0 col-pagination-sample-1">
                  <b-pagination-nav :link-gen="linkGen" :number-of-pages="pagination.total" use-router></b-pagination-nav>
                </div>
              </div>
            </div>
          </div>
          <!--  -->

        </div>
      </div>
    </section>

  </b-form>
</template>

<script>
export default {
  data() {
    return {
      showFilters: false,

      formas: [
        { id: 1, name: 'Circular' },
        { id: 10, name: 'Rectangular' },
        { id: 3, name: 'Trapezoide' },
        { id: 4, name: 'Cuadrados' },
        { id: 5, name: 'Alargados' },
      ],

      materiales: [
        { id: 1, name: 'Trivex' },
        { id: 2, name: 'Parasol' },
        { id: 3, name: 'B/Block' },
        { id: 4, name: 'Trivex Parasol' },
        { id: 5, name: 'Trivex 1.60' },
      ],

      recubrimientos: [
        { id: 1, name: 'Matiz E' },
        { id: 2, name: 'Matiz E Azul' },
        { id: 3, name: 'Matiz E Gold' },
      ],

      price: [
        { id: 1, name: '$0 - $199' },
        { id: 2, name: '$200 - $599' },
        { id: 3, name: '$600 - $999' },
        { id: 4, name: '$1,000 - $1,999' },
        { id: 5, name: '$2,000 - $2,999' },
        { id: 6, name: '$3,000 o más' },
      ],

      discounts: [
        { id: 1, name: '10%' },
        { id: 2, name: '20%' },
        { id: 3, name: '30%' },
      ],

      formSearch: {
        keywords: null,
        order: 1,
        category: [],
        price: null,
        discount: null,
      },

      products: [
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '180' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '89' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '196' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '119' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '169' },
        { imageUrl: 'public/images/pages/test/glasses-1.jpg', price: '269' },
        { imageUrl: 'public/images/pages/test/glasses-2.jpg', price: '169' },
      ],

      pagination:{
        currentpage: 1,
        total: 1,
        total_products: 16,
        number: 10
      },
    }
  },

  methods: {
    linkGen(pageNum) {
      return pageNum === 1 ? '?' : `?page=${pageNum}`
    },

    onSubmit(event) {
      event.preventDefault();
    },
  },

  mounted() {
  }
}
</script>
