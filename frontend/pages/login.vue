<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 offset-md-3 offset-lg-4">
        <form @submit.prevent="submit()">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" v-model.trim="form.email" autofocus>
            <small class="form-text text-danger" v-if="errors.email">{{ errors.email && errors.email[0] }}</small>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model.trim="form.password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  middleware: ['guest'],
  data () {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    submit () {
      this.$auth.loginWith('local', {
        data: this.form
      }).then(res => {
        this.$router.push('/')
      })
    }
  },
}
</script>