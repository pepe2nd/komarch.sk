<template>
  <label class="py-1 flex items-center group cursor-pointer hover:text-blue">
    <input
      type="checkbox"
      v-bind="$attrs"
      :value="option.key"
      :checked="isChecked"
      class="cursor-pointer h-4 w-4 border border-black rounded-md bg-white checked:bg-black appearance-none focus:outline-none group-hover:border-blue group-hover:border-2"
      @change="onChange"
    >
    <span class="ml-2">
      {{ option.title }}<template v-if="option.items !== undefined">&nbsp;({{ option.items }})</template>
    </span>
  </label>
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      required: true
    },
    option: {
      type: Object,
      required: true
    }
  },
  computed: {
    isChecked () {
      return this.value.some(option => option.key === this.option.key)
    }
  },
  methods: {
    onChange () {
      if (this.isChecked) {
        this.$emit('input', this.value.filter(option => option.key !== this.option.key))
      } else {
        const newValue = [...this.value, this.option]
        this.$emit('input', newValue)
      }
    }
  }
}
</script>
