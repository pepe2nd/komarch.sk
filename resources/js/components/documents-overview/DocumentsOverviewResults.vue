<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="document in results"
        :key="document.id"
        class="border-b border-black py-3 flex items-start justify-between"
      >
        <div>
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
              :value="getSortDirectionFor('name')"
              @input="setSort('name', $event)"
              class="pb-10 text-sm"
            >
              {{ __('generic.name') }}
            </ButtonSortable>
          </th>
          <th
            class="select-none font-normal pb-10 text-sm w-20"
          >
            {{ __('documents.preview') }}
          </th>
          <th
            class="select-none font-normal pb-10 text-sm w-80"
          >
            {{ __('documents.download') }}
          </th>
        </tr>
      </thead>
      <tbody class="text-sm">
        <tr
          v-for="document in results"
          :key="document.id"
          class="border-b border-black hover:text-blue relative"
        >
          <td class="py-1">
            {{ document.name }}
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
import sortableMixin from '../sortableMixin'
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
  mixins: [
    sortableMixin
  ],
  props: {
    results: {
      type: Array,
      required: true
    }
  }
}
</script>
