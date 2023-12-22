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
          :icon="{ url: (m.selected) ? 'public/images/shared/map-icon-selected.svg' : 'public/images/shared/map-icon.svg' }"
          @click="showMarkerModal(m, mInx)"
        />
      </GmapMap>
    </div>

    <div class="box-bottom-navs nav-multi-btns">
      <p class="pb-2" v-if="!showNextBTN"><small class="f-w-600"><i>Seleccione una tienda del mapa</i>*</small></p>

      <button type="button" name="button" class="btn _btn btn-s2 outline-gray btn-sm" @click="$parent.step = 3">Anterior</button>
      <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" v-if="showNextBTN" @click="$parent.step = 5">Agendar</button>
    </div>

    <!-- Modal elegir tienda -->
    <b-modal modal-class="modal-marker" ref="modal-marker" hide-footer centered no-close-on-backdrop no-close-on-esc>
      <div class="box-basic-store-info">
        <h5 class="name">{{ selectedMarker.name }}</h5>

        <div class="descr" v-html="selectedMarker.content"></div>

        <div class="row box-rating">
          <div class="col col-lg-5 col-stars">
            <b-form-rating readonly inline value="4"></b-form-rating>
          </div>

          <div class="col col-lg col-summary">
            <a class="comment" @click="$refs['modal-comments'].show()">13 opiniones</a>
          </div>
        </div>
      </div>

      <div class="box-gallery">
        <swiper class="swiper" v-if="showModalGallery" :options="galleryOptions">
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
          <b-form-datepicker v-model="selectedMarker.fecha" :min="minDate" :date-disabled-fn="dateDisabled" :date-format-options="dateFormOpts" v-bind="datepickerOpts"  placeholder="Fecha" required></b-form-datepicker>
        </div>

        <h5 class="mt-4 pt-1 title">Próximo horario disponible</h5>
        <div class="box-time-date time">
          <b-form-select class="b-select-time" v-bind:class="{ 'text-muted' : selectedMarker.hora == null }" v-model="selectedMarker.hora">
            <b-form-select-option :value="null">Hora</b-form-select-option>
            <b-form-select-option value="1">9:00 a.m.</b-form-select-option>
            <b-form-select-option value="2">10:00 a.m.</b-form-select-option>
            <b-form-select-option value="3">11:00 a.m.</b-form-select-option>
            <b-form-select-option value="4">12:00 p.m.</b-form-select-option>
          </b-form-select>
          <!-- <b-form-timepicker v-model="$parent.form.hora" locale="es" minutes-step="30" v-bind="timepickerOpts"  placeholder="Hora" required></b-form-timepicker> -->
        </div>
      </div>

      <div class="box-buttons" v-if="selectedMarker.fecha && selectedMarker.hora">
        <button type="button" name="button" class="btn _btn btn-s2 bg-purple btn-sm" @click="hideMarkerModal">Agendar</button>
      </div>
    </b-modal>
    <!--  -->

    <!-- Modal comentarios -->
    <b-modal modal-class="modal-marker m-comments" ref="modal-comments" hide-footer hide-header no-close-on-backdrop no-close-on-esc>
      <div class="box-comments">
        <div class="bc-back">
          <a class="btn-back" @click="$refs['modal-comments'].hide()"><i class="fas fa-caret-left"></i> Volver</a>
        </div>

        <div class="bc-store-info">
          <div class="col col-image">
            <div class="placed-backg image" v-bind:style="{ backgroundImage: 'url(public/images/pages/get-glasses/store-2.jpg)' }"></div>
          </div>

          <div class="col col-info">
            <div class="box-basic-store-info">
              <h5 class="name">Óptica del Sur</h5>

              <div class="descr">
                <p>
                  Av. Cruz del Sur #1234<br />
                  Col. del Sur C.P. 36690
                </p>
              </div>

              <div class="row box-rating">
                <div class="col col-lg-5 col-stars">
                  <b-form-rating readonly inline value="4"></b-form-rating>
                </div>

                <div class="col col-lg col-summary">
                  <span class="comment" @click="$refs['modal-comments'].show()">13 opiniones</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row bc-comments">
          <div class="col-12 col-top">
            <h5>13 opiniones</h5>
          </div>

          <div class="col-12 col-comments">
            <div class="col-12 col-comment">
              <div class="col col-photo">
                <!-- <div class="placed-backg photo" v-bind:style="{ backgroundImage: 'url(public/images/pages/user/photo-0.jpg)' }"></div> -->
                <div class="placed-backg photo no-photo">M</div>
              </div>

              <div class="col col-text">
                <h6 class="name">Manual Huerta</h6>
                <h6 class="verified">Perfil verificado <i class="fas fa-check-circle icon"></i></h6>
                <h6 class="date">23 de Agosto del 2023</h6>

                <div class="comment">
                  El dr. que me atendió es una eminencia y los materiales que tiene ni se digan. 10/10.
                </div>
              </div>
            </div>

            <div class="col-12 col-comment" v-for="x in 15">
              <div class="col col-photo">
                <div class="placed-backg photo" v-bind:style="{ backgroundImage: 'url(public/images/pages/user/photo-0.jpg)' }"></div>
              </div>

              <div class="col col-text">
                <h6 class="name">Norma Rodriguez</h6>
                <h6 class="verified">Perfil verificado <i class="fas fa-check-circle icon"></i></h6>
                <h6 class="date">23 de Agosto del 2023</h6>

                <div class="comment">
                  Excelente óptica, gran variedad de armazones y una atención inigualable.
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </b-modal>
    <!--  -->

  </section>
</template>

<script>
export default {
  data() {
    return {
      mapCenter: { id: null, position: { lat: 20.6712689, lng: -103.3923762, zoom: 12.3 } }, // Centro del mapa

      markers: [
        { id: 1, position: { lat: 20.6407548, lng: -103.391109, zoom: 17.4 },   name: 'Óptica del Sur',   selected: false, content: `Av. Cruz del Sur #1234<br />Col. del Sur, C.P. 36690` },
        { id: 2, position: { lat: 20.689778, lng: -103.3623479, zoom: 17.4 },   name: 'Óptica del centro',selected: false, content: `Av Guadalupe 1579, Chapalita Oriente,<br />45040 Zapopan, Jal.` },
        { id: 3, position: { lat: 20.7217495, lng: -103.3931807, zoom: 17.4 },  name: 'Óptica del norte', selected: false, content: `Avenida Vallarta Eje Poniente 3959, Interior 22, La Gran Plaza, 45049 Zapopan, Jal.` },
        { id: 4, position: { lat: 20.63164, lng: -103.3771829, zoom: 17.4 },    name: 'Óptica del oriente',selected: false, content: `Av Guadalupe 1579, Chapalita Oriente,<br />45040 Zapopan, Jal.` },
      ],

      selectedMarker: {
        name: null,
        content: null,
        fecha: null,
        hora: null,
      },
      showNextBTN: false,

      gallery: [
        'public/images/pages/get-glasses/store-0.jpg',
        'public/images/pages/get-glasses/store-1.jpg',
        'public/images/pages/get-glasses/store-2.jpg',
        'public/images/pages/get-glasses/store-3.jpg',
      ],
      showModalGallery: false,

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
      },
      // == ==

      // == Carousels ==
      galleryOptions: {
        effect: 'fade',

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      },
      // == ==
    }
  },

  methods: {
    // Resetear marcador seleccionado
    resetMarkerInfo(deleteParent = false) {
      this.selectedMarker = {
        name: null,
        content: null,
        fecha: null,
        hora: null,
      };

      if(deleteParent) { // Borrar también el contenido de la tienda en la variable principal
        this.$parent.form.tienda = {};
      }
    },

    // Abrir modal con info del marcador
    showMarkerModal(marker, index) {
      this.selectedMarker = marker;
      this.$refs['modal-marker'].show();

      setTimeout(()=> { // Mostrar galería despues de cargar
        this.showModalGallery = true;
      }, 1000);
    },

    // Ocultar modal de marcador tras haber seleccionado fecha y hora
    hideMarkerModal() {
      this.$parent.form.tienda = this.selectedMarker;

      for (var i = 0; i < this.markers.length; i++) { // Marcar al seleccionado
        this.markers[i].selected = false;

        if(this.markers[i].id == this.selectedMarker.id) {
          this.markers[i].selected = true;
        }
      }

      setTimeout(()=> {
        this.showNextBTN = true;
        this.resetMarkerInfo;
      }, 700)

      this.$refs['modal-marker'].hide();
    },

    // Dias deshabilidatos en calendario
    dateDisabled(ymd, date) {
      // Disable weekends (Sunday = `0`, Saturday = `6`)
      const weekday = date.getDay();
      const day = date.getDate();
      // Return `true` if the date should be disabled
      return weekday === 0 || weekday === 6
    }
  },

  mounted() {
  },

  beforeMount(){
    this.resetMarkerInfo(true);

    const now = new Date();
    this.minDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  },
}
</script>
