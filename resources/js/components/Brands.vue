<template>
    <div>
        <header-component>
            <template slot="title">Merken</template>
            <template slot="button">
                <router-link :to="{name: 'newBrand'}">
                    <div class="rounded-full px-6 py-4 bg-blue-400 text-white hover:bg-blue-700 font-bold cursor-pointer text-sm">
                        + Nieuw merk
                    </div>
                </router-link>
            </template>
        </header-component>
        <div class="my-4">
            <ul>
                <li class="flex py-2" v-for="brand in brands">
                    <span class="flex-auto w-2/3">{{brand.brandname}}</span>
                    <router-link :to="{name: 'editBrand', params: {id: brand.id}}">
                        <p>Bewerken</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        brands: [],
      }
    },
    methods: {

    },
    created() {
      axios.get(`${apiUrl}brands`)
        .then(response => {
          this.brands = response.data
        })
    }
  }
</script>
