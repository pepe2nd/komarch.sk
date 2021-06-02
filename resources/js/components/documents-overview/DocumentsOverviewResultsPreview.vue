<template>
  <button
    class="focus:outline-none hover:text-blue"
    @click="onPreview"
  >
    Preview
  </button>
</template>

<script>
export default {
  props: {
    document: {
      type: Object,
      required: true
    }
  },
  methods: {
    onPreview () {
      // TODO: implement
    }
  }
}
</script>
