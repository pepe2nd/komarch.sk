<template>
  <div class="mt-20">
    <div
      v-for="(item, index) in results"
      :key="index"
    >
      {{ item.name }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    results: {
      type: Array,
      required: true
    }
  }
}
</script>
