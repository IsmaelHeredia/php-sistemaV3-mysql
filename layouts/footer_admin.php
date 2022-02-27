<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

?>
          </div>
        </section>    
        <footer>
            <div class="container text-center">
                <p>Copyright &copy; Ismael Heredia 2021 &middot; All Rights Reserved &middot;</p>
            </div>
        </footer>
        <script src="js/app/tablas.js"></script>
        <script>

$(document).ready(function(){

  var id_producto = 0;

  if ($("#txtID_producto").length) {
    id_producto = $("#txtID_producto").val();
  }

  if($("#imagenes_producto").length){

    Dropzone.autoDiscover = false;
    
    var borrar_duplicado = false;

    var myDropzone = new Dropzone("div#imagenes_producto", 
    { 
      dictDefaultMessage: "Click para subir imágenes",
      url: "forms/productos/imagenes/subir.php",
      paramName: "file",
      acceptedFiles : "image/*",
      addRemoveLinks: true,
      dictRemoveFile: "Borrar",
      dictRemoveFileConfirmation:  "Esta seguro ?",
      init: function() {

          var thisDropzone = this;

          if(id_producto != 0) {
            $.ajax({
              type: "POST",
              url: "forms/productos/imagenes/listar.php",
              data: {"id_producto":id_producto},
              dataType: "json",
              success: function(imagenes){
                console.log(imagenes);

                for (var i = 0; i < imagenes.length; i++) {
                  var id = imagenes[i].id;
                  var nombre = imagenes[i].nombre;
                  var ruta = imagenes[i].ruta;
                  var tamaño = imagenes[i].tamaño;

                  var mockFile = { id: id, name: nombre, size: tamaño };

                  var callback = false;
                  var crossOrigin = false;
                  var resizeThumbnail = true;

                  thisDropzone.displayExistingFile(mockFile, "images/uploads/"+nombre, callback, crossOrigin, resizeThumbnail);
                  thisDropzone.emit("success", mockFile, "imagenSubida");
                  thisDropzone.files.push(mockFile);
                }
              }
            });
          }

          this.on("sending", function(file, xhr, formData){
            formData.append("id_producto", id_producto);
          });

          this.on("uploadprogress", function(file, progress) {
              console.log("File progress", progress);
          });

          this.on("success", function(file, response) {
              console.log(file);
              if(response == "imagenSubida") {
                $(file.previewTemplate).append("<span hidden class=\"tipo_archivo_servidor\">1</span><span hidden class=\"id_archivo_servidor\">"+ file.id + "</span><span hidden class=\"archivo_servidor\">"+ file.name +"</span>");
              } else {
                $(file.previewTemplate).append("<span hidden class=\"tipo_archivo_servidor\">0</span><span hidden class=\"id_archivo_servidor\">0</span><span hidden class=\"archivo_servidor\">"+ file.upload.filename +"</span>");
              }
          });

          this.on("removedfile", function(file) {
              var id_archivo_servidor = $(file.previewTemplate).children(".id_archivo_servidor").text();
              var archivo_servidor = $(file.previewTemplate).children(".archivo_servidor").text();
              var tipo_archivo_servidor = $(file.previewTemplate).children(".tipo_archivo_servidor").text();
              if(borrar_duplicado == true) {
                alert("Imagen repetida");
                borrar_duplicado = false;
              }
              if(tipo_archivo_servidor == "0") {
                $.ajax({
                    url: "forms/productos/imagenes/borrar.php",
                    type: "POST",
                    data: { "tipo": "borrarTemporal", "nombre": archivo_servidor},
                    dataType: "json",
                    success: function(resultado){
                      console.log(resultado);
                      //alert("Imagen temporal borrada");
                    },
                    error: function(xhr, textStatus, error){
                      console.log(xhr.statusText);
                      console.log(textStatus);
                      console.log(error);
                  }                           
                });
              } else {
                $.ajax({
                    url: "forms/productos/imagenes/borrar.php",
                    type: "POST",
                    data: { "tipo": "borrarServidor", "id": id_archivo_servidor},
                    dataType: "json",
                    success: function(resultado){
                      console.log(resultado);
                      //alert("Imagen del servidor borrada");
                    } ,
                      error: function(xhr, textStatus, error){
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                    }          
                });
              }
          });

          this.on("addedfile", function(file) {
              
              if(file.upload != null) {
                file.previewElement.querySelector("[data-dz-name]").textContent = file.upload.filename;
              }
              
              if (this.files.length) {
                  var _i, _len;
                  for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                  {
                      if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                      {
                          borrar_duplicado = true;
                          this.removeFile(file);
                      }
                  }
              }
              
          });

      },
      renameFile: function(file) {
        return new Date().getTime() + "_" + file.name;
      }

    });

  }
  
});

        </script>
    </body>
</html>