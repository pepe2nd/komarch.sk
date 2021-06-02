<template>
  <div class="mr-12 mb-8">
    <h3 class="mb-5">
      {{ title }}
    </h3>
    <input-checkbox
      v-for="option in filters"
      :key="option.key"
      :value="value"
      :option="option"
      class="mr-12 py-1"
      @input="$emit('input', $event)"
    />
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
    }
  }
}
</script>
