<template>
  <a
    :href="document.file.url"
    class="focus:outline-none hover:text-blue"
    target="_blank"
    :title="downloadTitle"
    download
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
  },
  computed: {
    downloadTitle() {
      return this.__('documents.download') + ' (' + this.formatBytes(this.document.file.size) + ')'
    }
  },
  methods: {
    formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

  }

}
</script>
