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
    }
  },
}
</script>
