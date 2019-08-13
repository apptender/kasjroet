<template>
    <div>
        <header-component>
            <template slot="title">Nieuwe categorie</template>
        </header-component>
        <form ref="form" class="flex flex-col" @submit.prevent="createCategory">
            <div class="flex flex-row justify-between">
                <label for="name" class="">Naam</label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="text" id="name"
                       v-model="category.name">
            </div>
            <div class="flex flex-row justify-between">
                <label for="categorycode">
                    Cateogrie code
                </label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="test" id="categorycode"
                       v-model="category.categorycode">
            </div>
            <div class="flex flex-row justify-between">
                <label for="description">
                    Omschrijving
                </label>
                <textarea class="w-1/2 py-2 border-2 rounded-lg " name="description" id="description"
                          v-model="category.description" cols="30" rows="10"></textarea>
            </div>
            <div class="flex flex-row justify-between">
                <input type="submit" value="Verzenden">
            </div>
        </form>
    </div>

</template>

<script>
  export default {
    data(){
      return {
        errors: '',
        category: {},
        success: false,
        isUpdate: false,
      }
    },
    methods: {
      createCategory: function() {
        if (this.isUpdate) {
          axios.put(`${apiUrl}categories/${this.category.id}`, this.category)
            .then(response => {
              this.$router.push({name: 'categories'})
            })
        }
        else {
          axios.post(`${apiUrl}categories`, this.category)
            .then(response =>{
              this.$router.push({name: 'categories'})
            })
        }
      }
    },
    created() {
      if (this.$route.params.id) {
        axios.get(`${apiUrl}categories/${this.$route.params.id}/edit`)
          .then(response => {
            this.category = response.data;
            this.isUpdate = true;
          });

      }
    }

  }
</script>

