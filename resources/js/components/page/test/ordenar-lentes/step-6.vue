<template lang="html">
  <section class="step-6">
    <div class="box-bg-1"></div>

    <div class="container">
      <div class="box-title-top-1">
        <h2 class="txt-purple title-s1">¡Tu pago ha sido exitoso!</h2>{{$parent.form.payment}}
      </div>

      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5 col-content">
          <div class="box-text">
            <h4 class="f-w-700">Se ha enviado una copia del comprobante a tu correo 123@gmail.com</h4>
          </div>

          <div class="box-summary">
            <p>
              <img class="img-glasses" src="public/images/pages/get-glasses/glasses-1.jpg">
            </p>

            <h4 class="title">No. de referencia</h4>
            <h4 class="result">1234-BDGY-902345</h4>

            <h4 class="mt-3 title">No. de orden</h4>
            <h4 class="result">1234567890632045</h4>

            <p class="mt-5">
              <router-link class="h5" to="">Ver pedido</router-link>
            </p>
            <p class="mt-2">
              <router-link class="h5" to="">Tengo un problema con<br />mi compra</router-link>
            </p>
            <p class="mt-2">
              <router-link class="h5" to="">Ver cita</router-link>
            </p>
          </div>

          <div class="d-block mt-5 text-center">
            <router-link class="btn btn-s2 bg-purple" to="/">Volver al inicio</router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
}
</script>
