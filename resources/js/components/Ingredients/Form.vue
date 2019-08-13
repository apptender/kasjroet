<template>
    <div>
        <header-component>
            <template slot="title">Nieuw Ingredi&euml;nt</template>
        </header-component>

        <transition name="success" mode="in-out">
            <message v-if="success">
                <p>Ingredient opgeslagen</p>
            </message>
        </transition>

        <form ref="form" class="flex flex-col" @submit.prevent="createIngredient">
            <div class="py-4" v-if="errors">
                <b class="py-4">Het is niet gelukt om een ingredient aan te maken:</b>
                <ul>
                    <li v-for="(value,key,error) in validationErrors">{{value}}</li>
                </ul>
            </div>

            <div class="flex flex-row justify-between">
                <label for="name" class="">Naam</label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="text" id="name" v-model="ingredient.name">
            </div>

            <div class="flex flex-row justify-between">
                <label for="ingredientcode">
                    Ingredi&euml;ntcode
                </label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="text" id="ingredientcode"
                       v-model="ingredient.ingredientcode">
            </div>

            <div class="flex flex-row justify-between">
                <label for="description">
                    Omschrijving
                </label>
                <textarea class="w-1/2 py-2 border-2 rounded-lg " name="description" id="description"
                          v-model="ingredient.description" cols="30" rows="10"></textarea>
            </div>

            <div class="flex flex-row justify-between">
                <label for="kosher">Kosher</label>
                <input type="checkbox" name="kosher" id="kosher" v-model="ingredient.kosher">
            </div>

            <div class="flex flex-row justify-between">
                <label for="koshertype">Parve</label>
                <select name="koshertype" id="koshertype" v-model="ingredient.koshertype">
                    <option value="">Select a kosher type</option>
                    <option value="melkkost">Melkkost</option>
                    <option value="chalav jisroel">Chalav Jisroel</option>
                    <option value="vleeksost">Vleeskost</option>
                    <option value="parve">Parve</option>
                </select>

            </div>
            <div class="flex flex-row justify-between">
                <input type="submit" value="Verzenden">
            </div>
        </form>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        errors: '',
        ingredient: {},
        success: false,
        koshertypes: {},
        success: false,
        isUpdate: false,

      }
    },
    methods: {
      createIngredient: function () {
        if (this.isUpdate) {
          axios.put(`http://kasjroet.test/api/ingredients/${this.ingredient.id}`, this.ingredient)
            .then(response => {
              this.$router.push({name: 'ingredients'})
            });
        } else {
          axios.post('http://kasjroet.test/api/ingredients', this.ingredient)
            .then(response => {
              // this.success = true;
              this.$router.push({name: 'ingredients'})
            })
            .catch(error => {
              if (error.response.status === 422) {
                this.errors = error.response.data.errors;
              }

            })
        }
      }

    },
    async created() {
      if (this.$route.params.id) {
        await axios.get(`http://kasjroet.test/api/ingredients/${this.$route.params.id}/edit`).then(response => {
          this.ingredient = response.data;
          this.isUpdate = true;
        });
        await axios. get(`${apiUrl}/enums/kosherTypes`)
          .then(response => {
            this.koshertypes = response.data
          })
      }
    },
    computed: {
      validationErrors() {
        let errors = Object.values(this.errors);
        return errors.flat();
      }
    },
  }
</script>
