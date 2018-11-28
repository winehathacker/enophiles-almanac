<template>
    <div>
        <v-select :options="varieties"
                  v-model="alias"
                  label="name">
        </v-select>
        <input type="hidden" :name="name" v-model="varietyId"/>
    </div>
</template>

<script>
  import vSelect from 'vue-select';
  export default {
    props: {
      'varieties': Array,
      'selected': Object,
      'name': String,
    },
    data() {
      return {
        alias: this.selected,
      }
    },
    computed: {
      varietyId: {
        get() {
          if (this.alias) {
            return this.alias.id
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
