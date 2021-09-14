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
              v-model="sortingAnnounced"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.announced_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingFinished"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.next_proposal') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingResultsPublished"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.results_published_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingTitle"
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
            {{ contest.announced_at }}
          </td>
          <td class="py-1">
            <span class="whitespace-nowrap" v-if="contest.next_proposal">
              {{ contest.next_proposal }}
              <TagDate class="ml-3" :title="contest.next_proposal">
                <span class="icon-clock" />
                {{ contest.next_proposal_diff }}
              </TagDate>
            </span>
            <span class="text-gray-500" v-else>
              {{ contest.finished_at }}
            </span>

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
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import LinkArrowHover from '../atoms/links/LinkArrowHover'
import TagDate from '../atoms/tags/TagDate'
export default {
  components: {
    ButtonSortable,
    LinkArrowHover,
    TagDate
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
    sortingTitle: {
      get () {
        return this.value.title
      },
      set (newValue) {
        this.$emit('input', {
          title: newValue
        })
      }
    },
    sortingAnnounced: {
      get () {
        return this.value.announcedAt
      },
      set (newValue) {
        this.$emit('input', {
          announcedAt: newValue
        })
      },
    },
    sortingFinished: {
      get () {
        return this.value.finishedAt
      },
      set (newValue) {
        this.$emit('input', {
          finishedAt: newValue
        })
      }
    },
    sortingResultsPublished: {
      get () {
        return this.value.resultsPublishedAt
      },
      set (newValue) {
        this.$emit('input', {
          resultsPublishedAt: newValue
        })
      }
    }
  },
  methods: {
    goToDetail(url) {
      window.location.href = url
    }
  }
}
</script>
