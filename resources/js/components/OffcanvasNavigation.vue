<template>
  <div>
    <ul class="flex space-x-2">
      <li v-for="item in topItems" :key="item.id" class="hidden md:block">
        <LinkArrowHover :url="item.url">
          {{ item.title }}
        </LinkArrowHover>
      </li>
      <li>
        <button
          @click="isOpen = true"
          type="button"
          class="focus:outline-none relative bottom-1 h-7 w-8 bg-white hover:text-blue"
        >
          <span
            aria-hidden="true"
            class="absolute mb-0.5 block h-px w-full -translate-y-1.5 transform bg-current"
          ></span>
          <span aria-hidden="true" class="absolute mb-0.5 block h-px w-full transform bg-current"></span>
          <span aria-hidden="true" class="absolute block h-px w-full translate-y-1.5 transform bg-current"></span>
        </button>
      </li>
    </ul>
    <transition name="slide">
      <div
        v-if="isOpen"
        class="fixed top-0 right-0 z-40 h-full w-full overflow-y-auto bg-black py-10 md:w-1/2 md:pt-16"
      >
        <!-- Close button -->
        <button
          @click="isOpen = false"
          class="focus:outline-none absolute right-0 z-50 mr-5 p-3 text-white hover:text-blue"
        >
          {{ __('app.close') }}
        </button>

        <div class="flex flex-col py-3 px-8">
          <!-- Navigation items -->
          <ul>
            <li v-for="(item, index) in items" :class="{ 'md:hidden': index < 4 }">
              <LinkArrowHover :url="item.url" class="whitespace-nowrap text-white">
                {{ item.title }}
              </LinkArrowHover>
              <ul v-if="item.subItems" class="pl-8">
                <li v-for="subMenuItem in item.subItems" :key="subMenuItem.id">
                  <LinkArrowHover :url="subMenuItem.url" class="whitespace-nowrap text-white">
                    {{ subMenuItem.title }}
                  </LinkArrowHover>
                </li>
              </ul>
            </li>
          </ul>
          <!-- Language switch -->
          <ul class="mt-6">
            <li class="capitalize" v-for="(item, index) in locales">
              <a
                rel="alternate"
                :hreflang="index"
                :title="item.native"
                :href="item.url"
                class="block leading-relaxed text-white hover:text-blue"
                :class="{ 'text-blue': index == currentLocale }"
              >
                {{ item.native }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import LinkArrowHover from './atoms/links/LinkArrowHover'

export default {
  components: {
    LinkArrowHover,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
    locales: {
      type: Object,
      required: true,
    },
    currentLocale: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      isOpen: false,
    }
  },
  computed: {
    topItems() {
      return this.items.slice(0, 4)
    },
  },
}
</script>

<style>
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s;
}

.slide-enter,
.slide-leave-to {
  transform: translateX(100%);
}
</style>
