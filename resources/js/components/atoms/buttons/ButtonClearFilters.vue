<template>
  <button
    class="mt-5 focus:outline-none hover:text-blue"
    v-on="$listeners"
  >
    <span class="icon-close text-sm mr-1" />
    {{ __('generic.cancel_filters') }}
  </button>
</template>
