<template>
  <div class="container">
    <h1>Manage Persons</h1>

    <!-- Search bar -->
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

    <!-- Modal for Editing Person -->
    <div v-if="showEditModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Person</h5>
            <button type="button" class="close" @click="closeEditModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updatePerson">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" v-model="editPersonData.name" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" v-model="editPersonData.role" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="department_id">Department</label>
                <select v-model="editPersonData.department_id" id="department_id" class="form-control" required>
                  <option v-for="department in departments" :key="department.id" :value="department.id">
                    {{ department.name }}
                  </option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Update Person</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      persons: [],
      departments: [],
      searchQuery: '',
      showEditModal: false,
      editPersonData: {
        id: null,
        name: '',
        role: '',
        department_id: null
      }
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
    fetchDepartments() {
      axios.get('/departments').then(response => {
        this.departments = response.data;
      });
    },
    editPerson(id) {
      axios.get(`/persons/${id}/edit`).then(response => {
        this.editPersonData = response.data;
        this.showEditModal = true;
      });
    },
    closeEditModal() {
      this.showEditModal = false;
    },
    updatePerson() {
      axios.put(`/persons/${this.editPersonData.id}`, this.editPersonData)
        .then(() => {
          this.fetchPersons();
          this.showEditModal = false;
        });
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
    this.fetchDepartments();
  }
};
</script>

<style scoped>
/* Add any custom styles here */
</style>
