<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h3>Lista de Usuários</h3>
      <nuxt-link to="/register">
        <button  class="btn btn-primary">
          +Add Usuário
        </button>
      </nuxt-link>
    </div>
    <div class="card-body">
      <table class="table table-sm table-hover" v-if="users">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.phone}}</td>
            <td>
              <button class="btn btn-sm btn-outline-secondary" @click.prevent="edit(user)">
                <font-awesome-icon :icon="['fas', 'edit']"/>
              </button>
              <button class="btn btn-sm btn-outline-secondary" @click.prevent="remove(user)">
                <font-awesome-icon :icon="['fas', 'trash']"/>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <h4 v-else>Nenhum usuário cadastrado</h4>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    users () {
      return this.$store.state.user.list
    }
  },
  methods: {
    remove (user) {
      this.$swal({
        title: 'Tem certeza que deseja deletar este usuário?',
        text: 'Este processo é irreversível',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Deletar',
        cancelButtonText: 'Cancelar'
      }).then(() => {
        this.$axios.delete(`users/${user.id}`).then((response) => {
          this.$store.commit('user/REMOVE', user.id)
          this.$swal({
            title: 'Usuário removido com sucesso',
            type: 'success'
          })
        }).catch(response => {
          this.$swal({
            title: 'Houve uma falha e não foi possível deletar o usuário',
            type: 'error'
          })
        })
      })
    },
    edit (user) {
      console.log('edit', user)
      this.$store.commit('user/SET', user)
    }
  }
}
</script>
