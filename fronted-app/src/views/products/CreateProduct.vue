<template>
    Acá se crean
    <!--<button v-on:click="ax"></button>-->
    <div class="row-mt-3">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <h5 class="card-header text-center">Agregar Producto</h5>
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
                <input type="number" v-model="stock" id="stock" class="form-control" placeholder="Stock" aria-label="Username" aria-describedby="basic-addon1" min="0" step="1" required>
              </div>
              <div class="d-grid col-6 mx-auto">
                <button class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
              </div>

            </form>
          </div>
        </div>


      </div>

    </div>

</template>


<script>
import Swal from 'sweetalert2'
import { enviarSolicitud } from '../funciones';
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
    description:'', price:'', stock:'', url:'http://localhost:8000/api/product'
  }
},
methods: {
  guardar(){
    event.preventDefault();
    if(this.description.trim() === ''){
      Swal.fire("Escribe el nombre!","You clicked the button!","warning");
    }
    var parametros = {description:this.description, price:this.price, stock:this.stock};
    enviarSolicitud('POST', parametros, this.url, 'Producto guardado')
  }
},

}
</script>