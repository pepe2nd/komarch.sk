<template>
  <div class="w-full" v-click-outside="hideMenu">
      <div class="mt-1 flex rounded-md shadow-sm">
          <input
              type="text"
              name="search"
              class="border-b border-gray-900 w-full outline-none text-sm focus:shadow-outline"
              :placeholder="placeholder"
              aria-label="Search"
              v-model="search"
              @input="onChange"
              @keyup.up="onPrevItemFocused"
              @keyup.down="onNextItemFocused"
              @keyup.enter="onFocusedItemSelected"
              ref="searchBox"
          />
      </div>
      <aside class="absolute z-10 flex flex-col items-start w-72 md:w-96 bg-white border rounded-md shadow-sm mt-1"
             role="menu" aria-labelledby="menu-heading" v-if="Object.keys(this.lists).length > 0 && showSearchItems == true">
          <div v-for="(items, category, categoryIndex) in lists" v-if="items.length > 0" class="w-full">
            <h5 class="tracking-tight mt-3 mb-1 text-gray-500 px-2">{{ __('search.' + category) }}</h5>
            <ul class="flex flex-col w-full">
                <li
                    class="px-2 py-1 space-x-2"
                    :class="{ 'bg-blue text-white': isActive(categoryIndex, itemIndex) }"
                    v-for="(item, itemIndex) in items"
                    @mouseover="focusedIndex = {'category' : categoryIndex, 'item': itemIndex}"
                    @click="onItemSelected(item)"
                >{{ item.title }}</li>
            </ul>
          </div>
      </aside>
  </div>
</template>


<script>

export default {
  props: {
      placeholder: {
        type: String
      }
  },
  data() {
      return {
          search: "",
          selectedItem: "",
          showSearchItems: false,
          lists: {},
          focusedIndex: {
              'category': null,
              'item': null
          }
      }
  },
  computed: {
    focusedCategory() {
      return Object.keys(this.lists)[this.focusedIndex.category]
    },
    focusedItem() {
      if (this.focusedIndex.category == null) {
        return {}
      }
      return this.lists[this.focusedCategory][this.focusedIndex.item]
    }
  },
  created () {
    this.fetch()
  },
  methods: {
      async fetch () {
        const response = await axios.get('/api/search-sugestions', { params: { search: this.search.toLowerCase() } })
        this.lists = _.omitBy(response.data, _.isEmpty)
        this.focusedIndex = {
            'category': null,
            'item': null
        }
      },
      onChange() {
        this.showSearchItems=true
        this.fetch()
      },
      onItemSelected(item) {
          this.search = item.title
          window.location.href = item.url
          this.showSearchItems = false
      },
      hideMenu(){
          if(this.showSearchItems == true){
              this.showSearchItems = false
              this.focusedIndex = {
                  'category': null,
                  'item': null
              }
          }
      },
      isActive(categoryIndex, itemIndex) {
        return (this.focusedIndex.category == categoryIndex && this.focusedIndex.item == itemIndex)
      },
      onPrevItemFocused() {
        if (this.focusedIndex.item > 0) {
          this.focusedIndex.item--
        } else if (this.focusedIndex.category > 0) {
          this.focusedIndex.category--
          this.focusedIndex.item = this.lists[this.focusedCategory].length - 1
        }
      },
      onNextItemFocused() {
        if (this.focusedIndex.category == null) {
          this.focusedIndex.item = 0
          this.focusedIndex.category = 0
        } else if (this.focusedIndex.item < (this.lists[this.focusedCategory].length - 1)) {
          this.focusedIndex.item++
        } else if (this.focusedIndex.category < (Object.keys(this.lists).length - 1)) {
          this.focusedIndex.item = 0
          this.focusedIndex.category++
        }
      },
      onFocusedItemSelected(event) {
        if (!_.isEmpty(this.focusedItem)) {
          event.preventDefault()
          this.onItemSelected(this.focusedItem)
        }
      }
  }
};

</script>