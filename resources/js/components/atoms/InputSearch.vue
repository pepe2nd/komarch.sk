<template>
  <div class="flex align-center">
    <input
      type="search"
      :placeholder="placeholder"
      :aria-label="placeholder"
      class="border-0 border-b border-black w-full outline-none text-sm focus:ring-0 focus:border-blue px-1 py-0.5"
      :value="value"
      @input="$emit('input', $event.target.value)"
    >
    <span class="icon-search ml-1 text-lg" />
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
