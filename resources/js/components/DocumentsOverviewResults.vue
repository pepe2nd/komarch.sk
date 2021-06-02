<template>
  <div>
    <div class="lg:hidden">
      <div
        v-for="item in results"
        :key="item.id"
        class="border-b py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ item.created_at }}
          </div>
          <div>
            {{ item.name }}
          </div>
        </div>
        <button class="flex-shrink-0 focus:outline-none block ml-4 w-10 h-10">
          <span class="inline-block rounded-full bg-black w-1 h-1" />
          <span class="inline-block rounded-full bg-black w-1 h-1" />
          <span class="inline-block rounded-full bg-black w-1 h-1" />
        </button>
      </div>
    </div>
    <table class="hidden lg:table mt-20 w-full text-left">
      <thead>
        <tr class="border-b py-1">
          <th-sortable
            v-model="sortingName"
            class="py-2"
          >
            {{ __('documents.name') }}
          </th-sortable>
          <th-sortable
            v-model="sortingDate"
            style="min-width: 200px"
          >
            {{ __('documents.created') }}
          </th-sortable>
          <th
            class="select-none"
            style="min-width: 90px"
          >
            {{ __('documents.preview') }}
          </th>
          <th
            class="select-none"
            style="min-width: 200px"
          >
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
          <td class="py-1">
            {{ item.name }}
          </td>
          <td>
            {{ item.created_at }}
          </td>
          <td>
            <button
              class="focus:outline-none hover:text-blue"
              @click="onPreview(item)"
            >
              Preview
            </button>
          </td>
          <td>
            <a
              :href="item.file.url"
              :download="item.file.name"
              class="focus:outline-none hover:text-blue"
            >
              Download
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
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
  },
  methods: {
    onPreview () {
      // TODO: implement
    }
  }
}
</script>
