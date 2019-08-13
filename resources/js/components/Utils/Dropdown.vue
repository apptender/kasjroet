<template>
    <div class="relative">
        <input
                class="py-1 border-2 rounded-lg px-2 w-full"
                type="text"
                @focus="showOptions()"
                @blur="exit()"
                @keyup="keyMonitor"
                v-model="searchFilter"
                :placeholder="placeholder"
                autocomplete="off"
                autocorrect="off"
                autocapitalize="none"
                spellcheck="false"
        />
        <!--        Dropdown content-->
        <div class="absolute min-w-full min-h-full overflow-auto z-10 border bg-white shadow-md"
            v-show="optionsShown"
        >
            <div class="font-black text-sm leading-normal p-2 block cursor-pointer  hover:bg-blue-100"
                 @mousedown="selectOption(option)"
                 v-for="(option, index ) in filteredOptions" :key="index">
                {{option.name}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      props: {
        options: {
          type: Array,
          required: true,
          default: [],
        },
        name: {
          type: String,
          required: false,
          default: 'dropdown'
        },
        maxItem: {
          type: Number,
          required: false,
          default: 5,
        },
        placeholder: {
          type: String,
          required: false,
          default: "Selecteer een optie",
        },
        disabled: {
          type: Boolean,
          required: false,
          default: false,
          note: 'Disable the dropdown'
        }
      },
      data(){
        return {
          selected: '',
          searchFilter: '',
          optionsShown: false,
        }
      },
      created() {
        this.$emit('selected', this.selected);
      },
      methods: {
        showOptions() {
            if(!this.disabled) {
              this.searchFilter = '';
              this.optionsShown = true;
            }
        },
        exit() {
          if(!this.disabled) {
            this.optionsShown = false;
          }
        },
        selectOption: function(option) {
          this.selected = option;
          this.searchFilter = this.selected.name;
          this.optionsShown = false;
          this.$emit('selected', option);
        },
        keyMonitor: function(event) {
          if(event.key === "Enter" && this.filteredOptions[0]) {
            this.selectOption((this.filteredOptions[0]))
          }
        }
      },
      computed: {
        filteredOptions() {
          const filtered = [];
          const regOption = new RegExp(this.searchFilter, 'ig');
          for (const option of this.options) {
            if (this.searchFilter.length < 1 || option.name.match(regOption)){
              if (filtered.length < this.maxItem) filtered.push(option);
            }
          }
          return filtered;
        }
      },
      watch: {
        searchFilter() {
          if (this.filteredOptions.length === 0) {
            this.selected = {};
          } else {
            this.selected = this.filteredOptions[0];
          }
          this.$emit('filter', this.searchFilter);
        }
      }
    }
</script>
