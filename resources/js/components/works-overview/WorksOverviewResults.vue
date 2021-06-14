<template>
  <div class="mt-16">
    <div class="flex">
      <span class="w-32">
        {{ count }}
      </span>
      <ButtonSortable
        v-model="sortingName"
        class="pb-10 ml-12"
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
      <TeaserWorkBig
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
import TeaserWorkBig from '../TeaserWorkBig'

export default {
  components: {
    ButtonSortable,
    TeaserWorkBig
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
