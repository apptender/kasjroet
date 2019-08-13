<template>
    <div class="w-1/2">
        <ul class="flex flex-col flex-1" v-for="item in items">
            <li class="flex-1 flex-col border hover:bg-blue-500 cursor-pointer py-1 text-center"
                v-bind:class="{'bg-blue-500': selected.includes(item.id)}"
                v-on:click="handleClick(item)"
            >
                {{item.name}}
            </li>
        </ul>
    </div>
</template>

<script>
  export default {
    props: ['items', 'selected'],
    methods: {
      handleClick: function(item){
        this.$emit('change-items', item);
      }
    }
  }
</script>
