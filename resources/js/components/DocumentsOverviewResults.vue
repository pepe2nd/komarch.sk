<template>
  <table class="mt-20 w-full text-left">
    <thead>
      <tr class="border-b py-1">
        <th-sortable v-model="sortingName">
          {{ __('documents.name') }}
        </th-sortable>
        <th-sortable v-model="sortingDate">
          {{ __('documents.created') }}
        </th-sortable>
        <th>
          {{ __('documents.preview') }}
        </th>
        <th>
          {{ __('documents.download') }}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in results"
        :key="item.id"
        class="border-b"
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
import ThSortable from './atoms/table/th-sortable'

export default {
  components: {
    ThSortable
  },
  props: {
    value: {
      type: String,
      default: null
    },
    results: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      sortingName: null,
      sortingDate: null
    }
  }
}
</script>
