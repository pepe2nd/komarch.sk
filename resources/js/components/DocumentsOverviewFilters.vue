<template>
  <div class="flex items-start">
    <div class="mr-12">
      <h3 class="mb-5">
        Typ dokumentu:
      </h3>
      <input-checkbox
        v-for="option in optionsType"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-2"
        @input="onInput"
      />
    </div>
    <div class="mr-12">
      <h3 class="mb-5">
        Téma:
      </h3>
      <input-checkbox
        v-for="option in optionsTopic"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-2"
        @input="onInput"
      />
    </div>
    <div class="mr-12">
      <h3 class="mb-5">
        Rola:
      </h3>
      <input-checkbox
        v-for="option in optionsRole"
        :key="option.key"
        :value="value"
        :option="option"
        class="mr-12 py-2"
        @input="onInput"
      />
    </div>
    <ButtonClearFilters
      v-show="value.length > 0"
      @click="onCancel"
    />
  </div>
</template>

<script>
import InputCheckbox from './atoms/InputCheckbox'
import ButtonClearFilters from './atoms/ButtonClearFilters'

export default {
  components: {
    InputCheckbox,
    ButtonClearFilters
  },
  props: {
    value: {
      type: Array,
      required: true
    },
    optionsType: {
      type: Array,
      default: () => [
        { key: 'laws', title: 'Zákony', items: 5, params: '' },
        { key: 'edicts', title: 'Vyhlášky', items: 3, params: '' },
        { key: 'norms', title: 'Normy', items: 1, params: '' },
        { key: 'contracts', title: 'Zmluvy', items: 15, params: '' },
        { key: 'forms', title: 'Tlačivá', items: 7, params: '' }
      ]
    },
    optionsTopic: {
      type: Array,
      default: () => [
        { key: 'author law', title: 'Autorský zákon', items: 3, params: '' },
        { key: 'construction law', title: 'Stavebný zákon', items: 4, params: '' },
        { key: 'procurement', title: 'Verejné obstarávanie', items: 1, params: '' },
        { key: 'monument protection', title: 'Pamiatková ochrana', items: 3, params: '' },
        { key: 'tenders', title: 'Súťaže', items: 2, params: '' }
      ]
    },
    optionsRole: {
      type: Array,
      default: () => [
        { key: 'authorized member', title: 'Autorizovaný člen', items: 7, params: '' },
        { key: 'self-government', title: 'Samospráva', items: 20, params: '' },
        { key: 'announcer', title: 'Vyhlasovateľ', items: 3, params: '' }
      ]
    }
  },
  methods: {
    onCancel () {
      this.$emit('input', [])
    },
    onInput (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
