<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      :filters="filters.typologies || []"
      :value="value"
      :title="`${__('works.typology')}:`"
      @input="onInput"
      class="flex-grow xl:whitespace-nowrap"
    />
    <InputCheckboxGroup
      :filters="filters.location_districts || []"
      :value="value"
      :title="`${__('works.location_districts')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      :filters="filters.awards || []"
      :value="value"
      :title="`${__('works.awards')}:`"
      @input="onInput"
      class="lg:flex-grow lg:whitespace-nowrap"
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
      class="xl:flex-grow xl:whitespace-nowrap"
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
