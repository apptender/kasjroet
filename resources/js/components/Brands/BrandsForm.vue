<template>
    <div>
        <header-component>
            <template slot="title">Nieuw merk</template>
        </header-component>
        <form ref="form" class="flex flex-col" @submit.prevent="createBrand">
            <div class="flex flex-row justify-between">
                <label for="name" class="">Naam</label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="text" id="name"
                       v-model="brand.brandname">
            </div>
            <div class="flex flex-row justify-between">
                <label for="name" class="">Merk code</label>
                <input class="w-1/2 py-2 border-2 rounded-lg px-2 " type="text" id="name"
                       v-model="brand.brandcode">
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
        brand: {},
        success: false,
        isUpdate: false
      }
    },
    methods: {
      createBrand: function(){
        if (this.isUpdate){
          axios.put(`${apiUrl}brands/${this.brand.id}`, this.brand)
            .then(response => {
              this.$router.push({name: 'brands'})
            })
        } else {
          axios.post(`${apiUrl}brands`, this.brand)
            .then(response => { this.$router.push({name: brands})})
        }
      }
    },
    created() {
      if (this.$route.params.id) {
        axios.get(`${apiUrl}brands/${this.$route.params.id}/edit`)
          .then(response => {
            this.brand = response.data;
            this.isUpdate = true;
          })
      }
    }
  }
</script>
