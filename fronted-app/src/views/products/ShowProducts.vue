<template>
    Acá se mostrarán los productos
    <table class="table caption-top">
  <caption>List of products</caption>
  <thead class="table-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">stock</th>
      <th scope="col">Accions</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="prod, i in products" :key="prod.id">
      <td>{{ (i+1) }}</td>
      <td>{{ prod.description }}</td>
      <td>${{ new Intl.NumberFormat('es-mx').format(prod.price) }}</td>
      <td>{{ prod.stock }}</td> 
      <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
          <router-link :to="{path: 'editProduct/'+prod.id}"  class="btn btn-warning">
            <i class="fa-solid fa-edit"></i> Editar
          </router-link> 
          <button class="btn btn-danger" v-on:click="preguntaEliminar(prod.id,prod.description)">
            <i class="fa-solid fa-trash"></i> Eliminar
          </button>
        </div>
      </td> 
    </tr>

  </tbody>
</table>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2'
import {enviarSolicitud} from '../funciones.js'
export default {
    data() {
      return {
        products: null
      }
    },
    mounted() {
      this.getProducts();
    },
    methods: {
      getProducts(){
        axios.get('http://localhost:8000/api/products').then(
          response => (
            this.products = response.data
          )
        )
      },
      preguntaEliminar(id, nombre){
        var url = 'http://localhost:8000/api/product/'+id;
        console.log(id + " + " +nombre);
        Swal.fire({
          title: "Deseas eliminar el producto " + nombre + "?",
          text: "No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí, eliminar!",
          cancelButtonText: "Cancelar!"
        }).then((result) => {
          if (result.isConfirmed) {
            enviarSolicitud('DELETE', {id:id}, url, 'Producto Eliminado');
          }else{
            Swal.fire({
              title: "",
              text: "La tarea se canceló!",
              icon: "error"
            });
          }
        });
      }
    },
}


</script>