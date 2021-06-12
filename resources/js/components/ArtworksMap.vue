<template>
  <div class="relative w-100 map-artworks mt-4">
    <MglMap
      :access-token="accessToken"
      :map-style="mapStyle"
      :center="center"
      :zoom="zoom"
      :attribution-control="false"
    >
      <MglGeojsonLayer
        :source-id="geoJsonSource.type"
        :source="geoJsonSource"
        layer-id="clustersLayer"
        :layer="clustersLayer"
        @mouseenter="onClusterMouseEnter"
        @mouseleave="onClusterMouseLeave"
        @click="onClusterClicked"
      />
      <MglGeojsonLayer
        :source-id="geoJsonSource.type"
        :source="geoJsonSource"
        layer-id="clustersCount"
        :layer="clustersCountLayer"
      />
      <MglGeojsonLayer
        :source-id="geoJsonSource.type"
        :source="geoJsonSource"
        layer-id="unclusteredPoints"
        :layer="unclusteredPointsLayer"
        @mouseenter="onPointMouseEnter"
        @mouseleave="onPointMouseLeave"
        @click="onPointClicked"
      />
      <!-- https://github.com/soal/vue-mapbox/issues/133 -->
      <MglMarker :coordinates="popup.center">
        <template slot="marker">
          <span />
        </template>
        <MglPopup
          :coordinates="popup.center"
          :showed="popup.showed"
          :close-button="false"
          anchor="bottom"
          :offset="10"
        >
          <div>
            Popup
          </div>
        </MglPopup>
      </MglMarker>
      <MglNavigationControl
        position="top-left"
        :show-compass="false"
      />
      <MglAttributionControl position="bottom-right" />
    </MglMap>
  </div>
</template>

<script>
import { MglMap, MglNavigationControl, MglAttributionControl, MglGeojsonLayer, MglMarker, MglPopup } from 'vue-mapbox'
import { fetchArtworkMarkers } from './artworkMarkersMockApi'

export const SVK_CENTER_LONGITUDE = 19.696058
export const SVK_CENTER_LATITUDE = 48.6737532

export default {
  components: {
    MglMap,
    MglGeojsonLayer,
    MglMarker,
    MglPopup,
    MglNavigationControl,
    MglAttributionControl
  },
  props: {
    center: {
      type: Array,
      default: () => [SVK_CENTER_LONGITUDE, SVK_CENTER_LATITUDE]
    },
    zoom: {
      type: Number,
      default: 6
    },
    // https://docs.mapbox.com/api/maps/styles/
    mapStyle: {
      type: String,
      default: 'mapbox://styles/mapbox/streets-v11'
    }
  },
  data () {
    return {
      geoJsonSource: {
        type: 'geojson',
        data: {},
        cluster: true,
        clusterMaxZoom: 14,
        clusterRadius: 50
      },
      popup: {
        center: [SVK_CENTER_LONGITUDE, SVK_CENTER_LATITUDE],
        showed: false
      },
      hoveredMarker: null,
      activeId: 1
    }
  },
  computed: {
    accessToken () {
      return process.env.MIX_MAPBOX_TOKEN
    },
    clustersLayer () {
      return {
        type: 'circle',
        filter: ['has', 'point_count'],
        paint: {
          'circle-color': 'black',
          // Using step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
          'circle-radius': [
            'step',
            ['get', 'point_count'],
            20,
            10,
            30,
            50,
            40
          ]
        }
      }
    },
    clustersCountLayer () {
      return {
        type: 'symbol',
        filter: ['has', 'point_count'],
        layout: {
          'text-field': '{point_count_abbreviated}',
          'text-size': 12
        },
        paint: {
          'text-color': 'white'
        }
      }
    },
    unclusteredPointsLayer () {
      return {
        type: 'circle',
        filter: ['!', ['has', 'point_count']],
        paint: {
          'circle-color': 'black',
          'circle-radius': 7,
          'circle-stroke-width': [
            'case',
            ['boolean', ['feature-state', 'hover'], false],
            3,
            1
          ],
          'circle-stroke-color': '#707070'
        }
      }
    },
    activePointLayer () {
      return {
        type: 'circle',
        filter: [
          'all',
          ['!has', 'point_count'],
          ['==', 'id', this.activeId]
        ],
        paint: {
          'circle-color': 'white',
          'circle-radius': 15,
          'circle-stroke-width': 1,
          'circle-stroke-color': '#707070'
        }
      }
    }
  },
  async created () {
    const response = await fetchArtworkMarkers()
    this.geoJsonSource.data = response
  },
  methods: {
    onClusterMouseEnter (event) {
      event.map.getCanvas().style.cursor = 'pointer'
    },
    onClusterMouseLeave (event) {
      event.map.getCanvas().style.cursor = null
    },
    onPointMouseEnter (event) {
      event.map.getCanvas().style.cursor = 'pointer'

      if (!this.hoveredMarker) {
        this.hoveredMarker = event.map.queryRenderedFeatures(event.mapboxEvent.point, { layers: ['unclusteredPoints'] })[0]
      }

      event.map.setFeatureState(
        { source: this.geoJsonSource.type, id: this.hoveredMarker.id },
        { hover: true }
      )
    },
    onPointMouseLeave (event) {
      event.map.getCanvas().style.cursor = null

      event.map.setFeatureState(
        { source: this.geoJsonSource.type, id: this.hoveredMarker.id },
        { hover: false }
      )

      this.hoveredMarker = null
    },
    onClusterClicked (event) {
      const feature = event.map.queryRenderedFeatures(event.mapboxEvent.point, { layers: ['clustersLayer'] })[0]

      event.map.getSource(this.geoJsonSource.type).getClusterExpansionZoom(feature.properties.cluster_id, (err, zoom) => {
        if (err) {
          console.error(err)
          return
        }

        event.map.easeTo({
          center: feature.geometry.coordinates,
          zoom: zoom
        })
      })
    },
    async onPointClicked (event) {
      const feature = event.map.queryRenderedFeatures(event.mapboxEvent.point, { layers: ['unclusteredPoints'] })[0]
      this.popup.center = feature.geometry.coordinates
      this.popup.showed = false
      await this.$nextTick()
      this.popup.showed = true
    }
  }
}
</script>

<style>
@import "../../css/mapbox.css";

.mapboxgl-ctrl-zoom-out {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E %3Cpath style='fill:%23333333;' d='m 7,9 c -0.554,0 -1,0.446 -1,1 0,0.554 0.446,1 1,1 l 6,0 c 0.554,0 1,-0.446 1,-1 0,-0.554 -0.446,-1 -1,-1 z'/%3E %3C/svg%3E");
}

.mapboxgl-ctrl-zoom-in {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E %3Cpath style='fill:%23333333;' d='M 10 6 C 9.446 6 9 6.4459904 9 7 L 9 9 L 7 9 C 6.446 9 6 9.446 6 10 C 6 10.554 6.446 11 7 11 L 9 11 L 9 13 C 9 13.55401 9.446 14 10 14 C 10.554 14 11 13.55401 11 13 L 11 11 L 13 11 C 13.554 11 14 10.554 14 10 C 14 9.446 13.554 9 13 9 L 11 9 L 11 7 C 11 6.4459904 10.554 6 10 6 z'/%3E %3C/svg%3E");
}
</style>
