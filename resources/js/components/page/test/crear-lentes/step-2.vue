<template lang="html">
  <div class="box-step-wr step-2">
    <h2 class="h1s f-w-800 txt-blue">Elige cuánto quieres gastar</h2>

    <div class="container packages-con">
      <b-form-radio-group class="row" v-model="$parent.form.plan" name="r-plan" required>
        <b-form-radio class="col-sm-6 col-lg-4 col-xl-3 col-package" value="1">
          <div class="box-package blue">
            <div class="box-name">
              <h6 class="lab">Paquete</h6>
              <h5 class="name">Ultra</h5>
            </div>

            <div class="box-info">
              <h5 class="f-w-600 mb-2">Incluye</h5>

              <ul>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
              </ul>
            </div>

            <div class="box-price">
              <h5>$ 1,900</h5>
            </div>
          </div>
        </b-form-radio>

        <b-form-radio class="col-sm-6 col-lg-4 col-xl-3 col-package" value="2">
          <div class="box-package aqua">
            <div class="box-name">
              <h6 class="lab">Paquete</h6>
              <h5 class="name">Pro</h5>
            </div>

            <div class="box-info">
              <h5 class="f-w-600 mb-2">Incluye</h5>

              <ul>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
              </ul>
            </div>

            <div class="box-price">
              <h5>$ 1,600</h5>
            </div>
          </div>
        </b-form-radio>

        <b-form-radio class="col-sm-6 col-lg-4 col-xl-3 col-package" value="3">
          <div class="box-package white">
            <div class="box-name">
              <h6 class="lab">Paquete</h6>
              <h5 class="name">Novato</h5>
            </div>

            <div class="box-info">
              <h5 class="f-w-600 mb-2">Incluye</h5>

              <ul>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
                <li>Cualquier material.</li>
                <li>Cualquier armazón.</li>
              </ul>
            </div>

            <div class="box-price">
              <h5>$ 1,200</h5>
            </div>
          </div>
        </b-form-radio>
      </b-form-radio-group>

      <div class="row">
        <div class="col-12 mt-4 text-center">
          <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Siguiente</b-button>
        </div>
      </div>
    </div>

    <div class="placed-backg box-head"></div>
  </div>
</template>

<script>
export default {
}
</script>
