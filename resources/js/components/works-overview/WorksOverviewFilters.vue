<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      :filters="filters.typologies || []"
      :value="value"
      :title="`${__('works.typology')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      :filters="filters.location_districts || []"
      :value="value"
      :cols="2"
      :title="`${__('works.location_districts')}:`"
      class="flex-grow w-72"
      @input="onInput"
    />
    <InputCheckboxGroup
      :filters="filters.awards || []"
      :value="value"
      :title="`${__('works.awards')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      :filters="filters.investors || []"
      :value="value"
      :title="`${__('works.investor')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      :filters="filters.citations || []"
      :value="value"
      :title="`${__('works.citations')}:`"
      @input="onInput"
    />
  </div>
</template>

<script>
import InputCheckboxGroup from '../atoms/InputCheckboxGroup'

export default {
  components: {
    InputCheckboxGroup
  },
  props: {
    value: {
      type: Array,
      required: true
    },
    filters: {
      type: Object,
      required: true
    }
  },
  methods: {
    onInput (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
