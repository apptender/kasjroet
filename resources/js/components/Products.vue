<template>
    <div class="container mx-auto">
        <div class="my-4">
            <h1 class="text-4xl font-bold text-gray-900 text-center tracking-widest uppercase">Is het Koosjer?</h1>
            <search
                    search-placeholder="zoek een product of merk"
                    search-name=""
                    v-model="productsFiltered"
            >
            </search>
            <div class="flex w-full py-1 border px-2 py-4 my-2" v-if="notFound">
                <p class="text-center">We konden helaas niks vinden. Probeer iets anders.</p>
            </div>
            <div class="flex w-full py-1 border px-2 my-2" v-for="product in filteredProducts">
                <div class="flex flex-col w-3/4">
                    <div class="flex-auto w-full text-sm">{{product.brandname}}</div>
                    <div class="flex-auto w-full md:text-lg xs:text-sm">{{product.productname}}</div>
                </div>
                <div class="flex flex-col w-1/4">
                    <div v-if="product.kosher !== 1"
                         class="block bg-red-500 text-center text-white font-bold w-20 md:text-2xl xs:text-lg self-end px-1">
                        NEE
                    </div>
                    <div v-if="product.kosher === 1"
                         class="block bg-green-500 text-center text-white font-bold uppercase md:text-2xl xs:text-lg self-end px-1">
                        {{product.koshertype}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {debounce, isEmpty} from 'lodash';
  export default {
    data() {
      return {
        products: [],
        filterValue: '',
        filteredProducts: '',
        notFound: false
      }
    },
    computed: {
      productsFiltered: {
            get(){
                return this.filteredProducts;
            },
            set: _.debounce(function(event){
              if (this.filterValue.length < 1) {
                this.filteredProducts = [];
              }
              setTimeout(() => {
                this.notFound = false;
                axios.get(`${apiUrl}search/` + event)
                  .then(response => {
                    this.products = response.data.products;
                    if (Array.isArray(this.products) && _.isEmpty(this.products)) {
                        this.notFound = true;
                    }
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
      }
    },
  }

</script>
