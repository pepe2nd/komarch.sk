<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="document in results"
        :key="document.id"
        class="border-b py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ document.created_at }}
          </div>
          <div>
            {{ document.name }}
          </div>
        </div>
        <DocumentsOverviewResultsMenu :document="document" />
      </div>
    </div>
    <table class="hidden lg:table w-full text-left">
      <thead>
        <tr>
          <th>
            <ButtonSortable
              v-model="sortingName"
              class="pb-10 text-sm"
            >
              {{ __('generic.name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingDate"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.created') }}
            </ButtonSortable>
          </th>
          <th
            class="select-none font-normal pb-10 text-sm"
            style="min-width: 90px"
          >
            {{ __('documents.preview') }}
          </th>
          <th
            class="select-none font-normal pb-10 text-sm"
            style="min-width: 200px"
          >
            {{ __('documents.download') }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="document in results"
          :key="document.id"
          class="border-b hover:text-blue hover:border-black"
        >
          <td class="py-1">
            {{ document.name }}
          </td>
          <td>
            {{ document.created_at }}
          </td>
          <td>
            <DocumentsOverviewResultsPreview :document="document" v-if="document.file.thumb" />
          </td>
          <td>
            <DocumentsOverviewResultsDownload :document="document" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div
    v-else
    class="mt-16"
  >
    {{ __('documents.no_documents') }}
  </div>
</template>

<script>
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import DocumentsOverviewResultsMenu from './DocumentsOverviewResultsMenu'
import DocumentsOverviewResultsPreview from './DocumentsOverviewResultsPreview'
import DocumentsOverviewResultsDownload from './DocumentsOverviewResultsDownload'

export default {
  components: {
    DocumentsOverviewResultsDownload,
    DocumentsOverviewResultsPreview,
    DocumentsOverviewResultsMenu,
    ButtonSortable
  },
  props: {
    value: {
      type: Object,
      required: true
    },
    results: {
      type: Array,
      required: true
    }
  },
  computed: {
    sortingName: {
      get () {
        return this.value.name
      },
      set (newValue) {
        this.$emit('input', {
          name: newValue
        })
      }
    },
    sortingDate: {
      get () {
        return this.value.date
      },
      set (newValue) {
        this.$emit('input', {
          date: newValue
        })
      }
    }
  }
}
</script>
