<template>
  <router-link
    class="px-1 mr-2 hover:text-blue cursor-pointer text-sm"
    v-bind="$attrs"
  >
    <span class="pr-1">❪</span>#<slot /><span class="pl-1">❫</span>
  </router-link>
</template>
