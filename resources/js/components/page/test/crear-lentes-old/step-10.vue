<template lang="html">
  <div class="box-step-wr padding-b-plan step-10">
    <div class="wr">
      <!-- <div class="col-12 col-xl-5 mx-auto">
        <h2 class="h1s f-w-800 txt-blue">Forma de pago</h2>
      </div> -->

      <div class="container main-con">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-7 col-summary">
            <h3 class="mb-2 f-w-800">Resumen del pedido</h3>

            <div class="box-summary">
              <div class="col col-image">
                <div class="img">
                  <img src="public/images/pages/test/glasses-2.jpg">
                </div>
              </div>

              <div class="col col-info">
                <h5 class="mb-2">Armazón: <strong>Armazón 1</strong></h5>
                <h5 class="mb-2">Material: <strong>B/Block</strong></h5>
                <h5 class="mb-2">Recubrimiento: <strong>Matiz E</strong></h5>
                <h5>Paquete: <strong>Ultra por $ 1,900</strong></h5>
              </div>
            </div>
          </div>

          <div class="col-md-10 col-lg-8 col-xl-7 mt-4 col-text">
            <h3 class="mb-2 f-w-800">Recolección</h3>

            <div class="box-text">
              <h5 class="title">Ledesma Opticos</h5>

              <div class="mb-2 descr">
                Calz. del Federalismo Sur 199, Centro, 44100 Guadalajara, Jal.<br /> Tel: 33 3614 9234
              </div>

              <a class="f-w-600" target="_blank" href="https://goo.gl/maps/TB2tdQJC26eYJsMs5"><i class="fas fa-map-marker-alt"></i> Ver en el mapa 3D</a>
            </div>
          </div>

          <div class="col-md-10 col-lg-8 col-xl-7 mt-4 col-payment">
            <h3 class="mb-2 f-w-800">Pago</h3>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 col-payment">
            <b-form-group
              label="Nombre del titular:">
              <b-form-input
                v-model="form.name"
                type="text"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Número de tarjeta:">
              <b-form-input
                v-model="form.number"
                type="number"
              ></b-form-input>
            </b-form-group>

            <b-form-group class="mb-0" label="Fecha de expiración:"></b-form-group>
            <div class="row mx-0">
              <b-form-input
                class="col-6"
                v-model="form.exp1"
                type="number"
              ></b-form-input>

              <b-form-input
                class="ml-2 col-4"
                v-model="form.exp2"
                type="password"
              ></b-form-input>
            </div>
          </div>

          <div class="col-12 mt-5 text-center col-btn-navs">
            <b-button type="button" class="btn btn-lg btn-s1 outline-blue" @click="$parent.step = 9;">Regresar</b-button>
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue px-5">Pagar</b-button>
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
      form: {

      }
    }
  },
}
</script>
