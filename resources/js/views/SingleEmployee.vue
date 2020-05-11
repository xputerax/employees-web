<template>
  <div class="container">
    <div v-if="loading">Loading...</div>

    <div v-if="employee" class="row">
      <div class="col-md-12">
        <h2>{{ `${employee.first_name} ${employee.last_name}` }}</h2>
        <span>Birth date: {{ employee.birth_date }}</span> <br>
        <span>Is manager: {{ is_manager }}</span>
      </div>
    </div>

    <div v-if="departments" class="row">
      <div class="col-md-6">
        <h3>Departments</h3>

        <table class="table table-bordered table-sm" id="departments">
          <thead>
            <th class="col-md-4">From Date</th>
            <th class="col-md-4">To Date</th>
            <th class="col-md-4">Department Name</th>
          </thead>

          <tbody>
            <tr v-for="dept in departments" :key="dept.dept_no">
              <td>{{ dept.pivot.from_date }}</td>
              <td>{{ dept.pivot.to_date }}</td>
              <td>
                <router-link :to="{ name: 'single-department', params: { id: dept.dept_no } }">{{ dept.dept_name }}</router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div v-if="managed_departments" class="row">
      <div class="col-md-6">
       <h3>Managed Departments</h3>

        <table class="table table-bordered table-sm" id="managed_departments">
          <thead>
            <th class="col-md-4">From Date</th>
            <th class="col-md-4">To Date</th>
            <th class="col-md-4">Department Name</th>
          </thead>

          <tbody>
          <template v-if="managed_departments.length">
            <tr v-for="dept in managed_departments" :key="dept.dept_no">
              <td>{{ dept.pivot.from_date }}</td>
              <td>{{ dept.pivot.to_date }}</td>
              <td>
                <router-link :to="{ name: 'single-department', params: { id: dept.dept_no } }">{{ dept.dept_name }}</router-link>
              </td>
            </tr>
          </template>

          <template v-else>
            <tr>
              <td colspan="3">No data</td>
            </tr>
          </template>
          </tbody>
        </table>
      </div>
    </div>

    <div v-if="salaries" class="row">
      <div class="col-md-6">
        <h3>Salaries</h3>

        <table class="table table-bordered table-sm" id="salaries">
          <thead>
            <th>From Date</th>
            <th>To Date</th>
            <th>Amount ($)</th>
          </thead>

          <tbody>
            <tr v-for="salary in salaries" :key="salary.salary">
              <td>{{ salary.from_date }}</td>
              <td>{{ salary.to_date }}</td>
              <td class="col-md-2 text-right">{{ salary.salary }}</td>
            </tr>
            <tr>
              <td></td>
              <td class="text-center">Average</td>
              <td class="text-right">{{ avg_salary }}</td>
            </tr>
          </tbody>
        </table>
      </div>
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
      employee: null,
      is_manager: null,
      departments: null,
      managed_departments: null,
      salaries: null,
      num_salaries: null,
      avg_salary: 0
    }
  },

  created () {
    this.getEmployeeInfo()
  },

  methods: {
    async getEmployeeInfo() {

      this.loading = true

      try {

        let response = await fetch('http://localhost:8000/api/employees/' + this.id)
        let data = await response.json()

        this.employee = data.employee
        this.is_manager = data.is_manager
        this.departments = data.departments
        this.managed_departments = data.managed_departments

        let salariesResponse = await fetch('http://localhost:8000/api/employees/' + this.id + '/salaries')
        let salariesData = await salariesResponse.json()

        this.salaries = salariesData.salaries.data
        this.num_salaries = salariesData.salaries.data_count

      } catch(error) {
        this.error = error
      }

      this.loading = false

      this.salaries.forEach(salary => {
        this.avg_salary += salary.salary
      })

      this.avg_salary /= this.num_salaries
      this.avg_salary = this.avg_salary.toFixed(2)

    }
  }
}
</script>
