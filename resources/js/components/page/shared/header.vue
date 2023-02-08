<template lang="html">
  <header id="header">
    <div class="header-content">
      <b-navbar toggleable="lg" type="light" variant="light">
        <div class="container oversized-container">
          <b-navbar-brand to="/">
            <img src="public/images/logo.svg" alt="Necesito lentes">
          </b-navbar-brand>

          <b-navbar-toggle target="nav-collapse" class="t-150">
            <i class="far fa-bars"></i>
          </b-navbar-toggle>

          <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="ml-auto">
              <b-nav-item class="simple-item" to="/empresa">Nosotros</b-nav-item>
              <li class="nav-item simple-item">
                <a class="nav-link">Productos</a>
              </li>
              <b-nav-item class="simple-item" to="/contacto">Contacto</b-nav-item>

              <b-nav-item-dropdown class="simple-item dropdown-account" right>
                <template #button-content>
                  <span><i class="far fa-user-circle"></i> Mi cuenta</span>
                </template>
                <b-dropdown-item to="/login">Iniciar sesión</b-dropdown-item>
                <b-dropdown-item to="/registrarse">Registrarse</b-dropdown-item>
              </b-nav-item-dropdown>

              <b-nav-item class="simple-item cart" to="/cart">
                <span class="icon"><i class="fas fa-shopping-cart"></i><i class="num">0</i></span>
                <span class="d-lg-none ml-2">Mi carrito</span>
              </b-nav-item>

              <li class="nav-item networks-item">
                <div class="nav-link">
                  <a class="btn-network"><img src="public/images/shared/app-store.svg" /></a>
                  <a class="btn-network"><img src="public/images/shared/google-play.svg" /></a>
                </div>
              </li>
            </b-navbar-nav>
          </b-collapse>
        </div>
      </b-navbar>
    </div>

  </header>
</template>

<script>
export default {
  data() {
    return {
    }
  },

  watch: {
  }
}
</script>
