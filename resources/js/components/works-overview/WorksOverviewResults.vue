<template>
  <div class="mt-16">
    <div class="flex">
      {{ count }}
      <ButtonSortable
        v-model="sortingName"
        class="pb-10 ml-16"
      >
        {{ __('generic.name') }}
      </ButtonSortable>
      <ButtonSortable
        v-model="sortingYear"
        class="pb-10 ml-16"
      >
        {{ __('generic.year') }}
      </ButtonSortable>
    </div>
    <div class="flex flex-wrap">
      <WorkTeaserBig
        v-for="item in results"
        :key="item.id"
        :item="item"
        class="w-1/4"
      />
    </div>
  </div>
</template>

<script>
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import WorkTeaserBig from '../WorkTeaserBig'

export default {
  components: {
    ButtonSortable,
    WorkTeaserBig
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
    count () {
      // TODO: add localization / plural forms
      return `(${this.results.length}) Objektov`
    },
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
    sortingYear: {
      get () {
        return this.value.year
      },
      set (newValue) {
        this.$emit('input', {
          year: newValue
        })
      }
    }
  }
}
</script>
