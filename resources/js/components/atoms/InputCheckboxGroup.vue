<template>
  <div class="mr-10 mb-8">
    <h3 class="mb-5 text-sm whitespace-nowrap">
      {{ title }}
    </h3>
    <div :class="gridColumns">
      <input-checkbox
        v-for="option in filters"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-5 py-1"
        @input="$emit('input', $event)"
      />
    </div>
  </div>
</template>

<script>
import InputCheckbox from '../atoms/InputCheckbox'

export default {
  components: {
    InputCheckbox
  },
  props: {
    title: {
      type: String,
      required: true
    },
    value: {
      type: Array,
      required: true
    },
    filters: {
      type: Array,
      required: true
    },
    cols: {
      type: Number,
      default: 1
    }
  },
  computed: {
    gridColumns () {
      let class_name = '';
      if (this.cols > 1) {
        class_name = 'grid'
        class_name += ' grid-cols-' + this.cols
      }
      return class_name
    }
  }
}
</script>
