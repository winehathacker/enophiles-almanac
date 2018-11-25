<template>
    <div>
        <v-select multiple :options="regions"
                  v-model="selection"
                  label="name">
        </v-select>
        <input type="hidden" :name="name" v-model="regionIds"/>
    </div>
</template>

<script>
  import vSelect from 'vue-select';
  export default {
    props: {
      'name': String,
      'regions': Array,
      'selected': Array,
    },
    data() {
      return {
        selection: this.selected,
      }
    },
    computed: {
      regionIds: {
        get() {
          if (this.selection) {
            return this.selection.map(r => r.id);
          }

          return [];
        }
      }
    },
    components: {vSelect},
    name: 'AliasSelection'
  }
</script>

<style scoped>

</style>
