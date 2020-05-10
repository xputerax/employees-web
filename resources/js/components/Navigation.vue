<template>
  <div class="container">

    <nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-expand-md">
      <router-link :to="{ name: 'home' }" class="navbar-brand">Employees API</router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarNav" aria-controls="navbar_nav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar_nav">
        <ul class="nav navbar-nav">
          <li class="nav-item">
            <router-link :to="{ name: 'about' }" class="nav-link">About</router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{ name: 'departments' }" class="nav-link">Departments</router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{ name: 'statistics' }" class="nav-link">Statistics</router-link>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {

}
</script>