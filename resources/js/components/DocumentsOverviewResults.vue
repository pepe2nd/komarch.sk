<template>
  <table class="mt-20 w-full text-left">
    <thead>
      <tr class="border-b py-1">
        <th @click="onNameSorting">
          {{ __('documents.name') }}
        </th>
        <th @click="onCreatedSorting">
          {{ __('documents.created') }}
        </th>
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
export default {
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
  methods: {
    onNameSorting () {
      if (this.value === 'name-descending') {
        this.$emit('input', 'name-ascending')
      } else if (this.value === 'name-ascending') {
        this.$emit('input', null)
      } else {
        this.$emit('input', 'name-descending')
      }
    },
    onCreatedSorting () {
      if (this.value === 'created-descending') {
        this.$emit('input', 'created-ascending')
      } else if (this.value === 'created-ascending') {
        this.$emit('input', null)
      } else {
        this.$emit('input', 'created-descending')
      }
    }
  }
}
</script>
