<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
      <!--<HelloWorld msg="You did it!" />-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <RouterLink to="/showProducts" class="nav-link" aria-current="page" href="#">Productos</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink to="/createProduct" class="nav-link" href="#">Crear Producto</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink to="/editProduct" class="nav-link" href="#">Editar Producto</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <RouterView />
  </div>

  
</template>
