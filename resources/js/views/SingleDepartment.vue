<template>
  <div>

    <div v-if="loading">Loading...</div>

    <div v-if="error">Error: {{ error }}</div>

    <div v-if="department && !loading && !error">
      <h2>Department: {{ department.dept_name }}</h2>
      <span>Number of employees: {{ num_employees }}</span> <br>
      <span>Number of managers: {{ num_managers }}</span>

      <h3>Managers</h3>

      <ol>
        <li v-for="manager in managers" :key="manager.emp_no">
          <router-link :to="{ name: 'single-employee', params: { id: manager.emp_no }}">
            {{ manager.first_name }} {{ manager.last_name }}
          </router-link>
        </li>
      </ol>
    </div>

  </div>
</template>

<script>
export default {
  props: ['id'],

  data () {
    return {
      loading: false,
      error: null,
      department: null,
      num_managers: 0,
      managers: null,
      num_employees: 0
    }
  },

  methods: {
    async getDepartmentInfo() {

      this.loading = true

      try {

        let response = await fetch('http://localhost:8000/api/departments/' + this.id)
        let data = await response.json()

        this.department = data.department
        this.num_managers = data.managers.data_count
        this.managers = data.managers.data
        this.num_employees = data.num_employees

      } catch (error) {
        this.error = error
      }

      this.loading = false
    }
  },

  created () {
    this.getDepartmentInfo()
  }
}
</script>