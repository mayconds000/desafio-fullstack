<template>
  <div class="container">
    <List v-if="user == null" />
    <Form v-else />
  </div>
</template>

<script>
import List from '@/components/List'
import Form from '@/components/Form'

export default {
  mounted () {
    this.$axios.$get(`users`).then(response => {
      this.$store.commit('user/SET_LIST', response.data)
    })
  },
  computed: {
    user () {
      return this.$store.state.user.user
    }
  },
  components: {
    List,
    Form
  }
}
</script>