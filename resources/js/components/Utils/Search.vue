<template>
    <div class="container mx-auto">
        <label for="search">
            <input
                    id="search"
                    class="w-full p-2 border-gray-900 border font-bold"
                    type="text"
                    name=":searchTitle"
                    :placeholder="searchPlaceholder"
                    autocomplete="off"
                    @input="filteredDataset"
                    v-model="filterValue"
            />
        </label>
    </div>

</template>
<script>
  export default {
    props: {
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
    data(){
      return {
        filterValue: ''
      }
    },
    methods: {
      filteredDataset(searchFilter) {
        this.$emit('input', this.filterValue);
      }
    },
    computed: {},
    watch: {}

  }
</script>
