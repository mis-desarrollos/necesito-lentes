<template lang="html">
  <div class="box-step-wr padding-b-plan step-9">
    <div class="wr">
      <div class="col-12 col-xl-5 mx-auto">
        <h2 class="h1s f-w-800 txt-blue">Elige la forma de pago</h2>
      </div>

      <div class="container main-con">
        <div class="row">
          <div class="col-md-9 col-lg-7 col-xl-6 col-payment">
            <b-form-radio-group
              class="payment-radiogroup"
              v-model="$parent.form.formadePago"
              required
              name="r-payment">
              <b-form-radio value="1">
                <div class="box-payment">
                  <div class="col box-icon">
                    <div><img class="icon-card" src="public/images/shared/card.svg" alt="Tarjeta de débito & crédito"></div>
                  </div>
                  <div class="col box-text">
                    <h5>Tarjeta de débito & crédito</h5>
                    <h3 class="price">$1,900</h3>
                  </div>
                </div>
              </b-form-radio>

              <b-form-radio value="2">
                <div class="box-payment">
                  <div class="col box-icon">
                    <div><img class="icon-paypal" src="public/images/shared/paypal.svg" alt="Paypal"></div>
                  </div>
                  <div class="col box-text">
                    <h5>Paypal</h5>
                    <h3 class="price">$1,900</h3>
                  </div>
                </div>
              </b-form-radio>
            </b-form-radio-group>
          </div>

          <div class="col-12 mt-0 text-center col-btn-navs">
            <b-button type="button" class="btn btn-s1 outline-white no-border" @click="$parent.step = 8"><u>Regresar</u></b-button>
          </div>

          <div class="col-12 mt-4 text-center col-btn-navs">
            <b-button type="submit" class="btn btn-s1 btn-lg bg-blue" :disabled="isBtnDisabled" @click="$parent.step = 10">Continuar</b-button>
          </div>
        </div>
      </div>

      <div class="box-head-s3"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isBtnDisabled: true,
    }
  },

  watch: {
    '$parent.form.formadePago'(val, oldVal) {
      if(this.$parent.form.formadePago) {
        this.isBtnDisabled = false;
      }
    },
  }
}
</script>
