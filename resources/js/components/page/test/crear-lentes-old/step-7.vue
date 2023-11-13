<template lang="html">
  <div class="box-step-wr padding-b-plan step-7">
    <div class="wr">
      <div class="container main-con">
        <div class="row">
          <div class="col-12 col-text">
            <h2 class="h1s f-w-800 txt-blue">¡Lista tu cita!</h2>

            <h3 class="mt-3 date">Martes 17 de Enero de 2023</h3>
            <h3 class="hour">11:00 a.m</h3>
          </div>

          <div class="col-12 col-branch-info">
            <h5 class="title">Ledesma Opticos</h5>

            <div class="desc">
              Calz. del Federalismo Sur 199, Centro, 44100 Guadalajara, Jal.<br /> Tel: 33 3614 9234
            </div>

            <a class="h5 txt-white c-pointer" @click="cancel()"><u>Cancelar cita</u></a>
          </div>

          <div class="col-12 mt-5 text-center col-btn-navs">
            <b-button type="button" class="btn btn-lg btn-s1 bg-blue" @click="$parent.step = 8;">Ir a pagar</b-button>
          </div>
        </div>
      </div>

      <div class="box-head-s2"></div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    cancel() {
      let confirmAction = confirm("¿Desea cancelar la cita? La información seleccionada será borrada y será redirigido al Inicio.");

      if (confirmAction) {
        this.$router.push('/')
      } else { }

    }
  }
}
</script>
