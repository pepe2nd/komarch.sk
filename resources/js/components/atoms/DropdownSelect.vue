<template>
  <div class="mr-10 mb-8 w-60">
    <h3 class="mb-5 whitespace-nowrap text-sm">
      {{ title }}
    </h3>
    <select
      id="regions"
      class="w-full rounded-md border border-black bg-white px-2.5 py-1 text-sm text-black focus:border-blue focus:ring-blue"
    >
      <option selected>{{ placeholder }}</option>
      <option v-for="option in filters" :key="option.key" :value="value">
        {{ option.title }}<template v-if="option.items !== undefined">&nbsp;({{ option.items }})</template>
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
  },
}
</script>
