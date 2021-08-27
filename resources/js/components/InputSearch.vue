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
              ref="searchBox"
          />
      </div>
      <aside class="absolute z-10 flex flex-col items-start w-64 bg-white border rounded-md shadow-md mt-1"
             role="menu" aria-labelledby="menu-heading" v-if="contests.length > 0 && showSearchItems == true">
          <ul class="flex flex-col w-full">
              <li
                  class="px-2 py-3 space-x-2 hover:bg-blue hover:text-white focus:bg-blue focus:text-white focus:outline-none "
                  v-for="(item, index) in contests"
                  :key="index"
                  @click="selectSearchItem(item); showSearchItems = false;">{{ item.title }}</li>
          </ul>
      </aside>
  </div>
</template>


<script>

export default {
  props: {
      clearInputWhenClicked: {
        type: Boolean,
        default: false
      },
      placeholder: {
        type: String,
        default: 'Search here...'
      }
  },
  data() {
      return {
          search: "",
          selectedItem: "",
          showSearchItems: false,
          contests: []
      };
  },
  created () {
    this.fetch()
  },
  methods: {
      async fetch () {
        const response = await axios.get('/api/contests', { params: { q: this.search.toLowerCase() } })
        this.contests = response.data.data
      },
      onChange() {
        this.showSearchItems=true
        this.fetch()
      },
      selectSearchItem(item) {
          this.search = item.title;
          window.location.href = item.url;
          // this.selectedItem = item.name;
          this.showSearchItems = false;
          this.$emit('selected', item)
          if(this.clearInputWhenClicked){
              this.search = ''
          }
      },
      hideMenu(){
          if(this.showSearchItems == true){
              this.showSearchItems = false
          }
      }
  }
};

</script>