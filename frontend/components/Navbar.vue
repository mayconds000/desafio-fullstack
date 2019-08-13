<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <nuxt-link to="/" class="navbar-brand">Frontend</nuxt-link>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" v-if="authenticated">
        <a class="nav-link" @click.prevent="logout">Logout</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  methods: {
    logout () {
      this.$auth.logout()
    }
  }
}
</script>

