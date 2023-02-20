<template lang="html">
  <div class="box-step-wr padding-b-plan step-6">
    <div class="wr">
      <div class="col-12 col-xl-5 mx-auto">
        <h2 class="h1s f-w-800 txt-blue">Elige el día y hora de tu preferencia</h2>
      </div>

      <div class="container main-con">
        <div class="row">
          <div class="col-lg-6 col-calendar">
            <v-date-picker is-expanded v-model="date" color="blue" :min-date="minDate" is-inline :model-config="modelConfig" />
            <!-- <v-date-picker is-expanded v-model="date" color="blue" :min-date="minDate" is-inline mode="dateTime" /> -->
          </div>

          <div class="col-12"></div>

          <div class="col-lg-6 col-time">
            <div class="box">
              <div class="b-lab">
                Hora
              </div>

              <div class="col b-time">
                <b-form-group class="custom-form-group-t1" label-for="i-hour">
                  <b-form-timepicker v-model="hour" locale="en" minutes-step="30" v-bind="timepickerOpts"  placeholder="Hora" required></b-form-timepicker>
                </b-form-group>
              </div>
            </div>
          </div>
        </div>
        {{ date }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: null,
      hour: null,

      minDate: null,

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

  methods: {
    search: function () {
       console.log(this.range.start);
       console.log(this.range.end);
    }
  },

  beforeMount(){
    const now = new Date();
    this.minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  },
}
</script>
