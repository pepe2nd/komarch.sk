<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      v-if="filters.roles && filters.roles.length > 0"
      :filters="filters.roles"
      :value="value"
      :title="`${__('documents.role')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.types && filters.types.length > 0"
      :filters="filters.types"
      :value="value"
      :title="`${__('documents.document_type')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.topics && filters.topics.length > 0"
      :filters="filters.topics"
      :value="value"
      :title="`${__('documents.topic')}:`"
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
import InputCheckboxGroup from './../atoms/InputCheckboxGroup'

export default {
  components: {
    InputCheckboxGroup,
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
