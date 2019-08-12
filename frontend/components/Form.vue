<template>
  <div class="container col-md-6 col-lg-5 mt-5">
    <h2>{{ isEdit ? 'Editar' : 'Cadastrar' }}</h2>
    <br>
    <form class="row mb-5" @submit.prevent="submit">
      <div class="form-group col-12">
        <label>Nome</label>
        <input type="text" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.name.$error }"
          v-model.trim="$v.form.name.$model" 
          autofocus />
        <small class="form-text text-danger" v-if="errors.name">{{ errors.name && errors.name[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.name.$dirty && !$v.form.name.required">O campo nome é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.name.$dirty && !$v.form.name.minLength">O campo nome deve conter no mínimo {{$v.form.name.$params.minLength.min}} caracters.</small>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label>Data de nascimento</label>
            <the-mask mask="##/##/####" :masked="true"
              v-model="$v.form.birth_date.$model" 
              class="form-control"
              :class="{'is-invalid' : $v.form.birth_date.$error }"
            />
            <small class="form-text text-danger" v-if="errors.birth_date">{{ errors.birth_date && errors.birth_date[0] }}</small>
            <small class="form-text text-danger" v-if="$v.form.birth_date.$dirty && !$v.form.birth_date.required">O campo data de nascimento é obrigatório</small>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="form-group col-md-6">
            <label>Celular</label>
            <the-mask 
              :mask="['(##) ####-####', '(##) #####-####']" :masked="true"
              v-model="$v.form.phone.$model" 
              class="form-control" 
              :class="{'is-invalid' : $v.form.phone.$error }"
            />
            <small class="form-text text-danger" v-if="errors.phone">{{ errors.phone && errors.phone[0] }}</small>
            <small class="form-text text-danger" v-if="$v.form.phone.$dirty && !$v.form.phone.required">O campo celular é obrigatório</small>
            <small class="form-text text-danger" v-if="$v.form.phone.$dirty && !$v.form.phone.minLength">O campo celualr deve conter no mínimo {{$v.form.phone.$params.minLength.min}} caracters.</small>
          </div>
        </div>
      </div>

      <div class="form-group col-12 mt-5">
        <label>Nome da mãe</label>
        <input type="cel" 
          class="form-control" 
          v-model="form.mother_name"
        />
        <small class="form-text text-danger" v-if="errors.mother_name">{{ errors.mother_name && errors.mother_name[0] }}</small>
      </div>
      <div class="form-group col-12">
        <label>Nome do pai</label>
        <input type="cel" 
          class="form-control" 
          v-model="form.father_name"
        />
        <small class="form-text text-danger" v-if="errors.father_name">{{ errors.father_name && errors.father_name[0] }}</small>
      </div>

      <br>
      <div class="form-group col-md-6 mt-5">
        <label>Cep</label>
        <the-mask 
          mask="#####-###" :masked="true"
          v-model="$v.form.cep.$model" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.cep.$error }"
        />
          
        <small class="form-text text-danger" v-if="errors.cep">{{ errors.cep && errors.cep[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.cep.$dirty && !$v.form.cep.required">O campo cep é obrigatório</small>
      </div>
      <div class="form-group col-12">
        <label>Rua</label>
        <input type="text" 
          class="form-control" 
          v-model="$v.form.street.$model"
          :class="{'is-invalid' : $v.form.street.$error }"
        />
        <small class="form-text text-danger" v-if="errors.street">{{ errors.street && errors.street[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.street.$dirty && !$v.form.street.required">O campo rua é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.street.$dirty && !$v.form.street.maxLength">O campo rua deve conter no máximo {{$v.form.street.$params.maxLength.max}} caracters.</small>
      </div>
      <div class="form-group col-md-6">
        <label>Número</label>
        <input type="cel" 
          class="form-control" 
          v-model="$v.form.number.$model"
          :class="{'is-invalid' : $v.form.number.$error }"
        />
        <small class="form-text text-danger" v-if="errors.number">{{ errors.number && errors.number[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.number.$dirty && !$v.form.number.required">O campo numero é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.number.$dirty && !$v.form.number.maxLength">O campo numero deve conter no máximo {{$v.form.number.$params.maxLength.max}} caracters.</small>
      </div>
      <div class="form-group col-md-6">
        <label>Complemento</label>
        <input type="text" 
          class="form-control" 
          v-model="form.complement"
        />
        <small class="form-text text-danger" v-if="errors.complement">{{ errors.complement && errors.complement[0] }}</small>
      </div>
      <div class="form-group col-12">
        <label>Bairro</label>
        <input type="text" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.neighborhood.$error }"
          v-model="$v.form.neighborhood.$model"
          >
        <small class="form-text text-danger" v-if="errors.neighborhood">{{ errors.neighborhood && errors.neighborhood[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.neighborhood.$dirty && !$v.form.neighborhood.required">O campo bairro é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.neighborhood.$dirty && !$v.form.neighborhood.maxLength">O campo bairro deve conter no máximo {{$v.form.neighborhood.$params.maxLength.max}} caracters.</small>
      </div>
      <div class="form-group col-md-6">
        <label>Cidade</label>
        <input type="text" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.city.$error }"
          v-model="$v.form.city.$model"
        />
        <small class="form-text text-danger" v-if="errors.city">{{ errors.city && errors.city[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.city.$dirty && !$v.form.city.required">O campo cidade é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.city.$dirty && !$v.form.city.maxLength">O campo cidade deve conter no máximo {{$v.form.city.$params.maxLength.max}} caracters.</small>
      </div>
      <div class="form-group col-md-6">
        <label>Estado</label>
        <input type="text" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.state.$error }"
          v-model="$v.form.state.$model"
        />
        <small class="form-text text-danger" v-if="errors.state">{{ errors.state && errors.state[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.state.$dirty && !$v.form.state.required">O campo estado é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.state.$dirty && !$v.form.state.maxLength">O campo estado deve conter no máximo {{$v.form.state.$params.maxLength.max}} caracters.</small>
      </div>

      <div class="form-group col-12 mt-5">
        <label>Email</label>
        <input type="email" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.email.$error }"
          v-model="$v.form.email.$model"
          :disabled="form.id != null && form.id !== undefined"
        />
        <small class="form-text text-danger" v-if="errors.email">{{ errors.email && errors.email[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.email.$dirty && !$v.form.email.required">O campo email é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.email.$dirty && !$v.form.email.email">O email informado deve ser um email válido</small>
      </div>
      <div class="form-group col-12">
        <label>Senha</label>
        <input type="password" 
          class="form-control" 
          :class="{'is-invalid' : $v.form.password.$error }"
          v-model="$v.form.password.$model">
        <small class="form-text text-danger" v-if="errors.password">{{ errors.password && errors.password[0] }}</small>
        <small class="form-text text-danger" v-if="$v.form.password.$dirty && !$v.form.password.required">O campo senha é obrigatório</small>
        <small class="form-text text-danger" v-if="$v.form.password.$dirty && !$v.form.password.minLength">O campo senha deve conter no mínimo {{$v.form.password.$params.minLength.min}} caracteres</small>
        <small class="form-text text-danger" v-if="$v.form.password.$dirty && !$v.form.password.maxLength">O campo senha deve conter no maxímo {{$v.form.password.$params.maxLength.max}} caracteres</small>
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
import {TheMask} from 'vue-the-mask'
import { required, minLength, maxLength, email } from "vuelidate/lib/validators";

export default {
  data () {
    return {
      loader: false,
      isEdit: false,
      user: null,
      form: {
        name: null,
        email: null,
        phone: null,
        birth_date: null,
        password: null,
        father_name: null,
        mother_name: null,
        cep: null,
        street: null,
        number: null,
        complement: null,
        neighborhood: null,
        city: null,
        state: null
      }
    }
  },
  mounted () {
    const user = this.$store.state.user.user
    this.user = user

    if (Object.keys(user).length === 0 && user.constructor === Object) {
      this.isEdit = false
      return 
    }

    this.form = { ...this.form, ...user, ...user.address }
    this.isEdit = true
  },
  methods: {
    submit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        return 
      }
      this.loader = true
      if (this.isEdit) {
        this.$axios.$put(`users/${this.user.id}`, this.form) .then(response => {
          this.loader = false
          // const user = {
          //   ...this.user,
          //   address: {
          //     cep: this.form.cep,
          //     street: this.form.street,
          //     number: this.form.number,
          //     complement: this.form.complement,
          //     neighborhood: this.form.neighborhood,
          //     city: this.form.city,
          //     state: this.form.state
          //   }
          // }
          this.$store.commit('user/UPDATE', response.data)
          this.$swal({
            title: 'Usuário alterado com sucesso',
            type: 'success',
            button: 'Ok'
          }).then(() => {
            this.$store.commit('user/CLEAR')
          })
        }).catch(response => {
          this.loader = false
          const title = typeof response === 'string' ? response : 'Não foi possível atualizar o anúncio'
          this.$swal({
            title,
            type: 'error',
            button: 'Ok'
          })
        })
        return 
      }

      this.$axios.$post('users', this.form).then(response => {
        this.loader = false
        this.$store.commit('user/ADD', response.data)
        this.$swal({
          title: 'Usuário cadastrado com sucesso',
          type: 'success',
          button: 'Ok'
        }).then(() => {
          this.$store.commit('user/CLEAR')
        })
      })
    }
  },
  validations: {
    form: {
        name: {
          required,
          minLength: minLength(3)
        },
        email: {
          required,
          email
        },
        phone: {
          required,
          minLength: minLength(14),
        },
        birth_date: {
          required,
        },
        password: {
          required,
          minLength: minLength(6),
          maxLength: maxLength(20)
        },
        cep: {
          required,
          minLength: minLength(9)
        },
        street: {
          required,
          maxLength: maxLength(60)
        },
        number: {
          required,
          maxLength: maxLength(11)
        },
        neighborhood: {
          required,
          maxLength: maxLength(40)
        },
        city: {
          required,
          maxLength: maxLength(40)
        },
        state: {
          required,
          maxLength: maxLength(20)
        }
      }
  },
  components: {
    TheMask
  }
}
</script>

