<template>
  <div class="container col-md-6 mt-5">
    <h2>Login</h2>
    <br>
    <form>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
        <small class="form-text text-danger"></small>
      </div>
      <div class="form-group">
        <label>Senha</label>
        <input type="password" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <br>
    <p>Ainda não tem uma conta? <nuxt-link to="/register">Registre-se</nuxt-link></p>
  </div>
</template>
