<template lang="html">
  <section class="step-5">
    <div class="box-bg-1"></div>

    <b-form class="container" @submit="onSubmit">
      <div class="box-title-top-1">
        <h2 class="txt-purple title-s1">Realiza tu compra</h2>{{$parent.form.payment}}
      </div>

      <!-- Info. contacto -->
      <div class="box-forms" v-if="localStep == 1">
        <div class="col-md-8 col-lg-6 col-xl-5 col-form">
          <div class="form">
            <div class="box-title">
              <h6>Información de contacto</h6>
            </div>

            <div class="box-inputs">
              <b-form-group class="custom-form-group-s2">
                <b-form-input
                  v-model="$parent.form.nombre"
                  type="text"
                  placeholder="Nombre *"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group class="custom-form-group-s2">
                <b-form-input
                  v-model="$parent.form.apellidos"
                  type="text"
                  placeholder="Apellidos *"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group class="custom-form-group-s2">
                <b-form-input
                  v-model="$parent.form.telefono"
                  type="text"
                  minlength="10"
                  maxlength="10"
                  placeholder="Teléfono *"
                  required
                ></b-form-input>
              </b-form-group>

              <b-form-group class="custom-form-group-s2">
                <b-form-input
                  v-model="$parent.form.email"
                  type="email"
                  placeholder="Correo electrónico *"
                  required
                ></b-form-input>
              </b-form-group>

              <div class="d-block mb-2">
                <b-form-checkbox class="custom-checkbox-s1"
                  v-model="$parent.form.newsletter"
                  name="checkbox-newsletter"
                  :value="true"
                  :unchecked-value="null">
                  Quiero recibir noticias y ofertas.
                </b-form-checkbox>
              </div>

              <div class="d-block pt-2 text-center">
                <b-button type="submit" class="btn-s2 bg-purple">Siguiente</b-button><br />

                <p class="mt-4">
                  <a class="link-txt" @click="$parent.step = 4">Regresar</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->

      <!-- Metodo de pago -->
      <div class="box-forms" v-if="localStep == 2">
        <div class="col-md-8 col-lg-6 col-xl-5 col-form">
          <div class="form">
            <div class="box-title">
              <h6>Confirmar pedido</h6>
            </div>

            <div class="box-cart-totals">
              <div class="col col-num">
                <span class="num">1</span>
              </div>

              <div class="col col-info">
                <div class="img">
                  <img src="public/images/pages/get-glasses/glasses-1.jpg">
                </div>

                <div class="info">
                  <div class="block">
                    <h5 class="title">Schopenhauer</h5>
                    <div class="descr">
                      Pasta color negro
                    </div>
                  </div>

                  <div class="block">
                    <h5 class="title">Material</h5>
                    <div class="descr">
                      Trivex
                    </div>
                  </div>

                  <div class="block">
                    <h5 class="title">Recubrimiento</h5>
                    <div class="descr">
                      Matiz E
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 mt-4 col-totals">
                <hr class="line" />

                <div class="row row-total">
                  <div class="col col-txt">Subtotal:</div>
                  <div class="col col-numbers">$1,900.00</div>
                </div>

                <div class="row row-total">
                  <div class="col col-txt">Costo de envío:</div>
                  <div class="col col-numbers">$150.80</div>
                </div>

                <div class="row row-total total">
                  <div class="col f-w-800 col-txt">Total:</div>
                  <div class="col f-w-600 col-numbers">$20,050.80</div>
                </div>

                <div class="d-block mt-4 text-center">
                  <b-button type="submit" class="btn-s2 bg-purple">Confirmar</b-button><br />

                  <p class="mt-4">
                    <a class="link-txt" @click="localStep = 1">Regresar</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->

      <!-- Paso final, Pagar -->
      <div class="box-forms" v-if="localStep == 3">
        <div class="col-md-8 col-lg-6 col-xl-5 col-form">
          <div class="form">
            <div class="box-title">
              <h6>Método de pago</h6>
            </div>

            <div class="box-inputs">
              <!-- Tarjetas -->
              <div class="d-block mb-2">
                <b-form-radio class="custom-checkbox-s1"
                  v-model="$parent.form.paymentType"
                  name="checkbox-newsletter"
                  value="tarjeta">
                  Tarjeta de crédito o débito.<br />
                  <img class="img-payment" src="public/images/shared/payments.svg">
                </b-form-radio>
              </div>
              <div class="pt-2" v-if="$parent.form.paymentType == 'tarjeta'">
                <b-form-group class="custom-form-group-s2">
                  <b-form-input
                    v-model="$parent.form.cardNombre"
                    type="text"
                    placeholder="Nombre del titular *"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group class="custom-form-group-s2">
                  <b-form-input
                    v-model="$parent.form.cardNumero"
                    type="number"
                    placeholder="Número de tarjeta *"
                    required
                  ></b-form-input>
                </b-form-group>

                <div class="col-lg-7 px-0">
                  <b-form-group class="custom-form-group-s2">
                    <b-form-input
                      v-model="$parent.form.cardTiempo"
                      type="number"
                      placeholder="MM/AA *"
                      required
                    ></b-form-input>
                  </b-form-group>
                </div>

                <div class="col-lg-5 px-0">
                  <b-form-group class="custom-form-group-s2">
                    <b-form-input
                      v-model="$parent.form.cardCVV"
                      type="number"
                      placeholder="CVV *"
                      required
                    ></b-form-input>
                  </b-form-group>
                </div>
              </div>
              <!-- end Tarjetas -->

              <!-- Paypal -->
              <div class="d-block mt-5 mb-2">
                <b-form-radio class="custom-checkbox-s1"
                  v-model="$parent.form.paymentType"
                  name="checkbox-newsletter"
                  value="paypal">
                  <img class="img-payment" src="public/images/shared/paypal.svg">
                </b-form-radio>
              </div>
              <div class="pt-2" v-if="$parent.form.paymentType == 'paypal'">
                <b-form-group class="custom-form-group-s2">
                  <b-form-input
                    v-model="$parent.form.paypalNombre"
                    type="text"
                    placeholder="Nombre del titular *"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group class="custom-form-group-s2">
                  <b-form-input
                    v-model="$parent.form.paypalEmail"
                    type="email"
                    placeholder="Correo electrónico *"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group class="custom-form-group-s2">
                  <b-form-input
                    v-model="$parent.form.paypalPass"
                    type="password"
                    placeholder="Contraseña *"
                    required
                  ></b-form-input>
                </b-form-group>
              </div>
              <!-- end Paypal -->

              <div class="d-block pt-2 text-center">
                <b-button type="submit" class="btn-s2 bg-purple">Pagar</b-button><br />

                <p class="mt-4">
                  <a class="link-txt" @click="localStep = 2">Regresar</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
    </b-form>

  </section>
</template>

<script>
export default {
  data() {
    return {
      localStep: 1,
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
      window.scrollTo(0,0);

      if(this.localStep == 3) {
        this.$parent.step = 6;
      }
      if(this.localStep == 2) {
        this.localStep = 3;
      }
      if(this.localStep == 1) {
        this.localStep = 2;
      }
    },
  }
}
</script>
