<template lang="html">
  <div class="box-step-wr step-3">
    <h2 class="h1s f-w-800 txt-blue">Elige el material indicado para ti</h2>

    <div class="container material-con">
      <div class="row">
        <div class="col-lg-8 col-xl-6">
          <b-form-radio-group class="box-options" required v-model="$parent.form.material" name="r-material">
            <b-form-radio value="1">
              <div class="col-5 col-lg-6 col-name">Trivex</div>
              <div class="col-7 col-lg-6 col-descr">Ideal para todo tipo de actividades</div>
            </b-form-radio>

            <b-form-radio value="2">
              <div class="col-5 col-lg-6 col-name">Parasol</div>
              <div class="col-7 col-lg-6 col-descr">Ideal para exteriores e interiores</div>
            </b-form-radio>

            <b-form-radio value="3">
              <div class="col-5 col-lg-6 col-name">B/Block</div>
              <div class="col-7 col-lg-6 col-descr">Ideal para uso de dispositivos digitales</div>
            </b-form-radio>

            <b-form-radio value="4">
              <div class="col-5 col-lg-6 col-name">Trivex Parasol</div>
              <div class="col-7 col-lg-6 col-descr">Ideal para todo tipo de actividades tanto en exterior como en interior</div>
            </b-form-radio>

            <b-form-radio value="5">
              <div class="col-5 col-lg-6 col-name">Trivex 1.60</div>
              <div class="col-7 col-lg-6 col-descr">Ideal para altas graduaciones</div>
            </b-form-radio>
          </b-form-radio-group>
        </div>

        <div class="col-12 col-nav-buttons">
          <button type="button" class="btn btn-lg btn-s1 outline-blue" @click="$parent.step = 2">Anterior</button>
          <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Siguiente</b-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>
