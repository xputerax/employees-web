<template>
  <div class="container">
    <span v-if="loading">Loading...</span>

    <div v-if="employee && !loading" class="row">
      <div class="col-md-12">
        <h2>{{ `${employee.first_name} ${employee.last_name}` }}</h2>
        <span>Birth date: {{ employee.birth_date }}</span> <br>
        <span>Is manager: {{ is_manager }}</span>
      </div>
    </div>

    <div v-if="is_manager" class="row">
      <div class="col-md-12">
       <h3>Managed Departments</h3>
        <ol>
          <li v-for="dept in managed_departments" :key="dept.dept_no">
            <router-link :to="{ name: 'single-department', params: { id: dept.dept_no }}">
              {{ dept.dept_name }}
            </router-link>
          </li>
        </ol>
      </div>
    </div>

    <div v-if="salaries" class="row">
      <div class="col-md-6">
        <h3>Salaries</h3>

        <table class="table table-bordered table-condensed" id="salaries">
          <thead>
            <th>From Date</th>
            <th>To Date</th>
            <th>Amount ($)</th>
          </thead>

          <tbody>
            <tr v-for="salary in salaries" :key="salary.salary">
              <td>{{ salary.from_date }}</td>
              <td>{{ salary.to_date }}</td>
              <td>{{ salary.salary }}</td>
            </tr>
            <tr>
              <td colspan="2">Average</td>
              <td>{{ avg_salary }}</td>
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

<style>
/* table#salaries {
  text-align: center;
  width: 50%;
  border: 1px solid #000000;
}

table#salaries thead th {
  border-bottom: 1px solid #000000;
}

table#salaries tbody tr td {
  border-bottom: 1px solid #000000;
} */
</style>