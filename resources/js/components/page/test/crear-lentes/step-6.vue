<template lang="html">
  <div class="box-step-wr padding-b-plan step-6">
    <div class="wr">
      <div class="col-12 col-xl-5 mx-auto">
        <h2 class="h1s f-w-800 txt-blue">Elige el día y hora de tu preferencia</h2>
      </div>

      <div class="container main-con">
        <div class="row">
          <div class="col-lg-6 col-calendar">
            <v-date-picker is-expanded v-model="$parent.form.fecha" color="blue" :min-date="minDate" is-inline :model-config="modelConfig" />
            <!-- <v-date-picker is-expanded v-model="$parent.form.fecha" color="blue" :min-date="minDate" is-inline mode="dateTime" /> -->
          </div>

          <div class="col-12"></div>

          <div class="col-lg-6 col-time">
            <div class="box">
              <div class="b-lab">
                Hora
              </div>

              <!-- <div class="col b-time">
                <b-form-group class="custom-form-group-t1">
                  <b-form-timepicker v-model="$parent.form.hora" minDate="10" minutes-step="30" v-bind="timepickerOpts" placeholder="Selecciona una hora" required></b-form-timepicker>
                </b-form-group>
              </div> -->

              <div class="col b-time-v2">
                <b-form-select required v-model="$parent.form.hora">
                  <b-form-select-option disabled :value="null">Seleccione una hora</b-form-select-option>
                  <b-form-select-option value="1">10:00 AM</b-form-select-option>
                  <b-form-select-option value="2">11:00 AM</b-form-select-option>
                  <b-form-select-option value="3">12:00 AM</b-form-select-option>
                  <b-form-select-option value="4">1:00 PM</b-form-select-option>
                  <b-form-select-option value="5">2:00 PM</b-form-select-option>
                  <b-form-select-option value="6">3:00 PM</b-form-select-option>
                  <b-form-select-option value="7">4:00 PM</b-form-select-option>
                  <b-form-select-option value="8">5:00 PM</b-form-select-option>
                  <b-form-select-option value="9">6:00 PM</b-form-select-option>
                  <b-form-select-option value="10">7:00 PM</b-form-select-option>
                </b-form-select>
              </div>
            </div>
          </div>

          <div class="col-12 col-branch-info">
            <h5 class="title">Ledesma Opticos</h5>

            <div class="desc">
              Calz. del Federalismo Sur 199, Centro, 44100 Guadalajara, Jal.<br /> Tel: 33 3614 9234
            </div>
          </div>

          <div class="col-12 mt-5 text-center col-btn-navs">
            <b-button type="button" class="btn btn-lg btn-s1 outline-white" @click="$parent.step = 5;">Anterior</b-button>
            <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" :disabled="isBtnDisabled">Confirmar</b-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// V-Calendar | https://vcalendar.io/api/v1.0/ | https://vcalendar.io/
export default {
  data() {
    return {
      minDate: null,
      isBtnDisabled: true,

      modelConfig: {
        type: 'string',
        mask: 'YYYY-MM-DD', // Uses 'iso' if missing
      },

      timepickerOpts: {
        labelHours: 'Horas',
        labelMinutes: 'Minutos',
        labelSeconds: 'Segundos',
        labelAm: 'AM',
        labelPm: 'PM',
        labelNoTimeSelected: 'No seleccionado',
        labelCloseButton: 'Cerrar',
      }
    }
  },

  beforeMount(){
    const now = new Date();
    this.minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  },

  watch: {
    '$parent.form.fecha'(val, oldVal) {
      if(val && this.$parent.form.hora) {
        this.isBtnDisabled = false;
      }
    },

    '$parent.form.hora'(val, oldVal) {
      if(val && this.$parent.form.fecha) {
        this.isBtnDisabled = false;
      }
    }
  }
}
</script>
