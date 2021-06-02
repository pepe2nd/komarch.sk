<template>
  <a
    :href="document.file.url"
    :download="document.file.name"
    class="focus:outline-none hover:text-blue"
    target="_blank"
  >
    <!-- TODO: add icon when available -->
    Download
  </a>
</template>

<script>
export default {
  props: {
    document: {
      type: Object,
      required: true
    }
  }
}
</script>
