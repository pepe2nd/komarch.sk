<template>
  <th
    class="cursor-pointer hover:text-blue group font-normal"
    @click="onClick"
  >
    <div class="flex items-center select-none">
      <slot />
      <span
        class="icon-arrow-b w-5 h-5 rounded-full flex items-center justify-center ml-2 text-sm"
        :class="{ 'bg-black text-white group-hover:bg-blue': value === 'desc'}"
      />
      <span
        class="icon-arrow-t w-5 h-5 rounded-full flex items-center justify-center ml-1 text-sm"
        :class="{ 'bg-black text-white group-hover:bg-blue': value === 'asc'}"
      />
    </div>
  </th>
</template>

<script>
export default {
  props: {
    value: {
      type: [String, null],
      default: null
    }
  },
  methods: {
    onClick () {
      if (this.value === 'desc') {
        this.$emit('input', 'asc')
      } else if (this.value === 'asc') {
        this.$emit('input', null)
      } else {
        this.$emit('input', 'desc')
      }
    }
  }
}
</script>
