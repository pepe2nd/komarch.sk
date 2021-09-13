<template>
  <button
    class="group block leading-relaxed flex items-center hover:text-blue focus:outline-none"
    v-on="$listeners"
  >
    <slot />
    <span class="icon-arrow-b transform group-hover:translate-y-2 ml-2 duration-200" />
  </button>
</template>
