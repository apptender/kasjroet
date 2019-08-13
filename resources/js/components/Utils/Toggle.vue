<template>

        <span class="inline-block relative pointer h-8 w-16 rounded-full"
              role="checkbox"
              :aria-checked="value.toString()"
              @click="toggle"
        >
                <span class="inline-block rounded-full h-full w-full shadow-inner"
                    :style="backgroundStyles"
                >
                </span>
                <span class="absolute h-6 w-6 bg-white rounded-full top-25 left-25 transition-slow shadow"
                    :style="indicatorStyles"
                >
                </span>
        </span>
</template>

<script>
  export default {
    props: ['value'],
    data() {
      return {
        checked: true
      }
    },
    methods: {
      toggle: function () {
        this.$emit('toggle', !this.value);
      }
    },
    created() {
      console.log('value',this.value);
    },
    computed: {
      backgroundStyles() {
        return {
          backgroundColor : this.value ? '#3490dc' : '#dae1e7'
        }
      },
      indicatorStyles() {
        return {
            transform : this.value ? 'translateX(2rem)' : 'translateX(0)'
        }
      },
    }
  }
</script>
