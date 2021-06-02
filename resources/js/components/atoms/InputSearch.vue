<template>
  <div class="flex align-center">
    <input
      type="search"
      :placeholder="placeholder"
      :aria-label="placeholder"
      class="border-b border-gray-900 w-full outline-none md:text-sm"
      :value="value"
      @input="$emit('input', $event.target.value)"
    >
    <span class="icon-search ml-1 text-lg md:text-base" />
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: ''
    },
    placeholder: {
      type: String,
      default: 'Search...'
    }
  }
}
</script>
