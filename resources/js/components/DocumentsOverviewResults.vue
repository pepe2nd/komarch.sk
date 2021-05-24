<template>
  <table class="mt-20">
    <tbody>
      <tr
        v-for="item in results"
        :key="item.id"
      >
        <td>
          {{ item.name }}
        </td>
        <td>
          {{ item.created_at }}
        </td>
        <td>
          <button>
            Preview
          </button>
        </td>
        <td>
          <button>
            Download
          </button>
        </td>
      </tr>
    </tbody>
  </table>
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
