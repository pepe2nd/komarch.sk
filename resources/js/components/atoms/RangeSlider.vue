<template>
  <div class="relative h-8 mt-7">
    <vue-slider
      :value="value"
      v-bind="$attrs"
      :drag-on-click="true"
      :duration="0.5"
      :height="1"
      :tooltip="'none'"
      :dot-options="{ style: { borderColor: 'black', borderWidth: '1px', height: '11px', width: '11px' } }"
      :rail-style="{ backgroundColor: 'black' }"
      :process-style="{ backgroundColor: 'black', height: '200%' }"
      @change="$emit('input', $event)"
      v-on="$listeners"
    />
    <input
      :value="value[0]"
      class="absolute left-0 bottom-0 mt-10 focus:outline-none w-12 text-left md:text-sm"
      :placeholder="$attrs.min"
      @input="onMinChanged"
    >
    <input
      :value="value[1]"
      class="absolute right-0 bottom-0 mt-10 focus:outline-none w-12 text-right md:text-sm"
      :placeholder="$attrs.max"
      @input="onMaxChanged"
    >
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
  },
  methods: {
    onMinChanged (event) {
      const { value: newValue } = event.target

      if (newValue <= this.value[1] && newValue >= this.$attrs.min) {
        this.$emit('input', [newValue, this.value[1]])
      }
    },
    onMaxChanged (event) {
      const { value: newValue } = event.target

      if (newValue >= this.value[0] && newValue <= this.$attrs.max) {
        this.$emit('input', [this.value[0], newValue])
      }
    }
  }
}
</script>
