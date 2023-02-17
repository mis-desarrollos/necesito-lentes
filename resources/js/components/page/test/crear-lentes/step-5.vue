<template lang="html">
  <div>
    <!-- Paso 5 - parte 1 -->
    <div class="box-step-wr padding-b-plan step-5-1" v-if="stepPart == 1">
      <div class="wr">
        <div class="container main-con">
          <div class="row">
            <div class="col-12">
              <h2 class="h1s f-w-800 txt-blue">Encuentra tu óptica más cercana</h2>
            </div>

            <div class="col-12">
              <p class="mt-3 h4 f-w-600 txt-white">
                Si no conoces tu graduación, un profesional te hará un exámen sin costo.
              </p>
            </div>

            <div class="col-lg-9 col-city">
              <p>
                <b-form-select class="custom-select-s1 outline-white" size="lg" v-model="city">
                  <b-form-select-option :value="null">Selecciona una ciudad</b-form-select-option>
                  <b-form-select-option :value="c" v-for="(c, cInx) in cities" :key="'cInx-'+cInx">{{ c.name }}</b-form-select-option>
                </b-form-select>
              </p>
            </div>

            <div class="col-12 mt-4 col-btn-navs" v-if="showMapBtn">
              <b-button type="button" class="btn btn-lg btn-s1 bg-blue" @click="stepPart = 2">Ir al mapa</b-button>
            </div>

            <div class="col-12 mt-5 pt-3 col-btn-navs">
              <b-button type="button" class="btn btn-s1 outline-white no-border" @click="$parent.step = 4;"><u>Regresar</u></b-button>
            </div>
          </div>
        </div>

        <div class="box-head-s2"></div>
      </div>
    </div>
    <!--  -->

    <!-- Paso 5 - parte 2 -->
    <div class="box-step-wr step-5-2" v-if="stepPart == 2">
      <div class="map-container">
        <GmapMap
          :center="{ lat: city.coor.lat, lng: city.coor.lng }"
          :zoom="12">
          <GmapMarker
            :key="'iInx-'+iInx"
            v-for="(m, iInx) in markers"
            :position="m.position"
            :clickable="true"
            :draggable="false"
            :icon="{ url: (m.active ? 'public/images/shared/map-icon-blue-2.svg' : 'public/images/shared/map-icon-blue.svg')}"
            @click="selectBranch(iInx)"
          />
        </GmapMap>

        <div class="box-branc-info" v-if="showBranchInfo">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 col-info">
                <h4>Título de la Óptica</h4>

                <p>
                  Algo de descripción en proceso
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="wr">

      </div> -->
    </div>
    <!--  -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      stepPart: 1, // Partes del paso 5

      city: null,
      showMapBtn: false,
      showBranchInfo: false,

      cities: [
        { name: 'Guadalajara', coor: { lat: 20.6631902, lng: -103.3691427 } },
        { name: 'Ciudad de México', coor: { lat: 19.4310567, lng: -99.1319309 } },
        { name: 'Monterrey', coor: { lat: 25.6995133, lng: -100.2942476 } },
      ],

      markers: [
        { id: 5, active: false, position: { lat: 20.6696524, lng: -103.3638994 }, },
        { id: 6, active: false, position: { lat: 19.317365, lng: -99.2211063 }, },
        { id: 6, active: false, position: { lat: 25.7174052, lng: -100.2225495 }, },
      ],
    }
  },

  methods: {
    selectBranch(index) {
      for (var i = 0; i < this.markers.length; i++) {
        this.markers[i].active = false;
      }

      this.markers[index].active = true;
      this.showBranchInfo = true;
    }
  },

  watch: {
    city(val, oldVal) {
      this.showMapBtn = (val != null) ? true : false;
    },
  },
}
</script>
