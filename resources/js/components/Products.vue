<template>
    <div>
        <header-component>
            <router-view></router-view>
            <template slot="title">Producten</template>
            <template slot="button">
                <router-link :to="{name: 'new-product'}">
                    <div class="rounded-full px-6 py-4 bg-blue-400 text-white hover:bg-blue-700 font-bold cursor-pointer text-sm">
                        + Nieuw Product
                    </div>
                </router-link>
            </template>
        </header-component>
        <div class="my-4">
            <search
                    :search-dataset="productsFiltered"
                    search-placeholder=""
                    search-name=""
                    v-on:searchValue="filterValue = $event"
            >

            </search>
            <div class="flex w-full py-1 border px-2 my-2" v-for="product in productsFiltered">
                <div class="flex flex-col w-3/4">
                    <div class="flex-auto w-full text-sm">{{product.brand.brandname}}</div>
                    <div class="flex-auto w-full text-lg">{{product.productname}}</div>
                </div>
                <div class="flex flex-col w-1/4">
                    <div v-if="product.kosher !== 1"
                         class="block bg-red-500 text-center text-white font-bold w-20 text-2xl self-end px-2">
                        NEE
                    </div>
                    <div v-if="product.kosher === 1"
                         class="block bg-green-500 text-center text-white font-bold uppercase text-2xl self-end px-2">
                        {{product.koshertype}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        products: [],
        filterValue: ''
      }
    },
    created() {
      axios.get(`${apiUrl}products`)
        .then(response => {
          this.products = response.data
        })
    },
    computed: {
      productsFiltered() {
        if (this.filterValue.length < 1){
          return [];
        };
        const filtered = [];
        const regOption = new RegExp(this.filterValue, 'ig');
        for (const product of this.products) {
          if (this.filterValue.length < 1 || product.productname.match(regOption)) {
            filtered.push(product);
          }
        }
        return filtered;
      }
    }
  }

</script>
