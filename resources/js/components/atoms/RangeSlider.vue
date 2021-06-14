<template>
  <div>
    <slot />
    <vue-slider
      :value="value"
      v-bind="$attrs"
      :drag-on-click="true"
      @input="$emit('input', $event)"
      v-on="$listeners"
    />
  </div>
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
