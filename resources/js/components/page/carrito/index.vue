<template lang="html">
  <div id="cart-page" class="d-flex account-page">
    <div class="container main-box">

      <div class="row">
        <div class="col-12 px-2">
          <h1 class="mb-3 page-title">Mi carrito</h1>
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
              <!-- <p class="item">
                <router-link class="btn-menu" to="/mis-favoritos"><i class="fas fa-heart"></i> Mis favoritos</router-link>
              </p> -->
              <!-- <p class="item">
                <router-link class="btn-menu" to="/historial-de-compras"><i class="fas fa-history"></i> Historial de compras</router-link>
              </p> -->
            </div>
          </div>
        </div>

        <div class="col-lg px-2 col-cart-data">

          <!-- <div class="white-box"> -->
          <b-form class="white-box" @submit.prevent="">

            <!-- Paso 1 (Lista de productos agregados a carrito) -->
            <div class="col-12 pt-3 product-list-table" v-if="$route.params.step !== 'envio' && $route.params.step !== 'pago'">
              <div class="col-12 px-0">
                <h5>Productos agregados al carrito</h5>

                <h6 class="mt-4 pb-4 f-w-400 text-warning" v-if="!form.products.length"><i class="far fa-shopping-cart"></i> Ningun producto ha sido agregado al carrito</h6>
              </div>

              <div class="row row-products" v-for="(product, index) in form.products">
                <div class="col col-image">
                  <img :src="product.imageUrl">
                </div>

                <div class="col col-info">
                  <h5 class="txt-name">
                    <router-link target="_blank" :to="'/producto/'+product.id">{{ product.name }}</router-link>
                  </h5>

                  <div class="row mx-0 align-items-center">
                    <div class="d-flex">
                      <h6 class="txt-sm text-muted">SKU: {{ product.sku }}</h6>
                    </div>
                    <div class="d-flex">
                      <div class="box-color-opt opt-sm">
                        <!-- <a class="color" title="Color x" v-bind:style="{ backgroundColor: '#e63003' }">{{ product.color }}</a> -->
                        <!-- <a class="color" :title="product.color">{{ product.color }}</a>
                        <a class="color" :title="product.size">{{ product.size }}</a> -->
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0 mb-1" />

                  <router-link class="link-sm text-muted" target="_blank" :to="'/producto/'+product.id">Ver producto</router-link> <span class="mx-2">|</span> <a class="link-sm text-danger" @click="removeCart(index)"><i class="far fa-trash-alt"></i> Quitar</a>
                </div>

                <div class="col col-price">
                  <p>$ {{ product.price }} MXN</p>
                </div>
                <div class="col col-num">
                  <b-form-input v-model.number="product.quantity" type="number" min="1" :max="product.stock" placeholder="0" @change="updateCart" />
                </div>
              </div>
            </div>
            <!-- paso 1, Fin -->

            <!-- Paso 2 (Envio, Datos del usuario y datos de envío) -->
            <div class="col-12 py-4 px-4 user-data" v-if="$route.params.step == 'envio'">
                <h6>Datos de personales</h6>
                <hr class="c-hr" />

                <div class="custom-input _p">
                    <label class="col-form-label pt-0">Nombre:</label>
                    <p class="txt-simple" v-if="$root.logged">{{ form.user.name }}</p>
                    <b-form-input id="user-name" v-else type="text" v-model="form.user.name" size="sm" required placeholder="Nombre"/>
                </div>

                <div class="custom-input _p">
                    <label class="col-form-label pt-0">Apellidos:</label>
                    <p class="txt-simple" v-if="$root.logged" v-text="form.user.lastname"></p>
                    <b-form-input id="user-lastname" v-else type="text" v-model="form.user.lastname" size="sm" required placeholder="Apellidos"/>
                </div>

                <div class="custom-input _p">
                    <label class="col-form-label pt-0">Correo electrónico:</label>
                    <p class="txt-simple" v-if="$root.logged" v-text="form.user.email"></p>
                    <b-form-input id="user-email" v-else type="text" v-model="form.user.email" size="sm" required placeholder="Correo electrónico"/>
                </div>

                <div class="custom-input _p">
                    <label class="col-form-label pt-0">Teléfono:</label>
                    <b-form-input id="user-phone" type="text" v-model="form.user.phone" size="sm" required placeholder="Teléfono" maxlength="10"/>
                </div>


                <h6 class="mt-5">Información de envío</h6>
                <hr class="c-hr" />

                <!-- <div class="row mx-0 no-gutters">
                    <div class="col-md-12">
                        <b-form-group class="custom-input" label="Tipo de entrega:" label-for="i-entrega">
                            <v-select v-model="form.shippingMethod" :options="['Enviar a domicilio', 'Recoger en tienda']" placeholder="Tipo de entrega"/>
                        </b-form-group>
                    </div>
                </div> -->

                <div >
                    <div class="row mx-0 no-gutters">
                        <div class="col-md-7 col-lg-6">
                        <b-form-group class="custom-input" label="Calle:" label-for="i-calle">
                            <b-form-input id="i-calle" type="text" v-model="form.user.street" size="sm" placeholder="Calle donde vive" required/>
                        </b-form-group>
                        </div>

                        <div class="col-md pl-md-3">
                        <b-form-group class="custom-input" label="Numero exterior:" label-for="i-num">
                            <b-form-input id="i-num" type="text" v-model="form.user.num_ext" size="sm" required/>
                        </b-form-group>
                        </div>

                        <div class="col-md pl-md-3">
                        <b-form-group class="custom-input" label="Numero interior:" label-for="i-num">
                            <b-form-input id="i-num" type="text" v-model="form.user.num_int" size="sm"/>
                        </b-form-group>
                        </div>
                    </div>

                    <div class="row mx-0 no-gutters">
                        <div class="col-md-8">
                        <b-form-group class="custom-input" label="Colonia:" label-for="i-colonia">
                            <b-form-input id="i-colonia" type="text" v-model="form.user.neighborhood" size="sm" required placeholder="Escriba su colonia" />
                        </b-form-group>
                        </div>

                        <div class="col-md pl-md-3">
                        <b-form-group class="custom-input" label="Código postal:" label-for="i-cp">
                            <b-form-input id="i-cp" type="text" v-model="form.user.zipcode" size="sm" required placeholder="Escriba su código postal" />
                        </b-form-group>
                        </div>
                    </div>


                    <div class="row mx-0 no-gutters">
                        <div class="col-md-6 pr-md-3">
                        <b-form-group class="custom-input" label="Estado:" label-for="i-estado">
                            <v-select v-model="form.user.state_id" :options="states" label="name" index="id" @change="getTowns"/>
                        </b-form-group>
                        </div>

                        <div class="col-md-6">
                        <b-form-group class="custom-input" label="Ciudad:" label-for="i-ciudad">
                            <v-select v-model="form.user.town_id" :options="towns" label="name" index="id"/>
                        </b-form-group>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Paso 2, fin  -->

            <!-- Paso 3 (pago) -->
            <div class="col-12 py-4 px-4 user-data" v-if="$route.params.step == 'pago'">
              <h6>Información de pago</h6>
              <hr class="c-hr" />

              <div class="custom-input _p">
                <label class="col-form-label pt-0">Seleccione una forma de pago:</label>
              </div>

              <div class="row mb-4 payment-options-container">
                 <div class="col col-box" @click="changePaymentMe('tarjetas')">
                  <div class="box" v-bind:class="{ active: form.tipoPago == 'tarjetas' }">
                    <h6>Tarjeta de crédito o débito</h6>
                    <p class="icons">
                      <i class="fab fa-cc-visa"></i>
                      <i class="fab fa-cc-mastercard"></i>
                    </p>
                  </div>
                </div>

                <div class="col col-box" @click="changePaymentMe('transferencia')">
                  <div class="box" v-bind:class="{ active: form.tipoPago == 'transferencia' }">
                    <h6>Deposito o transferencia</h6>
                    <p class="icons">
                      <i class="fas fa-money-check-alt"></i>
                      <i class="fas fa-money-bill"></i>
                    </p>
                  </div>
                </div>

                <!-- <div class="col col-box" @click="changePaymentMe('paypal')">
                  <div class="box" v-bind:class="{ active: form.tipoPago == 'paypal' }">
                    <h6>Pago a traves de Paypal</h6>
                    <p class="icons">
                      <i class="fab fa-paypal"></i>
                    </p>
                  </div>
                </div> -->
              </div>

              <!-- Pago 1, con tarjetas -->
              <div class="row mx-0 no-gutters" v-if="form.tipoPago == 'tarjetas'">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        Sus datos de tarjeta de debito o de credito no son almacenados por nuestro sistema y son procesados de manera segura y encriptada. En cada pago sera necesario agregar nuevamente estos datos.
                    </div>

                    <label class="mt-3">Detalles de tarjeta:</label>
                    <div id="cardElement"></div>
                    <small class="form text text-muted" id="cardErrors" role="alert"></small>
                </div>
              </div>
              <!--  -->

              <!-- Pago 2, con transferencia bancaria -->
              <div class="col-12 text-center" v-if="form.tipoPago == 'transferencia'">
                <img src="public/images/hsbc.png" width="100">
                <p><strong>BANCO:</strong> HSBC</p>
                <p><strong>TITULAR:</strong> BANCO X.</p>
                <p><strong>CLABE INTERBANCARIA:</strong> 12345678912345601</p>
                <p><strong>NÚMERO DE CUENTA:</strong>120450002005</p>
                <hr />
                <p>
                  Favor de enviarnos el comprobante de pago al siguiente correo: <br />
                  <strong>pago@mipaw.com.mx</strong>
                </p>
              </div>
              <!--  -->

              <!-- Pago 3, con paypal -->
              <div class="col-12 text-center" v-if="form.tipoPago == 'paypal'">
                <p>Depósito por medio de paypal.</p>

                <hr />
                <p>
                  Favor de enviarnos el comprobante de pago al siguiente correo: <br />
                  <strong>pago@mipaw.com.mx</strong>
                </p>
              </div>
              <!--  -->
            </div>
            <!-- Paso 3, fin -->
          </b-form>

          <div class="row mx-0 py-3 px-lg-0 no-gutters row-total">
            <div class="col-lg-6">
              <router-link class="btn btn-outline-danger btn-sm btn-action" :to="'/cart/' + form.prev" v-if="form.prev != null">Anterior</router-link>
              <router-link class="btn btn-outline-danger btn-sm btn-action" :to="'/cart/' + form.next" v-if="form.next">Siguiente</router-link>
              <!-- <button class="btn btn-danger btn-sm btn-action" v-if="form.paying && form.tipoPago == 'transferencia'" @click="createOrder()" :disabled="order_id">Confirmar pedido</button> -->
              <button class="btn btn-danger btn-sm btn-action" v-if="form.paying && form.tipoPago == 'transferencia'" @click="pagar()" :disabled="desactivar || order_id">Confirmar pedido</button>
              <button class="btn btn-danger btn-sm btn-action" v-if="form.paying && form.tipoPago == 'tarjetas'" @click="pagar()" :disabled="desactivar || order_id || form.payment_intent_id">Pagar</button>
            </div>

            <div class="col-lg-6 text-right">
              <h6><span>Subtotal: </span> ${{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(subtotal) }}</h6>
              <h6 v-if="form.envio > 0"><span>Envío: </span> ${{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(form.envio) }}</h6>
              <h6 v-else-if="form.envio == 0"><span>Envío: </span> Gratis</h6>
              <!-- <h6><span>Tiempo de entrega:</span> Entrega de 48 a 72 hrs.</h6> -->
              <h5><span>Total: </span> ${{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(total) }}</h5>
            </div>
          </div>
        </div>
      </div>

      <sweet-modal :icon="modal.icon" :blocking="modal.block" :hide-close-button="modal.block"  ref="modal">
        <div class="fa-3x" v-if="modal.icon== ''"><i class="fas fa-spinner fa-pulse"></i></div><br/>
        <div v-html="modal.msg"></div>
        <div class="col-12 text-center" style="padding-top: 20px;" v-if="modal.icon == 'success'">
          <div class="txt-description" v-if="stock < 1">Entrega de 48 a 72 hrs</div>
          <b-button class="btn btn-success" slot="button" @click="toHome">Regresar a Home <i class="color-white fas fa-home"></i></b-button>
        </div>
      </sweet-modal>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form: {
        products: [],

        user: {
          "email": '',
          "name": '',
          "lastname": '',
          "phone": '',
          "street": '',
          "num_ext": '',
          "num_int": '',
          "neighborhood":'',
          "zipcode": null,
          "state_id": null,
          "town_id": null
        },

        prev: '',
        next: '',
        paying: false,

        tipoPago: '',
        subtotal: 0,
        total: 0,
        comission:0,
        envio: 150,
        shippingMethod: 'Enviar a domicilio',
      },

      modal:{
        msg:'',
        icon:'',
        block:false,
      },

      userLogin: false,
      states: [],
      towns: [],
      order_id: null,
      paqueteria: 0,

      stripe: {},
      elements: {},
      cardElement: {},

      desactivar: false,

    }
  },

  computed: {
    subtotal() {
     var subtotal = this.form.products.reduce(function (subtotal, item) {
        return subtotal + (item.price * item.quantity)
      },0);
      var commision = this.form.products.reduce(function (sum, item) {
        return sum +  (item.commision * item.quantity)
      },0);


      this.form.commision = parseFloat(commision);
      return this.form.subtotal = subtotal;
    },

    total() {
      var subtotal = this.form.products.reduce(function (sum, item) {
        return sum +  (item.price * item.quantity)
      },0);

      var commision = this.form.products.reduce(function (sum, item) {
        return sum +  (item.commision * item.quantity)
      },0);

        /*if(this.form.shippingMethod == 'recoger en tienda'){
            this.paqueteria = this.form.envio;
            this.form.envio = 0;
        }

        if(this.form.shippingMethod == 'enviar a domicilio'){
            this.form.envio = this.paqueteria;
        }*/
        var checkserv = 0;
        for (let x = 0; x < this.form.products.length; x++) {
          if (this.form.products[x]['type'] == 'producto') {
            checkserv++;
          }

        }


      var envio = 0;
      if (checkserv > 0) {
        this.form.envio = 150;
      }
      else{
        this.form.envio = 0;
      }

      var grandTotal  = parseFloat(subtotal) + parseFloat(this.form.envio);
      this.form.commision = parseFloat(commision);
      return this.form.total = grandTotal;
    }
  },

  methods: {
    changePaymentMe(tipo){
      this.form.tipoPago = tipo;
      if(tipo == "tarjetas"){
        setTimeout(this.loadStripe, 50);
      }
    },

    pagar(){
      if(this.form.tipoPago == "transferencia"){
        this.desactivar = true;
        this.createOrder();
      }

      if(this.form.tipoPago == "tarjetas"){
        this.desactivar = true;
        this.payStripe();
      }
    },

    getSteps(){
      var step = this.$route.params.step;
      this.form.paying = false;

      if(step == 'pago'){ // Paso 3
        if(this.form.shippingMethod == 'enviar a domicilio'){
            this.getDistance();
        }

        this.form.prev = 'envio';
        this.form.next = null;
        this.form.paying = true;
      }
      else if(step == 'envio'){ // Paso 2
        this.form.prev = '';
        this.form.next = 'pago';
      }
      else{ // Paso 1
        this.form.prev = null;

        if(this.form.products.length){
          this.form.next = 'envio';
        }
      }
    },

    getStates(){
      axios.get(tools.url('/api/states')).then((response)=>{
        this.states = response.data;
      }).catch((error)=>{
         console.log(error);
      });
    },

    getTowns(){
      if(this.form.user.state_id){
        axios.get(tools.url('/api/towns/' + this.form.user.state_id)).then((response)=>{
          this.towns = response.data;
        }).catch((error)=>{
          console.log(error);
        });
      }
    },

    getInfo(){
      this.form.user = {
        //Datos personales
        id: this.$root.user.id,
        name: this.$root.user.name,
        lastname: this.$root.user.lastname,
        email: this.$root.user.email,
        phone: this.$root.user.phone,
        street: this.$root.user.address.street,
        num_ext: this.$root.user.address.num_ext,
        num_int: this.$root.user.address.num_int,
        neighborhood: this.$root.user.address.neighborhood,
        zipcode: this.$root.user.address.zipcode,
        state_id: this.$root.user.address.state_id,
        town_id: this.$root.user.address.town_id,
      };

      this.getTowns();
    },

    getCart: function(){
      var storage = localStorage.getItem('cart');
      if(storage != null){
        var products = JSON.parse(storage);
        axios.post(tools.url('/api/cart'),{ products:products }).then((response)=>{
          this.form.products = response.data.cart;
          this.form.envio = response.data.envio;
          this.getSteps();

        }).catch((error)=>{
          console.log(error);
          this.getSteps();
        });
      }
    },

    getDistance: function(){
        axios.post(tools.url('/api/distance'),{ user:this.form.user }).then((response)=>{
            this.form.envio = response.data.price;
            this.paqueteria = response.data.price;
        }).catch((error)=>{
            console.log(error);
        });
    },

    removeCart: function(index) {
        this.$delete(this.form.products, index)
        this.updateCart();
    },

    updateCart(){
        var cart = [];
        this.form.products.forEach(function(val, index, array){
          var info = { id:val.id, quantity: val.quantity, modelo: val.modelo };
          cart.push(info);
        });
        localStorage.setItem("cart",JSON.stringify(cart));
        this.$root.cartCount = cart.length;
        this.getCart();
    },

    createOrder: function(){
        this.modal.block = true;
        this.modal.icon = '';
        this.modal.msg = 'Procesando, por favor espere...';
        this.$refs.modal.open();

        axios.post(tools.url('/api/order/store'),{ order:this.form, products:this.form.products, user:this.form.user, userLogin:this.$root.logged }).then((response)=>{
            if(response.data.type === "success"){
                this.order_id = response.data.order_id;
                localStorage.removeItem('cart');
                this.$root.cartCount = 0;
                //mensaje
                this.modal.icon = "success";
                this.modal.msg = "TU PEDIDO HA SIDO EXITOSO!<br/> Número de pedido:<b> MX000"+response.data.order_id+"</b>. Por favor de enviar su comprobante de pago a <b>pago@mipaw.com.mx</b>";
                this.modal.block = true;
                this.$refs.modal.open();

            }else{
                this.$refs.modal.close();
                alert(response.data.error);
            }
        }).catch((error)=>{
            console.log(error);
            this.modal.icon="error";
            this.modal.msg = "Fallo al realizar el pedido., Verifique su internet y recargue la página";
            this.modal.block = false;
            this.$refs.modal.open();
        });
    },

    loadStripe(){
      //sandbox key
      this.stripe = Stripe('pk_live_51LZfLsKgxTsOar06OpdR9z3Cgco21fRRaZBJFs027A214ryrWVXCLhoVEWYJpsgOWkemo4sDv9Ysa5hGf8be7aYc00FIJOeKnO');
      this.elements = this.stripe.elements({locale: 'es'});
      this.cardElement = this.elements.create('card', {hidePostalCode: true});

      this.cardElement.mount("#cardElement");
      this.cardElement.addEventListener('change', ({ error }) => {
          const displayError = document.getElementById('cardErrors');
          if (error) {
            displayError.textContent = error.message;
          } else {
            displayError.textContent = '';
          }
      });
    },

    payStripe(){
      this.modal.block = true;
      this.modal.icon = '';
      this.modal.msg = 'Validando el metodo de pago. por favor espere...';
      this.$refs.modal.open();

      this.stripe.createPaymentMethod({
          type: 'card',
          card: this.cardElement,
          billing_details: { name: this.form.user.name+' '+this.form.user.lastname, email: this.form.user.email }
        }).then((result)=>{
          if (result.error) {
            alert('Ocurrió un error con su tarjeta');
            this.desactivar = false;
          } else {
            const data  = { payment_method_id: result.paymentMethod.id, total: this.form.total, name: this.form.name, email: this.form.email };
            axios.post(tools.url('/api/stripe/Installments'),data).then((response)=>{
                this.form.payment_intent_id = response.data.intent_id;
                this.pagarStripe();
              });
          }
      });
    },

    pagarStripe: function(){
      this.modal.block = true;
      this.modal.icon = '';
      this.modal.msg = 'Generando su pedido por favor espere...';
      this.$refs.modal.open();

      axios.post(tools.url('/api/stripe/pay'),{  order:this.form, products:this.form.products, user:this.form.user, userLogin:this.$root.logged }).then((response)=>{
          if(response.data.type === "success"){
            this.order_id = response.data.order_id;
            localStorage.removeItem('cart');
            this.$root.cartCount = 0;
            //mensaje
            this.modal.block = false;
            this.modal.icon = "success";
            this.modal.msg = "TU PEDIDO HA SIDO EXITOSO!<br/> Número de pedido: <b>MX000"+response.data.order_id+"</b>.";



          }else{
            this.modal.icon = "error";
            this.modal.msg = response.data.message;
            this.modal.block = false;
            this.desactivar = false;
          }
      }).catch((error)=>{
        this.$refs.modal.close();
        alert("ERROR: No se pudo realizar el pedido.");
        this.desactivar = false;
      });
    },
    toHome(){
      this.modal.block = false;
      this.$refs.modal.close();
      this.$router.push('/');
    }
  },

  beforeMount(){
    this.getSteps();
    this.getStates();
    this.getCart();

    if(this.$root.logged){
      this.getInfo();
    }


  },

  watch: {
    '$route.params.step': function () {
      this.getSteps();
    },

    "$root.logged": function(v) {
      if(v == true){
        this.getInfo();
      }
    },
  }
}
</script>

<style>
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
