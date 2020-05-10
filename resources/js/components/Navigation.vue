<template>
  <div>
    <ul>
      <li>
        <router-link :to="{ name: 'home' }">Home</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'about' }">About</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

}
</script>