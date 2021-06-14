<template>
  <div class="md:flex items-start">
    <!-- TODO: make filter group atomic -->
    <DocumentsOverviewFiltersGroup
      v-if="filters.awards && filters.awards.length > 0"
      :filters="filters.awards"
      :value="value"
      :title="`${__('works.awards')}:`"
      @input="onInput"
    />
    <ButtonClearFilters
      v-show="value && value.length > 0"
      @click="onCancel"
    />
  </div>
</template>

<script>
import ButtonClearFilters from '../atoms/buttons/ButtonClearFilters'
import DocumentsOverviewFiltersGroup from '../documents-overview/DocumentsOverviewFiltersGroup'

export default {
  components: {
    DocumentsOverviewFiltersGroup,
    ButtonClearFilters
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
    onCancel () {
      this.$emit('input', [])
    },
    onInput (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
