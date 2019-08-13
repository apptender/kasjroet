<template>
    <div>
        <header-component>
            <template slot="title">Ingredi&euml;nten</template>
            <template slot="button">
                <router-link :to="{name: 'new-ingredient'}">
                    <div class="rounded-full px-6 py-4 bg-blue-400 text-white hover:bg-blue-700 font-bold cursor-pointer text-sm">
                        + Nieuw ingredient
                    </div>
                </router-link>
            </template>
        </header-component>
        <div class="my-4">
            <label>
                <input type="text" name="search" v-model="search" autocomplete="off" placeholder="Zoek een ingredient"
                       class="w-full py-4 border-2 rounded-lg px-2">
            </label>
        </div>
        <ul>
            <li class="flex py-2" v-for="ingredient in filteredIngredients">
                <span class="flex-auto w-2/3">{{ingredient.name}}</span>
                <span v-if="ingredient.kosher" class="block bg-green-500 text-center text-white font-bold w-20">
               JA
            </span>
                <span v-else class="block bg-red-500 text-center text-white font-bold w-20">
               NEE
            </span>
                <span class="ml-3 flex-auto w-1/3">{{ingredient.koshertype}}</span>
                <router-link :to="{name: 'edit-ingredient', params: {id: ingredient.id}}">
                    <p>Bewerken</p>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        ingredients: [],
        search: ''
      }
    },
    methods: {
      add: function (e) {
        this.$router.push({name: 'new-ingredient'})
      }
    },
    created() {
      axios.get(`${apiUrl}ingredients`)
        .then(response => {
        this.ingredients = response.data;
      });
    },
    computed: {
      filteredIngredients: function () {
        return this.ingredients.filter((ingredient) => {
          if (this.search === '') return true;
          return new RegExp(this.search, 'i').test(ingredient.name);

        });
      }
    }

  }

</script>
