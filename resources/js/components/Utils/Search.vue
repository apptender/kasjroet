<template>
    <label for="search">
        <input
                id="search"
                class="w-full py-2 px-1"
                type="text"
                name=":searchTitle"
                v-model="searchFilter"
                :placeholder="searchPlaceholder"
                autocomplete="off"
                v-on:keydown="filteredDataset"
        />
    </label>
</template>

<script>
  export default {
    props: {
      searchDataset: {
        required: true
      },
      searchPlaceholder: {
        type: String,
        required: false,
        default: ''
      },
      searchName: {
        type: String,
        required: false,
        default: 'search'
      }
    },
    data() {
      return {
        searchFilter: '',
      }
    },
    methods: {
      filteredDataset() {
        this.$emit('searchValue', this.searchFilter);
      }
    },
    computed: {},
    watch: {}

  }
</script>
