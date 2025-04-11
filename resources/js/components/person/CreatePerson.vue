<template>
  <div class="container">
    <h1>Create Person</h1>

    <form @submit.prevent="createPerson">
      <div class="form-group">
        <label for="name">Name</label>
        <input v-model="person.name" type="text" id="name" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="role">Role</label>
        <input v-model="person.role" type="text" id="role" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="department_id">Department</label>
        <select v-model="person.department_id" id="department_id" class="form-control" required>
          <option v-for="department in departments" :key="department.id" :value="department.id">
            {{ department.name }}
          </option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Create Person</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      person: {
        name: '',
        role: '',
        department_id: null
      },
      departments: []
    };
  },
  methods: {
    fetchDepartments() {
      axios.get('/departments').then(response => {
        this.departments = response.data;
      });
    },
    createPerson() {
      axios.post('/persons', this.person).then(() => {
        this.$router.push('/persons');
      });
    }
  },
  mounted() {
    this.fetchDepartments();
  }
};
</script>
