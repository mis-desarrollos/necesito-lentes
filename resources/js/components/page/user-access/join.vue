<template>
  <div id="join-us-page">
    <section class="container-fluid py-2 mb-4 page-title-section">
      <h4 class="x-title">Registro de cuenta</h4>
    </section>

    <section class="container px-sm-0 mb-4 text-center text-section">
      <h5 class="f-w-600">Bienvenido emprendedor</h5>
      <p>
        Completa este pre-registro y realiza el pago de gastos administrativos de manera segura con débito o crédito.<br />
        Nuestro personal evaluara tu proyecto e industria y recibirás una respuesta en los siguientes 3 días hábiles.
      </p>
    </section>

    <!-- Form -->
    <b-form @submit.prevent="onSubmit($event.target)" >
      <div class="container pb-1 box-step">
        <h4 class="b-title"> <span class="circle-num"><i>1</i></span> Cuéntanos sobre tí</h4>

        <div class="row" >
          <b-form-group class="cus-f-group-1 col-md-12" label="Nombre completo *">
            <b-form-input type="text" v-model="form.name" required placeholder=""></b-form-input>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Correo electrónico *">
            <b-form-input type="email" v-model="form.email" required placeholder=""></b-form-input>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Teléfono *">
            <b-form-input type="text" v-model="form.phone" required minlength="10" maxlength="10"></b-form-input>
          </b-form-group>
        </div>
      </div>

      <div class="container pb-1 box-step">
        <h4 class="b-title"> <span class="circle-num"><i>2</i></span> Sobre tu negocio</h4>

        <div class="row" >
          <b-form-group class="cus-f-group-1 col-md-12" label="Agrega tu logo">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <!--div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                <img src="http://placehold.it/200x150?text=Imagen" alt="...">
              </div-->
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
              <div>
                <span class="btn btn-white btn-file fileinput-con">
                  <input type="file" accept="image/*," name="logo" id="lgo">
                </span>
              </div>
            </div>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Nombre de tu marca *">
            <b-form-input type="text" v-model="form.brand" required placeholder=""></b-form-input>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Categoría *">
            <b-form-select required v-model="form.category_id">
              <b-form-select-option :value="null" disabled>Seleccione una opción</b-form-select-option>
              <b-form-select-option v-for="(category, indx) in categoriesOpcs" :value="category.id" :key="indx">{{category.name}}</b-form-select-option>
            </b-form-select>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Subcategoria *" v-if="subcategoriesOpcs.length > 0">
            <b-form-select v-model="form.subcategory_id">
              <b-form-select-option :value="null" disabled>Seleccione una opción</b-form-select-option>
              <b-form-select-option v-for="(subcategory, indx) in subcategoriesOpcs" :value="subcategory.id" :key="indx">{{subcategory.name}}</b-form-select-option>
            </b-form-select>
          </b-form-group>

          <!-- <div class="col-sm-6 col-form">
            <b-form-group
              label="Categoría:"
              label-for="i-category">
                <b-form-select
                  id="i-category"
                  v-model="form.category_id"
                  size="sm"
                  required>
                  <option :value="null" selected disabled >Seleccione una opción</option>
                  <option v-for="(category, indx) in categoriesOpcs" :value="category.id" :key="indx">{{category.name}}</option>
                </b-form-select>
            </b-form-group>
          </div> -->

          <b-form-group class="cus-f-group-1 col-md-12" label="Cuéntanos sobre tu proyecto y emprendimiento *">
            <b-form-textarea
              id="textarea"
              v-model="form.comments"
              placeholder=""
              rows="5"
              max-rows="5"
            ></b-form-textarea>
          </b-form-group>
        </div>
      </div>

      <div class="container box-step">
        <h4 class="b-title"> <span class="circle-num"><i>3</i></span> Tu documentación</h4>

        <div class="row">
          <b-form-group class="cus-f-group-1 no-label col-md-12" v-slot="{ ariaDescribedby }">
            <b-form-radio v-model="form.person_type" :aria-describedby="ariaDescribedby" name="p-person_type" value="fisica">Persona física</b-form-radio>
            <b-form-radio v-model="form.person_type" :aria-describedby="ariaDescribedby" name="p-person_type" value="moral">Persona moral</b-form-radio>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Cédula físcal">
            <div class="fileinput fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
              <div>
                <span class="btn btn-white btn-file fileinput-con">
                  <input type="file" accept=".pdf,image/*" name="cedulafiscal" id="cedulafiscal">
                </span>
              </div>
            </div>
          </b-form-group>

          <b-form-group class="cus-f-group-1 col-md-6" label="Registro IMPI">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 300px">
              </div>
              <div>
                <span class="btn btn-white btn-file fileinput-con">
                  <input type="file" accept=".pdf,image/*" name="registro_impi" id="registro_impi">
                </span>
              </div>
            </div>
          </b-form-group>
        </div>
      </div>

      <div class="container box-step">
        <h4 class="b-title"> <span class="circle-num"><i>4</i></span> Pago de inscripcion</h4>

        <div class="col-12">
            <p>Total a pagar: <b>$ 200.00</b> (Por concepto de gastos administrativos)</p><br>
            <div class="alert alert-primary" role="alert">
              Sus datos de tarjeta de debito o de credito no son almacenados por nuestro sistema y son procesados de manera segura y encriptada. En cada pago sera necesario agregar nuevamente estos datos.
            </div>

            <label class="mt-3">Detalles de tarjeta:</label>
            <div id="cardElement"></div>
            <small class="form text text-muted" id="cardErrors" role="alert"></small>
        </div>

      </div>
      <div class="container box-step">
        <h4 class="b-title"> <span class="circle-num"><i>5</i></span> Términos y condiciones de uso</h4>

        <div class="row" >
          <div class="col-12 mb-1">
            <b-form-checkbox class="cus-f-checkbox" v-model="form.venta" name="c-venta" :value="true" :unchecked-value="false" required>
              Acepto haber leido, comprendido y autorizado plenamente el <router-link target="_blank" to="/aviso-de-privacidad">Aviso de privacidad</router-link>.
            </b-form-checkbox>
          </div>


           <div class="col-12 mb-1">
            <b-form-checkbox class="cus-f-checkbox" v-model="form.terminos" name="c-terminos" :value="true" :unchecked-value="false" required>
              Acepto haber leido, comprendido y autorizado plenamente el <router-link target="_blank" to="/terminos-y-condiciones">Términos y condiciones</router-link>.
            </b-form-checkbox>
          </div>

          <!-- <div class="col-12 mb-1">
            <b-form-checkbox class="cus-f-checkbox" v-model="form.afiliado" name="c-afiliado" :value="true" :unchecked-value="false" required>
              Acepto haber leído los términos y condiciones & aviso de privacidad de afiliado.
            </b-form-checkbox>
          </div>

          <div class="col-12 mb-1">
            <b-form-checkbox class="cus-f-checkbox" v-model="form.uso" name="c-uso" :value="true" :unchecked-value="false" required>
              Acepto haber leído los términos y condiciones & aviso de privacidad de uso.
            </b-form-checkbox>
          </div> -->

          <div class="col-12 mt-3">
            <b-button type="submit" class="btn-s1 b-pink" style="display: none;" id="btnsubmit">Completar registro</b-button>

            <b-button  class="btn-s1 b-pink" @click="payStripe">Completar registro</b-button>
          </div>
        </div>
      </div>
    </b-form>
    <!--  -->

    <sweet-modal :icon="modal.icon" :blocking="modal.block" :hide-close-button="modal.block" ref="modalAlert">
      <div class="fa-3x" v-if="modal.icon== ''"><i class="fas fa-spinner fa-pulse"></i></div><br/>
      <div v-html="modal.msg"></div>
      <b-button v-if="modal.icon == 'success'" @click="toHome" class="mt-3 btn btn-info btn-s1 b-pink" style="width: 90%;">Continuar</b-button>
    </sweet-modal>

  </div>
</template>

<script type="text/javascript">
export default {
  data(){
    return{
      form:{
        name:null,
        email:null,
        phone:null,

        brand:null,
        category_id:null,
        subcategory_id:null,
        comments:null,

        person_type:null,

        venta:null,
        afiliado:null,
        uso:null,
        payment_intent_id:null
      },
      categoriesOpcs:[],
      subcategoriesOpcs:[],
      modal:{
        msg:'',
        icon:'',
        block:false,
      },
    }
  },
  watch:{
    'form.category_id':function(){
        this.getSubcategories();
    }
  },
  methods: {
    saveData(){

    },
    onSubmit(form){

      /*this.modal.block = true;
      this.modal.icon = '';
      this.modal.msg = 'Cargando ...';
      this.$refs.modalAlert.open();*/



      if (this.form.payment_intent_id != null) {


          var data=tools.params(form,this.form);
          axios.post(tools.url("/api/registerFront"),data).then((response)=>{
            this.form = {
              name:null,
              email:null,
              phone:null,

              brand:null,
              category_id:null,
              comments:null,

              person_type:null,

              venta:null,
              afiliado:null,
              uso:null,
              payment_intent_id:null
            };

            this.modal.block = false;
            this.modal.icon = 'success';
            this.modal.msg = `
              <div style="font-size: 0.95rem;">
                <h4>Gracias por tu pre-registro</h4>
                <p>El folio con el que podrás dar seguimiento es el numero:<br /><b class="h4 f-w-600">`+response.data.id+`</b></p>
                <p class="mt-2">Para cualquier duda o comentario escribenos a <a href="mailto:ayuda@mexicolimited.com">ayuda@mexicolimited.com</a> o al WhatsApp <a target="_blank" href="https://wa.me/5213310074912">3310074912</a></p>
                <p class="mt-2">Una vez que tu cuenta sea autorizada podrás publicar productos, publicidad y vender por medio de nuestra plataforma.</p>
              </div>
              `;

          }).catch((error)=>{
            this.modal.block = false;
            this.modal.icon = 'error';
            this.modal.msg = 'Ocurrio un error al guardar la información';
            if(error.response.data.status == 'emailduplicate'){
                this.modal.icon = 'warning';
                this.modal.msg = 'El correo ingresado ya se encuentra en nuestra base de datos. Probablemente ya te registraste anteriormente.<br>Para cualquier duda escribenos a <a href="mailto:ayuda@mexicolimited.com">ayuda@mexicolimited.com</a>';
            }


          });
      }
    },
    getCategories(){
      axios.get(tools.url("/api/categories")).then((response)=>{
        this.categoriesOpcs = response.data;

      }).catch((error)=>{
      });
    },
    getSubcategories(){
      var data = [];
      data.push(this.form.category_id);

      axios.post(tools.url("/api/subcategories"),{categories:data}).then((response)=>{
        this.subcategoriesOpcs = response.data;

      }).catch((error)=>{
      });
    },

    toHome(){
      this.$router.push('/');
      location.reload();
    },
    loadStripe(){
      //sandbox key
      //this.stripe = Stripe('pk_test_51LZfLsKgxTsOar06R9CimiLBdaPo3UDbeNrKHXP03bv8JFJDKje6Sn4tQlecYl33igJ6X6sV6NA6jn2yFU0YX4rl00RfSZNH53');
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
      this.modal.msg = 'Cargando ...';
      this.$refs.modalAlert.open();
      var payment_intent_id = null;
      this.stripe.createPaymentMethod({
          type: 'card',
          card: this.cardElement,
          billing_details: { name: this.form.name, email: this.form.email }
        }).then((result)=>{
          if (result.error) {
            alert('Ocurrió un error con su tarjeta');
            this.desactivar = false;
          } else {
            const data  = { payment_method_id: result.paymentMethod.id, total: 200, name: this.form.name, email: this.form.email };
            axios.post(tools.url('/api/stripe/Installments'),data).then((response)=>{
                if (response.data.intent_id) {
                    payment_intent_id = response.data.intent_id;
                    this.form.payment_intent_id = response.data.intent_id;

                    document.getElementById("btnsubmit").click();
                }


              });
          }
      });

      //return payment_intent_id;

    },
  },
  mounted() {
    this.getCategories();
    setTimeout(this.loadStripe, 50);
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
