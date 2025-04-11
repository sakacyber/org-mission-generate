<template>
  <form @submit.prevent="submit">
    <input v-model="form.goal" placeholder="Mission Goal" />
    <input type="date" v-model="form.mission_date" />
    <input type="date" v-model="form.ceo_signature_date" />

    <label>Assign People:</label>
    <div v-for="person in people" :key="person.id">
      <input type="checkbox" :value="person.id" v-model="form.person_ids" />
      {{ person.name }} ({{ person.department.name }})
    </div>

    <button type="submit">Save</button>
  </form>
</template>

<script>
export default {
  props: ['people'],
  data() {
    return {
      form: {
        goal: '',
        mission_date: '',
        ceo_signature_date: '',
        person_ids: []
      }
    }
  },
  methods: {
    submit() {
      axios.post('/missions', this.form).then(res => alert('Saved!'))
    }
  }
}
</script>