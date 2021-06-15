<template>
  <div class="mt-16">
    <img
      v-for="(image, index) in images"
      :key="index"
      :src="image.src.replace('localhost', 'localhost:8000')"
      :alt="image.alt"
    >
  </div>
</template>

<script>
export default {
  props: {
    images: {
      type: Array,
      default: () => [
        { src: 'http://localhost/storage/35/1.jpg', alt: 'Image' },
        { src: 'http://localhost/storage/41/CEZAAR2020-01.jpg', alt: 'Image' },
        { src: 'http://localhost/storage/47/Malovcova-(2).jpg', alt: 'Image' },
        { src: 'http://localhost/storage/51/A3UMFIT_DSC8312.jpg', alt: 'Image' },
        { src: 'http://localhost/storage/57/_vmo5540-2.jpg', alt: 'Image' }
      ]
    }
  }
}
</script>
