<template>
  <div class="md:flex items-start">
    <div class="mr-12 mb-8">
      <h3 class="mb-5">
        Typ dokumentu:
      </h3>
      <input-checkbox
        v-for="option in filters.types"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-1"
        @input="onInput"
      />
    </div>
    <div class="mr-12 mb-8">
      <h3 class="mb-5">
        Téma:
      </h3>
      <input-checkbox
        v-for="option in filters.topics"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-1"
        @input="onInput"
      />
    </div>
    <div class="mr-12 mb-8">
      <h3 class="mb-5">
        Rola:
      </h3>
      <input-checkbox
        v-for="option in filters.roles"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-1"
        @input="onInput"
      />
    </div>
    <ButtonClearFilters
      v-show="value.length > 0"
      @click="onCancel"
    />
  </div>
</template>

<script>
import InputCheckbox from './atoms/InputCheckbox'
import ButtonClearFilters from './atoms/ButtonClearFilters'

export default {
  components: {
    InputCheckbox,
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
