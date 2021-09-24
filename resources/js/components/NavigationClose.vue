<template>
  <div class="md:hidden absolute bottom-0 mb-20 w-full">
      <button
        type="button"
        class="w-full px-4 py-0 focus:outline-none text-xl"
        @click="onClicked"
      >
        <span class="icon-close text-3xl text-black" />
      </button>
  </div>
</template>

<script>
export default {
  methods: {
    onClicked () {
      const navContent = document.querySelector('#nav-content')

      if (navContent) {
          navContent.classList.remove('nav-menu-expanded')
      }
    }
  }
}
</script>
