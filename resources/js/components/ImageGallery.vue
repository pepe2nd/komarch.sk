<template>
  <div
    v-if="images && images.length > 0"
    class="mt-16"
  >
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
        <img
          :srcset="image.srcset"
          :src="image.url"
          sizes="1px"
          :width="image.width"
          :height="image.height"
          ref="img"
          :alt="image.alt"
          class="w-full h-24 object-cover cursor-pointer"
          @click="onImageClicked(index)"
          onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});"
        >
      </SwiperSlide>
    </Swiper>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
import ImageGalleryDetail from './ImageGalleryDetail'
import axiosGet from './axiosGetMixin'

export default {
  components: {
    ImageGalleryDetail,
    Swiper,
    SwiperSlide
  },
  mixins: [
    axiosGet
  ],
  props: {
    workId: Number,
    required: true
  },
  //   images: {
  //     type: Array,
  //     default: () => [
  //       { src: 'http://localhost:8000/storage/35/1.jpg', alt: 'Image' },
  //       { src: 'http://localhost:8000/storage/41/CEZAAR2020-01.jpg', alt: 'Image' },
  //       { src: 'http://localhost:8000/storage/47/Malovcova-(2).jpg', alt: 'Image' },
  //       { src: 'http://localhost:8000/storage/51/A3UMFIT_DSC8312.jpg', alt: 'Image' },
  //       { src: 'http://localhost:8000/storage/57/_vmo5540-2.jpg', alt: 'Image' }
  //     ]
  //   }
  // },
  data () {
    return {
      images: [],
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
  async created () {
    const { data } = await this.axiosGet('works/'+ this.workId +'/images')
    this.images = data
  },
  methods: {
    onImageClicked (index) {
      this.selectedIndex = index
    }
  }
}
</script>
