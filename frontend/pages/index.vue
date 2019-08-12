<template>
  <div class="container">
    <List v-if="user == null" @getUsers="getUsers" />
    <Form v-else />
  </div>
</template>

<script>
import List from '@/components/List'
import Form from '@/components/Form'

export default {
  mounted () {
    this.getUsers()
  },
  computed: {
    user () {
      return this.$store.state.user.user
    }
  },
  methods: {
    getUsers (page) {
      page = page || `users`
      this.$axios.$get(page).then(res => {
        console.log(res)
        this.$store.commit('user/SET_LIST', res.data)
        this.$store.commit('user/SET_PAGINATION', {
          current_page: res.meta.current_page,
          last_page: res.meta.last_page,
          from_page: res.meta.from,
          to_page: res.meta.to,
          total_page: res.meta.total,
          path_page: res.meta.path + '?page=',
          first_link: res.links.first,
          last_link: res.links.last,
          prev_link: res.links.prev,
          next_link: res.links.next,
        })
      })
    }
  },
  components: {
    List,
    Form
  }
}
</script>