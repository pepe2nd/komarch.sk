<template>
  <div>
    <button
      class="flex-shrink-0 focus:outline-none block ml-4 w-10 h-10"
      @click="isOpen = !isOpen"
    >
      <span class="inline-block rounded-full bg-black w-1 h-1" />
      <span class="inline-block rounded-full bg-black w-1 h-1" />
      <span class="inline-block rounded-full bg-black w-1 h-1" />
    </button>
    <div v-if="isOpen">
      <DocumentsOverviewResultsPreview :document="document" />
      <DocumentsOverviewResultsDownload :document="document" />
    </div>
  </div>
</template>

<script>
import DocumentsOverviewResultsPreview from './DocumentsOverviewResultsPreview'
import DocumentsOverviewResultsDownload from './DocumentsOverviewResultsDownload'

export default {
  components: {
    DocumentsOverviewResultsPreview,
    DocumentsOverviewResultsDownload
  },
  props: {
    document: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isOpen: false
    }
  }
}
</script>
