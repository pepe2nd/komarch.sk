<template>
  <button
    type="button"
    class="w-full md:hidden px-4 py-0 focus:outline-none text-xl flex justify-center content-center"
    :class="{ 'text-blue': open }"
    @click="onClicked"
  >
    <div class="w-10 h-9 relative focus:outline-none bg-white">
        <div class="block w-5 absolute left-1/2 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true" class="block absolute h-0.5 mb-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
            <span aria-hidden="true" class="block absolute  h-0.5 mb-0.5 w-5 bg-current   transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
            <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
        </div>
    </div>

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
