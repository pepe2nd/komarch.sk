import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMapbox from 'vue-mapbox'
import Mapbox from 'mapbox-gl'
import vClickOutside from 'v-click-outside'
import { Lang } from 'laravel-vue-lang'
import qs from 'qs'
import VueEasyLightbox from "vue-easy-lightbox";

require('./bootstrap')

Vue.component('NavigationToggle', require('./components/NavigationToggle').default)
Vue.component('NavigationClose', require('./components/NavigationClose').default)
Vue.component('FilterListingPosts', require('./components/FilterListingPosts').default)
Vue.component('FilterListingTenders', require('./components/FilterListingTenders').default)
Vue.component('WorksMap', require('./components/WorksMap').default)
Vue.component('ButtonCopy', require('./components/atoms/buttons/ButtonCopy').default)
Vue.component('SwiperPosts', require('./components/SwiperPosts').default)
Vue.component('PostsOverview', require('./components/PostsOverview').default)
Vue.component('DocumentsOverview', require('./components/documents-overview/DocumentsOverview').default)
Vue.component('ContestsOverview', require('./components/contests-overview/ContestsOverview').default)
Vue.component('ArchitectsOverview', require('./components/architects-overview/ArchitectsOverview').default)
Vue.component('WorksOverview', require('./components/works-overview/WorksOverview').default)
Vue.component('ArchitectWorks', require('./components/works-overview/ArchitectWorks').default)
Vue.component('RelatedWorks', require('./components/works-overview/RelatedWorks').default)
Vue.component('ImageGallery', require('./components/ImageGallery').default)
Vue.component('Clock', require('./components/Clock').default)
Vue.component('InputSearch', require('./components/InputSearch').default)

Vue.use(VueRouter)
Vue.use(VueMapbox, { mapboxgl: Mapbox })
Vue.use(Lang)
Vue.use(vClickOutside)
Vue.use(VueEasyLightbox);

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app',
  router: new VueRouter({
    mode: 'history',
    parseQuery: qs.parse,
    // qs stringifies array params better (closer to Laravel)
    stringifyQuery (query) {
      const result = qs.stringify(query)
      return result ? ('?' + result) : ''
    }
  })
})
