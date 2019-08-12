<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h3>Lista de Usuários</h3>
      <button class="btn btn-primary" @click="set({})">
        <font-awesome-icon :icon="['fas', 'plus']"/> Add Usuário
      </button>
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
              <button class="btn btn-sm btn-outline-secondary" @click.prevent="set(user)">
                <font-awesome-icon :icon="['fas', 'edit']"/>
              </button>
              <button class="btn btn-sm btn-outline-secondary" @click.prevent="remove(user)">
                <font-awesome-icon :icon="['fas', 'trash']"/>
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="row my-4">
        <div class="col-md-8">
          <nav>
            <ul class="pagination">
              <li class="page-item" :class="{disabled: ! pagination.first_link}" >
                <a href="#" class="page-link" @click="getUsers(pagination.first_link)">&laquo;</a>
              </li>
              <li class="page-item" :class="{disabled: ! pagination.prev_link}" >
                <a href="#" class="page-link" @click="getUsers(pagination.prev_link)">&lt;</a>
              </li>
              <li v-for="n in pagination.last_page" :key="n" :class="{active: pagination.current_page == n}" class="page-item">
                <a href="#" class="page-link" @click="getUsers(pagination.path_page + n)">{{n}}</a>
              </li>
              <li  class="page-item" :class="{disabled: !pagination.next_link}">
                <a href="#" class="page-link" @click="getUsers(pagination.next_link)">&gt;</a>
              </li>
              <li  class="page-item" :class="{disabled: !pagination.last_link}">
                <a href="#" class="page-link" @click="getUsers(pagination.last_link)">&raquo;</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-md-4">
          Total: {{ pagination.total_page}}
        </div>
      </div>
      <h4 v-if="!users">Nenhum usuário cadastrado</h4>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: mapGetters({
    users: 'user/list',
    pagination: 'user/pagination'
  }), 
  methods: {
    getUsers (page) {
      this.$emit('getUsers', page)
    },
    set (user) {
      this.$store.commit('user/SET', user)
    },
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
    }
  }
}
</script>
