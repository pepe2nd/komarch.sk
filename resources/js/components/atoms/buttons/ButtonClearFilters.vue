<template>
  <button
    class="mt-5 focus:outline-none hover:text-blue text-sm"
    v-on="$listeners"
  >
    <span class="icon-close text-lg mr-1" />
    <span>{{ __('generic.cancel_filters') }}</span>
  </button>
</template>
