<template>
  <div class="container mt-5">
    <h1>Mission Dashboard</h1>
    
    <input 
      v-model="search" 
      @input="fetchMissions" 
      class="form-control" 
      placeholder="Search by goal or assigned person..." 
    />
    
    <h1>THis is H1</h1>
    
    <table class="table mt-3">
      <thead>
        <tr>
          <th @click="sortBy('goal')">Goal</th>
          <th @click="sortBy('mission_date')">Mission Date</th>
          <th>Assigned People</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mission in filteredMissions" :key="mission.id">
          <td>{{ mission.goal }}</td>
          <td>{{ mission.mission_date }}</td>
          <td>
            <span v-for="(person, index) in mission.people" :key="person.id">
              {{ person.name }} ({{ person.department.name }}) 
              <span v-if="index < mission.people.length - 1">, </span>
            </span>
          </td>
          <td>
            <a :href="`/missions/${mission.id}/generate-docx`" target="_blank" class="btn btn-info btn-sm">DOCX</a>
            <a :href="`/missions/${mission.id}/generate-pdf`" target="_blank" class="btn btn-danger btn-sm">PDF</a>
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
      missions: [],
      search: '',
      sortKey: 'goal',
      sortAsc: true
    };
  },
  computed: {
    filteredMissions() {
      let filtered = this.missions.filter(m => 
        m.goal.includes(this.search) || 
        m.people.some(p => p.name.includes(this.search))
      );
      
      return filtered.sort((a, b) => {
        if (this.sortAsc) {
          return a[this.sortKey] > b[this.sortKey] ? 1 : -1;
        } else {
          return a[this.sortKey] < b[this.sortKey] ? 1 : -1;
        }
      });
    }
  },
  methods: {
    fetchMissions() {
      axios.get('/missions', { params: { search: this.search } })
        .then(res => this.missions = res.data.data);
    },
    sortBy(key) {
      this.sortKey = key;
      this.sortAsc = !this.sortAsc;
    }
  },
  mounted() {
    console.log('MissionDashboard Component Mounted');
    this.fetchMissions();
  }
};
</script>

<style scoped>
th {
  cursor: pointer;
}
</style>
