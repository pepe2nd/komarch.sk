<template>
  <div>
    <a
      :href="document.file.thumb"
      class="focus:outline-none hover:text-blue"
      target="_blank"
      @click.prevent.stop="isDetailOpen = true"
      :title="__('documents.preview')"
    >
      <span class="pl-2 text-lg icon-preview"></span>
    </a>

    <transition
      name="image-fade"
      mode="in-out"
    >
      <div
        v-if="isDetailOpen"
        class="fixed inset-0 z-10 flex items-center justify-center p-6"
      >
        <div
          class="bg-black opacity-70 absolute inset-0 cursor-zoom-out"
          @click="isDetailOpen = false"
        />
        <div class="max-w-screen-lg max-h-full w-full relative">
          <img
            class="object-contain h-1/2-screen m-auto"
            :src="document.file.thumb"
          >
          <button
            class="w-14 h-14 absolute top-0 right-0 focus:outline-none flex items-center justify-center"
            @click="isDetailOpen = false"
          >
            <span class="icon-close text-3xl text-white" />
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    document: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isDetailOpen: false
    }
  }
}
</script>
