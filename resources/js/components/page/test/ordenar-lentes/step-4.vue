<template lang="html">
  <section class="step-4">
    <div class="box-title-top-1">
      <h2 class="txt-purple title-s1">Agenda tu cita</h2>
    </div>

    <div class="box-map">
      <GmapMap
        :center="mapCenter.position"
        :zoom="mapCenter.position.zoom">
        <GmapMarker
          :key="'marker-'+mInx"
          v-for="(m, mInx) in markers"
          :position="m.position"
          :title="m.name"
          :clickable="true"
          :draggable="false"
          :icon="{ url: 'public/images/shared/map-icon.svg'}"
          @click="markAction(m)"
        />
      </GmapMap>
    </div>

    <div class="box-bottom-navs nav-multi-btns">
      <button type="button" name="button" class="btn _btn btn-s2 outline-gray btn-sm" @click="$parent.step = 3">Anterior</button>
      <button type="button" name="button" class="btn _btn btn-s2 bg-gray btn-sm" @click="$parent.step = 5">Agendar</button>
    </div>

    <b-modal modal-class="modal-marker" ref="modal-marker" hide-footer centered no-close-on-backdrop no-close-on-esc>
      <div class="box-basic-info">
        <h5 class="name">Ópticas del Sur</h5>

        <div class="descr">
          Av. Cruz de Sur #1234<br />Col. del Sur C.P. 36690
        </div>

        <div class="row box-rating">
          <div class="col col-lg-5 col-stars">
            <b-form-rating readonly inline value="4"></b-form-rating>
          </div>

          <div class="col col-lg col-summary">
            <span class="comment">13 opiniones</span>
          </div>
        </div>
      </div>

      <div class="box-gallery">
        <swiper class="swiper" v-if="showGallery" :options="galleryOptions">
          <swiper-slide v-for="(img, imgInx) in gallery" :key="'imgInx-'+imgInx">
            <div class="placed-backg image" v-bind:style="{ backgroundImage: 'url('+img+')' }"></div>
          </swiper-slide>

          <div class="swiper-button-prev" slot="button-prev"></div>
          <div class="swiper-button-next" slot="button-next"></div>
        </swiper>
      </div>

      <div class="box-schedule">
        <h5 class="title">¿Qué día vas a asistir?</h5>
        <div class="box-time-date date">
          <b-form-datepicker v-model="$parent.form.fecha" :min="minDate" :date-disabled-fn="dateDisabled" :date-format-options="dateFormOpts" v-bind="datepickerOpts"  placeholder="Fecha" required></b-form-datepicker>
        </div>

        <h5 class="mt-4 pt-1 title">Próximo horario disponible</h5>
        <div class="box-time-date time">
          <b-form-select class="b-time" v-bind:class="{ 'text-muted' : $parent.form.hora == null }" v-model="$parent.form.hora">
            <b-form-select-option :value="null">Hora</b-form-select-option>
            <b-form-select-option value="1">9:00 a.m.</b-form-select-option>
            <b-form-select-option value="2">10:00 a.m.</b-form-select-option>
            <b-form-select-option value="3">11:00 a.m.</b-form-select-option>
            <b-form-select-option value="4">12:00 p.m.</b-form-select-option>
          </b-form-select>
          <!-- <b-form-timepicker v-model="$parent.form.hora" locale="es" minutes-step="30" v-bind="timepickerOpts"  placeholder="Hora" required></b-form-timepicker> -->
        </div>
      </div>
    </b-modal>
  </section>
</template>

<script>
export default {
  data() {
    return {
      mapCenter: { id: null, position: { lat: 20.6712689, lng: -103.3923762, zoom: 12.3 } }, // Centro del mapa

      markers: [
        { id: 1, position: { lat: 20.6407548, lng: -103.391109, zoom: 17.4 },   name: 'Óptica del Sur', content: `Av. Cruz del Sur #1234<br />Col. del Sur, C.P. 36690` },
        { id: 2, position: { lat: 20.689778, lng: -103.3623479, zoom: 17.4 },   name: 'Óptica del centro', content: `Av Guadalupe 1579, Chapalita Oriente,<br />45040 Zapopan, Jal.` },
        { id: 3, position: { lat: 20.7217495, lng: -103.3931807, zoom: 17.4 },  name: 'Óptica del norte', content: `Avenida Vallarta Eje Poniente 3959, Interior 22,<br />La Gran Plaza, 45049 Zapopan, Jal.` },
        { id: 4, position: { lat: 20.63164, lng: -103.3771829, zoom: 17.4 },    name: 'Óptica del oriente', },
      ],

      gallery: [
        'public/images/pages/get-glasses/store-0.jpg',
        'public/images/pages/get-glasses/store-1.jpg',
        'public/images/pages/get-glasses/store-2.jpg',
        'public/images/pages/get-glasses/store-3.jpg',
      ],
      showGallery: false,

      // == Carousels ==
      galleryOptions: {
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      },
      // == ==

      // == Variables para datepicker y timepicker ==
      minDate: null,
      dateFormOpts: { year: 'numeric', month: 'numeric', day: 'numeric' },
      datepickerOpts: {
        labelPrevYear: 'Año anterior',
        labelPrevMonth: 'Mes anterior',
        labelCurrentMonth: 'Mes actual',
        labelNextMonth: 'Mes siguiente',
        labelNextYear: 'Año siguiente',
        labelToday: 'Hoy',
        labelSelected: 'Fecha Seleccionada',
        labelNoDateSelected: 'No seleccionado',
        labelCalendar: 'Calendario',
        labelHelp: 'Use las teclas de movimiento para navegar'
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
      // == ==
    }
  },

  methods: {
    dateDisabled(ymd, date) {
      // Disable weekends (Sunday = `0`, Saturday = `6`)
      const weekday = date.getDay();
      const day = date.getDate();
      // Return `true` if the date should be disabled
      return weekday === 0 || weekday === 6
    }
  },

  mounted() {
    this.$refs['modal-marker'].show();

    setTimeout(()=> {
      this.showGallery = true;
    }, 1000);
  },

  beforeMount(){
    const now = new Date();
    this.minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  },
}
</script>
