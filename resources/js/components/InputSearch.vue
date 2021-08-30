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
              @keydown="nextItem"
              ref="searchBox"
          />
      </div>
      <aside class="absolute z-10 flex flex-col items-start w-72 md:w-96 bg-white border rounded-md shadow-sm mt-1"
             role="menu" aria-labelledby="menu-heading" v-if="Object.keys(this.lists).length > 0 && showSearchItems == true">
          <div v-for="(items, category) in lists" v-if="items.length > 0" class="w-full">
            <h5 class="tracking-tight mt-3 mb-1 text-gray-500 px-2">{{ __('search.' + category) }}</h5>
            <ul class="flex flex-col w-full">
                <li
                    class="px-2 py-1 space-x-2 hover:bg-blue hover:text-white focus:bg-blue focus:text-white focus:outline-none"
                    :class="{ 'bg-blue text-white': isActive(category, index) }"
                    v-for="(item, index) in items"
                    @click="onItemSelected(item); showSearchItems = false;">{{ item.title }}</li>
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
          listsLength: 0,
          focusedIndex: 0
      };
  },
  created () {
    this.fetch()
  },
  methods: {
      async fetch () {
        const response = await axios.get('/api/search-sugestions', { params: { search: this.search.toLowerCase() } })
        this.lists = response.data
        this.focusedIndex = 0
        var listsLength = 0
        _.forEach(this.lists, function(items, key) {
          listsLength += items.length
        });
        this.listsLength = listsLength
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
          }
      },
      nextItem: function(event) {
        if (event.keyCode == 38 && this.focusedIndex > 0) {
          this.focusedIndex--
        } else if (event.keyCode == 40 && this.focusedIndex < this.listsLength) {
          this.focusedIndex++
        } else if (event.keyCode == 13 && this.focusedIndex > 0) {
          event.preventDefault()
          this.onItemSelected(this.getFocusedItem())
        }
      },
      getFocusedItem() {
        var self = this
        var iterator = 0
        var focusedItem = null
        _.forEach(this.lists, function(items, category) {
          items.forEach(function(item, index) {
            iterator++
            if (iterator == self.focusedIndex) {
              focusedItem = item
              return
            }
          })
        })
        return focusedItem
      },
      isActive(thisCategory, thisIndex) {
        var self = this
        var iterator = 0
        var isActive = false
        _.forEach(this.lists, function(items, category) {
          items.forEach(function(item, index) {
            iterator++
            if ((thisCategory == category) && (thisIndex == index)) {
              if (iterator == self.focusedIndex) {
                isActive = true
                return
              }
            }
          })
        })
        return isActive
      }
  }
};

</script>