<template>
  <div>
    <GmapMap
      :center="center"
      :zoom="19"
      map-type-id="terrain"
      class="custom-size"
    >
      <GmapMarker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :clickable="true"
        :draggable="false"
        @click="center = m.position"
      />
    </GmapMap>
  </div>
</template>

<script>
export default {
  props: ["coordinates"],
  name: "Map",
  data() {
    return {
      markers: [{ position: this.coordinates }],
      center: this.coordinates,
    }
  },
};
</script>

<style>
.custom-size {
  width: 100%;
  height: 300px;
  margin: auto;
}
</style>