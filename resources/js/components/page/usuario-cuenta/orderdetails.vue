<template lang="html">
  <div class="col-cart-data loggedin-cart">

    <div class="card card-1">
        <div class="card-body">
            <div class="row justify-content-between mb-3">
                <div class="col-auto">
                    <h6 class="color-1 mb-0 change-color">Recibo</h6>
                </div>
                <div class="col-auto "> <small>Estatus : {{ order.status }}</small> </div>
            </div>

            <div class="row" v-for="(detail, index) in orderDetail" :key="index" >
                <div class="col">
                    <div class="card card-2">
                        <div class="card-body">
                            <div class="media">
                                <div class="sq align-self-center ">
                                    <img class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" :src="detail.imageUrl" width="50" height="50" />
                                </div>
                                <div class="media-body my-auto text-right">
                                    <div class="row my-auto flex-column flex-md-row">
                                        <div class="col-auto my-auto ">
                                            <h6 class="mb-0">{{ detail.product.name }}</h6>
                                        </div>
                                        <div class="col my-auto "> <small>SKU: {{ detail.product.sku }} </small></div>
                                        <!-- <div class="col my-auto "> <small>Talla : L</small></div> -->
                                        <div class="col my-auto "> <small>Cantidad: {{ detail.quantity }}</small></div>
                                        <div class="col my-auto ">
                                            <h6 class="mb-0">{{ detail.price }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p class="mb-1 text-dark"><b>Detalles del pedido</b></p>
                        </div>
                        <div class="flex-sm-col text-right col">
                            <p class="mb-1"><b>Total</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                            <p class="mb-1">$ {{ order.subtotal }}</p>
                        </div>
                    </div>
                    <!-- <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col">
                            <p class="mb-1"> <b>Descuento</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                            <p class="mb-1">$150</p>
                        </div>
                    </div> -->
                   <!--  <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col">
                            <p class="mb-1"><b>IVA 16%</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                            <p class="mb-1">$ {{ order.tax }}</p>
                        </div>
                    </div> -->
                    <div class="row justify-content-between">
                        <div class="flex-sm-col text-right col">
                            <p class="mb-1"><b>Los gastos de envío</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                            <p class="mb-1">{{ order.shippingCost }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row invoice">
                <div class="col">
                    <p class="mb-1"> Número de pedido : MX000{{ order.id }}</p>
                    <p class="mb-1">Fecha del pedido : {{ order.date }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="jumbotron-fluid">
                <div class="row justify-content-between ">
                    <div class="col-auto my-auto ">
                        <h2 class="mb-0 font-weight-bold">TOTAL</h2>
                    </div>
                    <div class="col-auto my-auto ml-auto">
                        <h1 class="display-3 ">{{ order.total }}</h1>
                    </div>
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
        id: null,
        order: [],
        orderDetail: []
    }
  },

  methods: {

    getContent: function(id){
      axios.get(tools.url('/api/user/order/'+id)).then(({data}) =>{
        this.order = data.order;
        this.orderDetail = data.orderDetail;
      }).catch((error)=>{
        console.log(error);
        this.$router.push("/");
      })
    },

  },

  mounted(){
    if(this.$route.params.id){
        this.id = this.$route.params.id;
        this.getContent(this.$route.params.id);
    }else{
        this.$router.push("/");
    }
  },

  watch: {
    '$route':function(){
      if(this.$route.params.id){
        this.id = this.$route.params.id;
        this.getContent(this.$route.params.id);
      }
    }
  }

}
</script>
