<template>
  <div class="mt-16">
    <ImageGalleryDetail :image="images[selectedIndex]" />
    <Swiper
      v-if="images.length > 1"
      :options="swiperOptions"
    >
      <SwiperSlide
        v-for="(image, index) in images"
        :key="index"
        class="mt-6"
      >
        <!-- TODO: remove the replacement of localhost -->
        <img
          :src="image.src.replace('localhost', 'localhost:8000')"
          :alt="image.alt"
          class="w-full h-24 object-cover cursor-pointer"
          @click="onImageClicked(index)"
        >
      </SwiperSlide>
    </Swiper>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import ImageGalleryDetail from './ImageGalleryDetail'

export default {
  components: {
    ImageGalleryDetail,
    Swiper,
    SwiperSlide
  },
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
  },
  data () {
    return {
      selectedIndex: 0,
      swiperOptions: {
        slidesPerView: 2,
        spaceBetween: 20,
        breakpoints: {
          // when window width is >= 640px
          640: {
            slidesPerView: 3,
            spaceBetween: 20
          },
          // when window width is >= 1024px
          1024: {
            slidesPerView: 4,
            spaceBetween: 20
          }
        }
      }
    }
  },
  methods: {
    onImageClicked (index) {
      this.selectedIndex = index
    }
  }
}
</script>
