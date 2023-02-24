<template lang="html">
  <div id="cart-page" class="d-flex account-page">
    <div class="container main-box">

      <div class="row">
        <div class="col-12 px-2">
          <h1 class="mb-3 page-title">Historial de compras</h1>
        </div>

        <div class="col-lg px-2 col-menu">
          <div class="white-box">
            <div class="box-menu py-2">
              <!-- <p class="item">
                <router-link class="btn-menu" to="/mis-favoritos"><i class="fas fa-heart"></i> Mis favoritos</router-link>
              </p> -->
              <p class="item">
                <router-link class="btn-menu" to="/cart"><i class="fas fa-shopping-cart"></i> Mi carrito</router-link>
              </p>
              <p class="item">
                <router-link class="btn-menu" to="/historial-de-compras"><i class="fas fa-history"></i> Historial de compras</router-link>
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg px-2 col-cart-data">

          <div class="white-box">

            <div class="col-12 pt-3 product-list-table" v-if="$route.params.step !== 'envio' && $route.params.step !== 'pago'">
              <div class="col-12 px-0">
                <h5>Historial de compras</h5>
              </div>

              <div class="row row-products align-items-center row-history" v-for="(product, index) in form.products">
                <div class="col col-image">
                  <img :src="product.img">
                </div>

                <div class="col col-info">
                  <h5 class="txt-name">
                    <router-link target="_blank" to="/producto/1">{{ product.name }}</router-link>
                  </h5>
                </div>

                <div class="col col-status">
                  <h6>
                    <span class="label">Estatus: </span>
                    <span class="status text-success">Finalizado</span>
                  </h6>
                </div>
                <div class="col col-price">
                  <p>$ 560.00 MXN</p>
                </div>
                <div class="col col-num">
                  <p>10</p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form: {
        products: [
          { img: 'public/images/pages/products/product-h1.jpg', name: 'Nombre del producto', num: 0 },
          { img: 'public/images/pages/products/product-h5.jpg', name: 'Nombre del producto', num: 0 },
          { img: 'public/images/pages/products/product-h3.jpg', name: 'Nombre del producto', num: 0 },
          { img: 'public/images/pages/products/product-h4.jpg', name: 'Nombre del producto', num: 0 },
          { img: 'public/images/pages/products/product-h2.jpg', name: 'Nombre del producto', num: 0 },
        ]
      }
    }
  },

  methods: {}
}
</script>
