<template>
  <div
    v-click-outside="onClickOutside"
    class="relative"
  >
    <button
      class="ml-auto flex-shrink-0 focus:outline-none block ml-4 w-10 h-10"
      @click="isOpen = !isOpen"
    >
      <span class="inline-block rounded-full bg-black w-1 h-1" />
      <span class="inline-block rounded-full bg-black w-1 h-1" />
      <span class="inline-block rounded-full bg-black w-1 h-1" />
    </button>
    <div
      v-if="isOpen"
      class="absolute z-10 right-0 top-full bg-white shadow-lg p-4 rounded"
    >
      <DocumentsOverviewResultsPreview
        :document="document"
        class="block p-2"
      />
      <DocumentsOverviewResultsDownload
        :document="document"
        class="block p-2"
      />
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
  },
  methods: {
    onClickOutside () {
      this.isOpen = false
    }
  }
}
</script>
