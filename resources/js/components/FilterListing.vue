<template>
  <section>
    <slot name="before-list" />
    <div class="md:flex flex-wrap">
      <radio-button
        v-for="option in options"
        :key="option.key"
        v-model="selectedOption"
        :option="option"
        class="mr-12 py-2"
      />
    </div>
    <transition
      name="items-list"
      mode="out-in"
    >
      <div
        :key="fetchedOption"
        class="md:flex gap-10 mt-5"
      >
        <template v-if="items.length > 0">
          <div
            v-for="(item, index) in items"
            :key="index"
            class="lg:w-1/3"
          >
            <slot
              name="list-item"
              :item="item"
            />
          </div>
        </template>
        <slot
          v-else-if="fetchedOption"
          name="empty-list"
        />
      </div>
    </transition>
    <slot name="after-list" />
  </section>
</template>

<script>
import RadioButton from './atoms/RadioButton'

export default {
  components: {
    RadioButton
  },
  props: {
    options: {
      type: Array,
      required: true
    },
    value: {
      type: Object,
      required: true
    },
    fetchedOption: {
      type: String,
      default: null
    },
    items: {
      type: Array,
      required: true
    }
  },
  computed: {
    selectedOption: {
      get () {
        return this.value
      },
      set (val) {
        this.$emit('input', val)
      }
    }
  }
}
</script>

<style>
.items-list-leave-active {
    @apply transition duration-200 ease-in;
}

.items-list-enter-active {
    @apply transition duration-300 ease-out;
}

.items-list-leave-to {
    @apply opacity-0 transform -translate-x-8
}

.items-list-enter {
    @apply opacity-0 transform translate-x-8
}
</style>
