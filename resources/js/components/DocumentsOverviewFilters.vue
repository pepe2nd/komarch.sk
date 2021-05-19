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
        { key: 'laws', title: 'Zákony', params: '' },
        { key: 'edicts', title: 'Vyhlášky', params: '' },
        { key: 'norms', title: 'Normy', params: '' },
        { key: 'contracts', title: 'Zmluvy', params: '' },
        { key: 'forms', title: 'Tlačivá', params: '' }
      ]
    },
    optionsTopic: {
      type: Array,
      default: () => [
        { key: 'author law', title: 'Autorský zákon', params: '' },
        { key: 'construction law', title: 'Stavebný zákon', params: '' },
        { key: 'procurement', title: 'Verejné obstarávanie', params: '' },
        { key: 'monument protection', title: 'Pamiatková ochrana', params: '' },
        { key: 'tenders', title: 'Súťaže', params: '' }
      ]
    },
    optionsRole: {
      type: Array,
      default: () => [
        { key: 'authorized member', title: 'Autorizovaný člen', params: '' },
        { key: 'self-government', title: 'Samospráva', params: '' },
        { key: 'announcer', title: 'Vyhlasovateľ', params: '' }
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
