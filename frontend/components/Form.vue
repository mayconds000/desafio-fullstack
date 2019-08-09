<template>
  <div class="container col-md-6 col-lg-5 mt-5">
    <h2>{{pageTitle}}</h2>
    <br>
    <form class="row mb-5" @submit.prevent="submit">
      <div class="form-group col-12">
        <label>Nome</label>
        <input type="text" class="form-control" v-model="form.name" autofocus>
        <small class="form-text text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label>Data de nascimento</label>
            <input type="text" class="form-control" v-model="form.birth_date">
            <small class="form-text text-danger" v-if="errors.birth_date">{{ errors.birth_date[0] }}</small>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label>Celular</label>
            <input type="cel" class="form-control" v-model="form.phone">
            <small class="form-text text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
          </div>
        </div>
      </div>

      <div class="form-group col-12 mt-5">
        <label>Nome da mãe</label>
        <input type="cel" class="form-control" v-model="form.mother_name">
        <small class="form-text text-danger" v-if="errors.mother_name">{{ errors.mother_name[0] }}</small>
      </div>
      <div class="form-group col-12">
        <label>Nome do pai</label>
        <input type="cel" class="form-control" v-model="form.father_name">
        <small class="form-text text-danger" v-if="errors.father_name">{{ errors.father_name[0] }}</small>
      </div>

      <br>
      <div class="form-group col-md-6 mt-5">
        <label>Cep</label>
        <input type="text" class="form-control" v-model="form.address.cep">
        <small class="form-text text-danger" v-if="errors.address && errors.address.cep">{{ errors.address.cep[0] }}</small>
      </div>
      <div class="form-group col-12">
        <label>Rua</label>
        <input type="text" class="form-control" v-model="form.address.street">
        <small class="form-text text-danger" v-if="errors.address && errors.address.street">{{ errors.address.street[0] }}</small>
      </div>
      <div class="form-group col-md-6">
        <label>Número</label>
        <input type="text" class="form-control" v-model="form.address.number">
        <small class="form-text text-danger" v-if="errors.address && errors.address.number">{{ errors.address.number[0] }}</small>
      </div>
      <div class="form-group col-md-6">
        <label>Complemento</label>
        <input type="text" class="form-control" v-model="form.address.complement">
        <small class="form-text text-danger" v-if="errors.address && errors.address.complement">{{ errors.address.complement[0] }}</small>
      </div>
      <div class="form-group col-12">
        <label>Bairro</label>
        <input type="text" class="form-control" v-model="form.address.neighborhood">
        <small class="form-text text-danger" v-if="errors.address && errors.address.neighborhood">{{ errors.address.neighborhood[0] }}</small>
      </div>
      <div class="form-group col-md-6">
        <label>Cidade</label>
        <input type="text" class="form-control" v-model="form.address.city">
        <small class="form-text text-danger" v-if="errors.address && errors.address.city">{{ errors.address.city[0] }}</small>
      </div>
      <div class="form-group col-md-6">
        <label>Estado</label>
        <input type="text" class="form-control" v-model="form.address.state">
        <small class="form-text text-danger" v-if="errors.address && errors.address.state">{{ errors.address.state[0] }}</small>
      </div>

      <div class="form-group col-12 mt-5">
        <label>Email</label>
        <input type="email" class="form-control" v-model="form.email">
      </div>
      <div class="form-group col-12">
        <label>Senha</label>
        <input type="password" class="form-control" v-model="form.password">
      </div>

      <br>

      <div class="col-12">
        <button class="btn btn-primary">
          <template v-if="loader">
            <div class="spinner-border text-light" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </template>
          <template v-else>{{ isEdit ? 'Editar' : 'Cadastrar' }}</template>
        </button>
      </div>

    </form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      pageTitle: 'Cadastrar',
      loader: false,
      isEdit: false,
      form: {
        name: '',
        email: '',
        phone: '',
        password: '',
        father_name: '',
        mother_name: '',
        address: {
          cep: '',
          street: '',
          number: '',
          complement: '',
          neighborhood: '',
          city: '',
          state: ''
        }
      }
    }
  },
  methods: {
    submit () {
      this.loader = true

      if (this.isEdit) {
        this.$axios.$post(`update/${this.user.id}`, this.form) .then(response => {

          this.loader = false
          // show message
          this.$router.push('/')
        }).catch(response => {
          
          this.loader = false
          // show message
        })
        return 
      }

      this.$axios.$post('register', this.form) .then(response => {

      }).catch(response => {

      })
    }
  },
}
</script>

