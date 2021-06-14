<template>
  <div>
    <slot />
    <div class="relative">
      <vue-slider
        :value="value"
        v-bind="$attrs"
        :drag-on-click="true"
        @change="$emit('input', $event)"
        v-on="$listeners"
      />
      <input
        :value="value[0]"
        class="absolute left-0 bottom-0 mb-4 focus:outline-none w-10"
      >
      <input
        :value="value[1]"
        class="absolute right-0 bottom-0 mb-4 focus:outline-none w-10"
      >
    </div>
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
