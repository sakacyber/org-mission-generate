<template>
  <div class="container">
    <h1>Persons List</h1>

    <input v-model="searchQuery" type="text" class="form-control mb-3" placeholder="Search persons by name" />

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="person in filteredPersons" :key="person.id">
          <td>{{ person.name }}</td>
          <td>{{ person.role }}</td>
          <td>{{ person.department.name }}</td>
          <td>
            <button @click="editPerson(person.id)" class="btn btn-info btn-sm">Edit</button>
            <button @click="deletePerson(person.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      persons: [],
      searchQuery: ''
    };
  },
  computed: {
    filteredPersons() {
      return this.persons.filter(person => person.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
    }
  },
  methods: {
    fetchPersons() {
      axios.get('/persons').then(response => {
        this.persons = response.data;
      });
    },
    editPerson(id) {
      window.location.href = `/persons/${id}/edit`;
    },
    deletePerson(id) {
      if (confirm('Are you sure you want to delete this person?')) {
        axios.delete(`/persons/${id}`).then(() => {
          this.fetchPersons();
        });
      }
    }
  },
  mounted() {
    this.fetchPersons();
  }
};
</script>
