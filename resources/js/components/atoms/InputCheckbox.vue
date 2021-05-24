<template>
  <label
    class="py-1 flex items-center"
    :class="{'group cursor-pointer hover:text-blue': !isChecked}"
  >
    <input
      type="checkbox"
      v-bind="$attrs"
      :value="option.key"
      :checked="isChecked"
      class="cursor-pointer h-5 w-5 border border-black rounded-lg bg-white checked:bg-black appearance-none focus:outline-none"
      :class="{'group-hover:border-blue group-hover:border-2': !isChecked}"
      @change="onChange"
    >
    <span class="ml-4">
      {{ option.title }}
      <template v-if="option.items !== undefined">
        ({{ option.items }})
      </template>
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
