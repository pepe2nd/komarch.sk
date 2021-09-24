<template>
  <button
    type="button"
    class="w-full md:hidden px-4 py-0 focus:outline-none text-xl flex justify-center content-center"
    :class="{ 'text-blue': open }"
    @click="onClicked"
  >
    <svg
          class="mr-1 w-8 h-10 text-black"
          v-show="!open"
          fill="none"
          stroke-width="1"
          viewBox="0 0 24 32"
          stroke="currentColor"
        >
        <path d="M4 6h16M4 14h16M4 22h16"></path>
    </svg>
    Menu
  </button>
</template>

<script>
export default {
  data() {
      return {
        open: false,
      }
  },
  methods: {
    onClicked () {
      this.open = !this.open
      const navContent = document.querySelector('#nav-content')

      if (navContent) {
        navContent.classList.contains('nav-menu-expanded')
          ? navContent.classList.remove('nav-menu-expanded')
          : navContent.classList.add('nav-menu-expanded')
      }
    }
  }
}
</script>
