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
                    search-placeholder=""
                    search-name=""
                    v-model="productsFiltered"
            >

            </search>
            <div class="flex w-full py-1 border px-2 my-2" v-for="product in filteredProducts">
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
import {debounce} from 'lodash';
  export default {
    data() {
      return {
        products: [],
        filterValue: '',
        filteredProducts: ''
      }
    },
    computed: {
      productsFiltered: {
            get(){
              console.log('getter called');
                return this.filteredProducts;
            },
            set: _.debounce(function(event){
              console.log('setter called');
              if (this.filterValue.length < 1) {
                this.filteredProducts = [];
              }

                console.log(`${apiUrl}search/` + event);
              setTimeout(() => {
                axios.get(`${apiUrl}search/` + event)
                  .then(response => {
                    console.log(response);
                    this.products = response.data.products;
                    const filtered = [];
                    const regOption = new RegExp(this.filterValue, 'ig');
                    for (const product of this.products) {
                      if (this.filterValue.length < 1 || product.productname.match(regOption)) {
                        filtered.push(product);
                      }
                    }
                    this.filteredProducts = filtered;
                  });

              }, 200);



            }, 500)
        // if (this.filterValue.length < 1) {
        //   return [];
        // }
        // console.log('computed');
        // axios.get(`${apiUrl}search/` + this.filterValue)
        //   .then(response => {
        //     this.products = response.data.products;
        //   });
        //
        // const filtered = [];
        // const regOption = new RegExp(this.filterValue, 'ig');
        // for (const product of this.products) {
        //   if (this.filterValue.length < 1 || product.productname.match(regOption)) {
        //     filtered.push(product);
        //   }
        // }
        // return filtered;

      }
    },
    methods: {
      getProducts: function(){
        console.log('computed1');

      }
    }
  }

</script>
