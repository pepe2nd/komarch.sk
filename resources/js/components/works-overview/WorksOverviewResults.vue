<template>
  <div>
    <div
      v-if="!hideFilters"
      class="flex flex-wrap"
    >
      <span class="w-full mb-4 sm:mb-0 sm:w-32 text-sm">
        {{ count }}
      </span>
      <ButtonSortable
        :value="getSortDirectionFor('name')"
        class="sm:ml-8 text-sm"
        @input="setSort('name', $event)"
      >
        {{ __('generic.name') }}
      </ButtonSortable>
      <ButtonSortable
        :value="getSortDirectionFor('created_at')"
        class="sm:ml-16 text-sm"
        @input="setSort('created_at', $event)"
      >
        {{ __('generic.year') }}
      </ButtonSortable>
    </div>
    <isotope
      :options="getIsotopeOptions()"
      :list="results"
      class="md:-mx-5"
    >
      <TeaserWorkBig
        v-for="item in results"
        :key="item.id"
        :item="item"
        class="w-full md:p-5 md:w-1/4"
        data-grid-item
      />
    </isotope>
  </div>
</template>

<script>
import sortableMixin from '../sortableMixin'
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import TeaserWorkBig from '../TeaserWorkBig'
import isotope from 'vueisotope'

export default {
  components: {
    ButtonSortable,
    TeaserWorkBig,
    isotope
  },
  mixins: [
    sortableMixin
  ],
  props: {
    results: {
      type: Array,
      required: true
    },
    total: {
      type: Number,
      required: true
    },
    hideFilters: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  computed: {
    count () {
      let localizedObjectsLabel = 'works.objects_plural'

      if (this.total === 1) {
        localizedObjectsLabel = 'works.objects_one'
      }

      if (this.total > 1 && this.total < 5) {
        localizedObjectsLabel = 'works.objects_few'
      }

      return `(${this.total}) ${this.__(localizedObjectsLabel)}`
    }
  },
  methods: {
    getIsotopeOptions () {
      return {
        itemSelector: '[data-grid-item]',
        percentPosition: true
      }
    }
  }
}
</script>
