<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="architect in results"
        :key="architect.id"
        class="border-b border-black py-3 flex items-start justify-between"
      >
        <div>
          <LinkArrowHover :url="architect.url">
            {{ architect.last_name }}<br>
            {{ architect.first_name }}<br>
            {{ architect.location_city }}
          </LinkArrowHover>
        </div>
      </div>
    </div>
    <table class="hidden lg:table w-full text-left">
      <thead>
        <tr>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('last_name')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('last_name', $event)"
            >
              {{ __('architects.last_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('first_name')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('first_name', $event)"
            >
              {{ __('architects.first_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('location_city')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('location_city', $event)"
            >
              {{ __('architects.location_city') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('works_count')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('works_count', $event)"
            >
              {{ __('architects.works_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('awards_count')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('awards_count', $event)"
            >
              {{ __('architects.awards_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('number')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSort('number', $event)"
            >
              {{ __('architects.number') }}
            </ButtonSortable>
          </th>
        </tr>
      </thead>
      <tbody class="text-sm">
        <tr
          v-for="architect in results"
          :key="architect.id"
          @click="goToDetail(architect.url)"
          class="border-b border-black hover:text-blue relative"
        >
          <td class="py-1">
            <LinkArrowHover :url="architect.url" class="link-area">
              {{ architect.last_name }}
            </LinkArrowHover>
          </td>
          <td class="py-1">
            {{ architect.first_name }}
          </td>
          <td class="py-1">
            {{ architect.location_city }}
          </td>
          <td class="py-1">
            {{ architect.works_count }}
          </td>
          <td class="py-1">
            {{ architect.awards_count }}
          </td>
          <td class="py-1">
            {{ architect.number }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div
    v-else
    class="mt-16"
  >
    {{ __('architects.no_results') }}
  </div>
</template>

<script>
import sortableMixin from '../sortableMixin'
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import LinkArrowHover from '../atoms/links/LinkArrowHover'
export default {
  components: {
    ButtonSortable,
    LinkArrowHover
  },
  mixins: [
    sortableMixin
  ],
  props: {
    results: {
      type: Array,
      required: true
    }
  },
  methods: {
    goToDetail (url) {
      window.location.href = url
    }
  }
}
</script>
