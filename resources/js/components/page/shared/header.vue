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
                <a class="nav-link" @click="isPActive = true;">Productos</a>
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

    <!-- Products menu -->
    <div class="t-250 products-menu" v-bind:class="{ active: isPActive }">
      <div class="menu-bg" @click="isPActive = false"></div>

      <div class="tablist" role="tablist">
        <div class="t-250 box-title" @click="isPActive = false">
          <h4>PRODUCTOS</h4>
          <br>
          <h5>Categorias</h5>
          <i class="fas fa-chevron-left icon"></i>
        </div>

        <b-card no-body class="mb-1" v-for="(category, pcatIndex) in categories" :key="pcatIndex">
          <b-card-header header-tag="header" role="tab">
            <div v-if="category.subcategories.length" class="btn-toggle">
              <router-link :to="'/productos/'+$root._converToURL(category.name, category.id)">{{ category.name }}</router-link>
              <span class="fake-toggle" v-b-toggle="'accordion-'+pcatIndex"></span>
            </div>
            <router-link v-else class="btn-toggle-fake" :to="'/productos/'+$root._converToURL(category.name, category.id)">{{ category.name }}</router-link>
          </b-card-header>

          <b-collapse v-if="category.subcategories.length" :id="'accordion-'+pcatIndex"  accordion="my-accordion" role="tabpanel">
            <b-card-body>
              <ul class="ul-sub-options">
                <li v-for="subcategory in category.subcategories">
                  <router-link class="t-250" :to="'/productos/'+$root._converToURL(subcategory.name, subcategory.id)">{{ subcategory.name }}</router-link>
                </li>
              </ul>
            </b-card-body>
          </b-collapse>
        </b-card>
      </div>
    </div>
    <!--  -->

  </header>
</template>

<script>
export default {
  data() {
    return {
      isPActive: false,
      categories:[
        { id: 182, name: 'Para mujer', subcategories: [] },
        { id: 182, name: 'Para hombre', subcategories: [] },
        { id: 1, name: 'Ópticos',
          subcategories: []
          //   { id: 2, name: 'Subcategoría aquí' },
          //   { id: 3, name: 'Subcategoría aquí' },
          //   { id: 4, name: 'Subcategoría aquí' },
          // ]
        },
        { id: 10, name: 'De Sol',
          subcategories: []
          //   { id: 5, name: 'Subcategoría aquí' },
          //   { id: 8, name: 'Subcategoría aquí' },
          //   { id: 9, name: 'Subcategoría aquí' },
          // ]
        },
        { id: 182, name: 'De moda', subcategories: [] },
        { id: 182, name: 'De aumento', subcategories: [] },
        { id: 182, name: 'Cuadrados', subcategories: [] },
        { id: 182, name: 'Monofocales', subcategories: [] },
        { id: 182, name: 'Redondo', subcategories: [] },
      ],
    }
  },

  watch: {
    $route (to, from){
      // Ocultar menu cada vez que cambie la ruta
      this.isPActive = false;
    }
  }
}
</script>
