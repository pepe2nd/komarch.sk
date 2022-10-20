<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="contest in results"
        :key="contest.id"
        class="border-b border-black py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ contest.created_at }}
          </div>
          <div>
            <LinkArrowHover :url="contest.url">
              {{ contest.title }}
            </LinkArrowHover>
          </div>
        </div>
      </div>
    </div>
    <table class="hidden lg:table w-full text-left">
      <thead>
        <tr>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('announced_at')"
              @input="setSort('announced_at', $event)"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.announced_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('results_published_at')"
              @input="setSort('results_published_at', $event)"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.results_published_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortDirectionFor('title')"
              @input="setSort('title', $event)"
              class="pb-10 text-sm"
            >
              {{ __('generic.title') }}
            </ButtonSortable>
          </th>
        </tr>
      </thead>
      <tbody class="text-sm">
        <tr
          v-for="contest in results"
          :key="contest.id"
          @click="goToDetail(contest.url)"
          class="border-b border-black hover:text-blue relative"
        >
          <td class="py-1">
            <span v-if="contest.announced_at">{{ contest.announced_at }}</span>
            <span class="text-gray-500" v-else>{{ __('contests.in_verification') }}</span>
          </td>
          <td class="py-1">
            {{ contest.results_published_at }}
          </td>
          <td class="py-1">
            <LinkArrowHover :url="contest.url" class="link-area">
              {{ contest.title }}
            </LinkArrowHover>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div
    v-else
    class="mt-16"
  >
    {{ __('contests.no_results') }}
  </div>
</template>

<script>
import sortableMixin from '../sortableMixin'
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import LinkArrowHover from '../atoms/links/LinkArrowHover'
import TagDate from '../atoms/tags/TagDate'

export default {
  components: {
    ButtonSortable,
    LinkArrowHover,
    TagDate
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
    goToDetail(url) {
      window.location.href = url
    }
  }
}
</script>
