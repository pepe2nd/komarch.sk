<template>
  <div
    v-if="images && images.length > 0"
  >
    
    <div @click="() => showImg(selectedIndex)">
      <ImageGalleryDetail :image="images[selectedIndex]"  />
    </div>  
      
    <vue-easy-lightbox
      :visible="visible"
      :imgs="imgs"
      :index="selectedIndex"
      @hide="handleHide"
    ></vue-easy-lightbox>
    
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
          @click="onThumbnailClicked(index)"
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
    sourceUrl: String,
    required: true
  },
  data () {
    return {
      visible: false,
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
  computed: {
    imgs() {
      return this.images.map(o => o['url'])
    }
  },
  async created () {
    const { data } = await this.axiosGet(this.sourceUrl)
    this.images = data
    console.log(this.imgs)
  },
  methods: {
    onThumbnailClicked (index) {
      this.selectedIndex = index
    },
    showImg (index) {
      this.visible = true
    },
    handleHide () {
      this.visible = false
    }
  }
}
</script>
