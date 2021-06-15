<template>
  <div class="mt-32">
    <div class="flex flex-wrap">
      <span class="w-full mb-4 sm:mb-0 sm:w-32 text-sm">
        {{ count }}
      </span>
      <ButtonSortable
        v-model="sortingName"
        class="sm:ml-8 text-sm"
      >
        {{ __('generic.name') }}
      </ButtonSortable>
      <ButtonSortable
        v-model="sortingYear"
        class="sm:ml-16 text-sm"
      >
        {{ __('generic.year') }}
      </ButtonSortable>
    </div>
    <transition-group
      name="works-overview"
      mode="out-in"
      class="md:grid grid-cols-4 gap-x-10"
    >
      <TeaserWorkBig
        v-for="item in results"
        :key="item.id"
        :item="item"
      />
    </transition-group>
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
      let localizedObjectsLabel = 'works.objects_plural'

      if (this.results.length === 1) {
        localizedObjectsLabel = 'works.objects_one'
      }

      if (this.results.length > 1 && this.results.length < 5) {
        localizedObjectsLabel = 'works.objects_few'
      }

      return `(${this.results.length}) ${this.__(localizedObjectsLabel)}`
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

<style>
.works-overview-enter-active {
  @apply transition-all duration-700;
}

.works-overview-enter {
  @apply transform opacity-0 translate-y-5;
}
</style>
