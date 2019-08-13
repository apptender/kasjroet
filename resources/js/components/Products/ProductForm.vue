<template>
    <div>
        <panel>
            <header-component>
                <template slot="title">Nieuw Product</template>
                <template slot="button">
                    <div class="bg-blue-500 text-white rounded-full px-4 py-2"
                         @click="createProduct"
                    >
                        Opslaan
                    </div>

                </template>
            </header-component>
        </panel>

        <panel>
            <form ref="form" class="flex flex-col" @submit.prevent="createProduct">
                <div class="flex flex-row justify-between pt-4">
                    <label for="name" class="">Naam</label>
                    <input class="w-1/2 py-1 border-2 rounded-lg px-2" type="text" id="name"
                           v-model="product.productname">
                </div>
                <div class="flex-row flex pt-4">
                    <span class="flex-1">Merk</span>
                    <dropdown
                            v-on:selected="product.brand = $event.id"
                            class="flex-1"
                            :options="brandOptions"
                            placeholder="Selecteer een merk"
                            name="brand = $event"></dropdown>
                </div>

                <div class="flex-row flex pt-4 ">
                    <span class="flex-1">Category</span>
                    <multiselect :items="categories" :selected="this.product.categories"
                                 @change-items="handleCategorySelect($event)"></multiselect>
                </div>
                <div class="flex flex-row justify-between pt-4">
                    <label for="eancode">Eancode</label>
                    <input class="w-1/2 py-1 border-2 rounded-lg px-2"
                           type="text" id="eancode" v-model="product.eancode">
                </div>
                <div class="flex flex-row justify-between pt-4">
                    <label for="ingredients">Ingredienten</label>
                    <textarea class="w-1/2 py-1 border-2 rounded-lg" name="ingredients" id="ingredients"
                              v-model="ingredients" cols="30" rows="10"></textarea>
                </div>
                <div class="flex flex-row justify-end">
                    <button @click="normalizeIngredients">Normaliseer</button>
                </div>
                <div class="flex flex-row p-4">
                    <span class="flex-1">Kosher</span>
                    <toggle
                            name="kosher"
                            default="false"
                            v-on:toggle="product.kosher = $event"
                            v-model="product.kosher">
                    </toggle>
                </div>
                <div v-if="product.kosher" class="flex flex-row p-4">
                    <label class="flex-1" for="koshertypes">Kosher types</label>
                    <select name="koshertypes" id="koshertypes" v-model="product.kosherType">
                        <option  v-for="(type, index) in kosherTypes"  :key="index" :value="index">{{type | capitalize }}</option>
                    </select>
                </div>
            </form>
        </panel>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        errors: '',
        product: {
          categories: [],
          ingredients: [],
          brand: '',
          eancode: '',
          productname: '',
          kosher: false,
          kosherType:'',

        },
        searchBrand: '',
        filteredBrand: '',
        brands: [],
        categories: {},
        ingredients: '',
        kosherTypes: {},
        success: false,
        isUpdate: false,
        processing: false,

      }
    },
    methods: {
      handleCategorySelect: function (event) {
        if (this.product.categories.includes(event.id)) {
          this.product.categories = this.product.categories.filter(i => i !== event.id);
        } else {
          this.product.categories.push(event.id);
        }
      },
      createProduct() {
        this.processing = true;
        axios.post(`${apiUrl}products`, this.product)
          .then(response => {
            console.log(response);
          })
      },
      normalizeIngredients() {
        if (!this.processing) {
          this.processing = true;
          const blackList = [
            'ingrediënten',
            ':'
          ];
          let ingredients = this.ingredients.toLowerCase();
          blackList.forEach(function (item) {
            ingredients = ingredients.replace(item, '');
            ingredients = ingredients.replace(' ', '');
          });
          ingredients = ingredients.toLowerCase().split([',']);

          axios.post(`${apiUrl}ingredients-collection`, ingredients)
            .then(response => {
              console.log(response.data.saved);
              this.product.ingredients = response.data.saved;
              this.processing = false;
            });
        }
      },
    },
    async created() {
      let self = this;
      await axios.all([
        axios.get(`${apiUrl}brands`),
        axios.get(`${apiUrl}categories`),
        axios.get(`${apiUrl}enums/kosherTypes`)
      ])
        .then(axios.spread(function (brands, categories, kosherTypes) {
          self.brands = brands.data;
          self.categories = categories.data;
          self.kosherTypes = kosherTypes.data
        }));
    },
    computed: {
      brandOptions: function () {
        const brandOptions = [];
        this.brands.forEach(function (brand) {
          brandOptions.push({
            'id': brand.id,
            'name': brand.brandname
          });
        });
        return brandOptions;
      }
    },
  }
</script>
