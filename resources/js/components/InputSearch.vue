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
              @input="showSearchItems = true"
              ref="searchBox"
          />
      </div>
      <aside class="absolute z-10 flex flex-col items-start w-64 bg-white border rounded-md shadow-md mt-1"
             role="menu" aria-labelledby="menu-heading" v-if="filteredList.length > 0 && showSearchItems == true">
          <ul class="flex flex-col w-full">
              <li
                  class="px-2 py-3 space-x-2 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white focus:outline-none "
                  v-for="(item, index) in filteredList"
                  :key="index"
                  @click="selectSearchItem(item); showSearchItems = false;">{{ item.name }}</li>
          </ul>
      </aside>
  </div>
</template>


<script>

export default {
  props: {
      // lists: {
      //   type: Array,
      //   default: []
      // },
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
        lists: [
            {
              id: 17,
              name: "Nová plaváreň, rekonštrukcia hokejového štadióna a dostavba nekomerčných ubytovacích kapacít pre športovcov",
            },
            {
              id: 16,
              name: "Plaváreň pod Borinou",
            },
            {
              id: 15,
              name: "Kultúrny dom Malacky",
            }
          ],
          search: "",
          selectedItem: "",
          showSearchItems: false,
          isMouseOverList: false,
          searchItemList: [] // this.list
      };
  },
  created () {
    // this.searchItemList = this.lists
  },
  computed: {
      filteredList() {
        this.searchItemList = this.lists
        return this.searchItemList.filter((item) => {
            return (item.name.toLowerCase().includes(this.search.toLowerCase()));
        });
      },
      classProps() {
        return [...this.inputClass]
      }
  },
  methods: {
      selectSearchItem(item) {
          this.search = item.name;
          this.selectedItem = item.name;
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
  },
  created() {
      if(this.selectedData != 0){
          const selected = this.lists.filter((item) => {
              if(item.id == this.selectedData){
                  return true
              }
              return false
          })
          this.selectedItem = selected[0].name
          this.search = selected[0].name
      }
  },
};

</script>