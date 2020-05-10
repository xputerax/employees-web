<template>
  <div class="container">
    <div class="row">

      <div v-if="loading">Loading...</div>

      <div v-if="error">Error: {{ error }}</div>
      
      <div v-if="departments" class="col-md-12">
        <h2>Departments</h2>

        <ol>
          <li v-for="department in departments" :key="department.dept_no">
            <router-link :to="{ name: 'single-department', params: { id: department.dept_no }}">
              {{ department.dept_name }}
            </router-link>
          </li>
        </ol>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  watch: {
    // call again the method if the route changes
    '$route': 'fetchData'
  },

  data () {
    return {
      loading: false,
      error: null,
      departments: null,
      department_count: 0
    }
  },

  methods: {
    async getDepartments () {
      let response = await fetch('http://localhost:8000/api/departments')
      let data = await response.json()

      this.departments = data.data
      this.department_count = data.data_count
    }
  },

  created () {
    this.getDepartments()
  }
}
</script>