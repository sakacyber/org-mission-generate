<template>
  <div class="container">
    <h1>Edit Person</h1>

    <form @submit.prevent="updatePerson">
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
      <button type="submit" class="btn btn-primary">Update Person</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      person: {
        id: null,
        name: '',
        role: '',
        department_id: null
      },
      departments: []
    };
  },
  methods: {
    fetchPerson() {
      axios.get(`/persons/${this.$route.params.id}`).then(response => {
        this.person = response.data;
      });
    },
    fetchDepartments() {
      axios.get('/departments').then(response => {
        this.departments = response.data;
      });
    },
    updatePerson() {
      axios.put(`/persons/${this.person.id}`, this.person).then(() => {
        this.$router.push('/persons');
      });
    }
  },
  mounted() {
    this.fetchPerson();
    this.fetchDepartments();
  }
};
</script>
