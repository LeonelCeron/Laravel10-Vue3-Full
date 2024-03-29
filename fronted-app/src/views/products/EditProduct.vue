<template>
    Acá se crean
    <!--<button v-on:click="ax"></button>-->
    <div class="row-mt-3">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <h5 class="card-header text-center">Editar Producto</h5>
          <div class="card-body">
            <form v-on:submit="guardar">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" v-model="description" id="description" class="form-control" placeholder="Descripción del producto" aria-label="Username" aria-describedby="basic-addon1" maxlength="50"required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                <input type="number" v-model="price" id="price" class="form-control" placeholder="Precio" aria-label="Username" aria-describedby="basic-addon1" min="1" step="0.1" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" v-model="stock" id="stock" class="form-control" placeholder="Stock" aria-label="Username" aria-describedby="basic-addon1" min="0" step="1" required>
              </div>
              <div class="d-grid col-6 mx-auto">
                <button class="btn btn-success"><i class="fa-solid fa-refresh"></i> Actualizar</button>
              </div>

            </form>
          </div>
        </div>


      </div>

    </div>

</template>


<script>
import Swal from 'sweetalert2'
import { enviarSolicitud } from '../funciones'
import { useRoute } from 'vue-router'
import axios from 'axios'
/*
export default {
  methods: {
    ax() {
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
        })
    },
  },
};
*/

export default{
data(){
  return{
    id: 0, description:'', price:'', stock:'', url:'http://localhost:8000/api/product'
  }
},
mounted() {
    const route = useRoute();
    this.id = route.params.id;
    this.url = this.url + '/' + this.id;
    this.getProducto();
},
methods: {
    guardar(){
        event.preventDefault();
        if(this.description.trim() === ''){
        Swal.fire("Escribe el nombre!","You clicked the button!","warning");
        }
        var parametros = {description:this.description, price:this.price, stock:this.stock};
        enviarSolicitud('PUT', parametros, this.url, 'Producto actualizado')
    },
    getProducto(){
        axios.get(this.url).then(
            response => (
                this.description = response.data['description'],
                this.price = response.data['price'],
                this.stock = response.data['stock']
            )
        )
    }


},

}
</script>