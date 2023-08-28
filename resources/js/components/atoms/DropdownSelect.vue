<template>
  <div class="mr-10 mb-8">
    <h3 class="mb-5 whitespace-nowrap text-sm">
      {{ title }}
    </h3>
    <select
      class="w-full rounded-md border border-black bg-white px-2.5 py-1 text-sm text-black focus:border-blue focus:ring-blue"
      @input="onChange"
    >
      <option>{{ placeholder }}</option>
      <option v-for="option in filters" :key="option.key" :value="option.key" :selected="isSelected(option)">
        {{ (translationFile) ? __(translationFile + '.' + option.title) : option.title
        }}<template v-if="option.items !== undefined">&nbsp;({{ option.items }})</template>
      </option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
      default: '',
    },
    value: {
      type: Array,
      required: true,
    },
    filters: {
      type: Array,
      required: true,
    },
    translationFile: {
      type: String,
      default: null,
    },
  },
  methods: {
    isSelected(option) {
      return this.value.find((o) => o.key === option.key)
    },
    onChange(event) {
      this.$emit('input', [this.filters.find((o) => o.key == event.target.value) || ''])
    },
  },
}
</script>
