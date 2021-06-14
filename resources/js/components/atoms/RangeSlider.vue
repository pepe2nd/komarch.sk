<template>
  <vue-slider
    :value="value"
    v-bind="$attrs"
    @input="value => $emit('input', value)"
    v-on="$listeners"
  />
</template>

<script>
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

export default {
  components: {
    VueSlider
  },
  props: {
    value: {
      type: Array,
      default: () => [0, 30]
    }
  }
}
</script>
