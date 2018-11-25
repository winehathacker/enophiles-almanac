<template>
    <div>
        <v-select :options="countries"
                  v-model="country"
                  label="name">
        </v-select>
        <input type="hidden" :name="name" v-model="countryId"/>
    </div>
</template>

<script>
  import vSelect from 'vue-select';
  export default {
    props: {
      'name': String,
      'countries': Array,
      'selected': Array,
    },
    data() {
      return {
        country: this.selected,
      }
    },
    computed: {
      countryId: {
        get() {
          if (this.country) {
            return this.country.id;
          }

          return null;
        }
      }
    },
    components: {vSelect},
    name: 'AliasSelection'
  }
</script>

<style scoped>

</style>
