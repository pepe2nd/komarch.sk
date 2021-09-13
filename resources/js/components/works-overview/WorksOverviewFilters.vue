<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      v-if="filters.typologies && filters.typologies.length > 0"
      :filters="filters.typologies"
      :value="value"
      :title="`${__('works.typology')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.location_districts && filters.location_districts.length > 0"
      :filters="filters.location_districts"
      :value="value"
      :title="`${__('works.location_districts')}:`"
      @input="onInput"
      :cols=2
      class="flex-grow w-72"
    />
    <InputCheckboxGroup
      v-if="filters.awards && filters.awards.length > 0"
      :filters="filters.awards"
      :value="value"
      :title="`${__('works.awards')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.investors && filters.investors.length > 0"
      :filters="filters.investors"
      :value="value"
      :title="`${__('works.investor')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.citations && filters.citations.length > 0"
      :filters="filters.citations"
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
