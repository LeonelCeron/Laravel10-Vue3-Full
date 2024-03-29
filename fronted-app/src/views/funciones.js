import axios from "axios";
import Swal from "sweetalert2";

export function enviarSolicitud(metodo, parametros, url, mensaje){
    axios({
        method:metodo,
        url:url,
        data: parametros
    }).then(function (respuesta) {
      var status = respuesta.data[0]['status'];
      console.log(respuesta.data[0]);
      if(status==="success"){
        Swal.fire({
            title: mensaje,
            text: mensaje + " exítosamente!",
            icon: "success"
          });
        window.setTimeout(function(){
          window.location.href='/showProducts';
        }, 1000);
      }else{
        var listado = '';
        //Los errores vienen en ek segundo array
        var errores = respuesta.data[1]['erros'];
        Object.key(errores).array.forEach(
          key => listado += errores[key][0] + '.'
        );
        Swal.fire({
            title: "",
            text: listado,
            icon: "error"
          });

      }
    }).catch(function (error) {
      Swal.fire({
            title: "",
            text: "Error en la solicitud",
            icon: "error"
      });
    })
  }