export default {
  props: {
    sort: {
      type: Object,
      required: true
    }
  },
  methods: {
    getSortDirectionFor (name) {
      if (this.sort.name === name) return this.sort.direction
      return null
    },
    setSort (name, direction) {
      this.$emit('sort', { name, direction })
    }
  }
}
