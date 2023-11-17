<template lang="html">
  <section class="step-3">
    <div class="container">
      <div class="box-title-top-1">
        <h2 class="txt-purple title-s1">Carrito</h2>
      </div>

      <div class="box-content">
        <div class="col-md-8 col-lg-6 col-xl-5 col-cart">
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

                <div class="box-remove">
                  <a class="btn btn-remove">
                    <i class="fal fa-trash-alt"></i>
                    <span>Eliminar</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="box-totals">
            <h5><span class="txt">Subtotal:</span> <span class="f-w-600 f-f-kanit">$1,900.00</span></h5>
          </div>
        </div>
      </div>

      <div class="box-bottom-navs nav-multi-btns">
        <button type="button" name="button" class="btn _btn btn-s2 outline-gray btn-sm" @click="$parent.step = 2">Anterior</button>
        <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="$parent.step = 4">Finalizar compra</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
}
</script>
