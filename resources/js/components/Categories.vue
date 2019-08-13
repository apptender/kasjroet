<template>
    <div>
        <header-component>
            <router-view></router-view>
            <template slot="title">Categori&euml;n</template>
            <template slot="button">
                <router-link :to="{path: '/categories/new'}">
                    <div class="rounded-full px-6 py-4 bg-blue-400 text-white hover:bg-blue-700 font-bold cursor-pointer text-sm">
                        + Nieuwe categorie
                    </div>
                </router-link>
            </template>
        </header-component>
        <div class="my-4">
            <label>
                <input type="text" name="search" v-model="search" placeholder="zoek een categorie"
                       class="w-full py-4 border-2 rounded-lg px-2">
            </label>
        </div>
        <ul>
            <li class="flex py-2" v-for="category in categories">
                <span class="flex-auto w-1/3">{{category.name}}</span>
                <span class="flex-auto w-1/3">{{category.categorycode}}</span>
                <router-link :to="{name: 'edit-category', params: {id: category.id}}">
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
        categories:[],
        search: ''
      }
    },
    created() {
      axios.get('http://kasjroet.test/api/categories')
        .then(response => {
          this.categories = response.data
        })
    }
  }
</script>

<style scoped>

</style>
