<template>
  <router-link
    class="px-1 mr-2 hover:text-blue cursor-pointer text-sm"
    v-bind="$attrs"
  >
    ❪<span class="px-1">#<slot /></span>❫
  </router-link>
</template>
