<template>
  <router-link
    class="px-1 mr-2 hover:text-blue cursor-pointer text-sm"
    v-bind="$attrs"
  >
    ❪#<slot />❫
  </router-link>
</template>
