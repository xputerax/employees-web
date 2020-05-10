<template>
  <div class="container">
    <h2>Home</h2>

    <div v-if="loading" class="loading">
      Loading...
    </div>

    <div v-if="error" class="error">
      {{ error }}
    </div>
    
    <ol>
      <li v-for="employee in employees" v-bind:key="employee.emp_no">
        <router-link :to="{ name: 'single-employee', params: { id: employee.emp_no }}">
          {{ `${employee.first_name} ${employee.last_name}` }}
        </router-link>
      </li>
    </ol>
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
      employees: null,
      employees_count: null,
      error: null,
    }
  },

  methods: {
    async fetchData () {
      this.loading = true

      try {
        
        let res = await fetch('http://localhost:8000/api/employees')
        let data = await res.json()

        this.employees = data.data
        this.employees_count = data.data_count

      } catch(error) {

        this.error = error

      }

      this.loading = false
    }
  },

  created () {
    this.fetchData()
  }
}
</script>
