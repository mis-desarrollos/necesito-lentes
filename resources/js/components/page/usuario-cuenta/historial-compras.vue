<template lang="html">
  <div class="col-cart-data loggedin-cart">

    <div class="col-12 pt-3 product-list-table">
      <div class="row row-products align-items-center row-history" v-if="!pedidos.length">
        No existen movimientos en este momento.
      </div>

      <div class="row" v-for="(order, index) in pedidos" :key="index" v-bind:class=" index > 0 ? 'mt-2': ''">
          <div class="col">
              <div class="card card-2">
                  <div class="card-body">
                      <div class="media">
                          <div class="media-body my-auto text-right">
                              <div class="row my-auto flex-column flex-md-row">
                                  <div class="col-auto my-auto ">
                                      <h6 class="mb-0"><router-link :to="'/usuario/pedido/'+order.id">Pedido ID MX000{{ order.id }}</router-link></h6>
                                  </div>
                                  <div class="col my-auto "> <small>Fecha: {{ order.date }} </small></div>
                                  <div class="col my-auto "> <small>Estatus: {{ order.status }}</small></div>
                                  <div class="col my-auto ">
                                      <h6 class="mb-0">$ {{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(order.total) }}</h6>
                                  </div>
                              </div>
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
      pedidos: [],
      id: null,
      estatus: ''
    }
  },

  methods: {
    getHistorial(){
      axios.get(tools.url("/api/user/orders")).then((response)=>{
        this.pedidos = response.data;
      }).catch((error)=>{
          console.log(error);
      });
    },
  },

  mounted(){
    if(this.$root.logged){
        this.getHistorial();
    }
  }

}
</script>
