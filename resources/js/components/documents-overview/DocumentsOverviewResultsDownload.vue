<template>
  <a
    :href="document.file.url"
    :download="document.file.name"
    class="focus:outline-none hover:text-blue"
    target="_blank"
    :title="__('documents.download')"
  >
    <span class="pl-2 text-lg icon-download"></span>
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
