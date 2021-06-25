<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="contest in results"
        :key="contest.id"
        class="border-b py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ contest.created_at }}
          </div>
          <div>
            {{ contest.title }}
          </div>
        </div>
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
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="contest in results"
          :key="contest.id"
          class="border-b"
        >
          <td class="py-1">
            {{ contest.title }}
          </td>
          <td>
            {{ contest.created_at }}
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

export default {
  components: {
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
