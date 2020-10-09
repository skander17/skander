(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    
    var letras = /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)$/;
    var correo = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/; 
    var codigo = /[0-9]/;


    var val_nombre = function(e){
        if(formulario.cli_nombre.value == 0){
          
        formulario.cli_nombre.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.cli_nombre.parentElement.children[2].className = "error";
          e.preventDefault();
        }else if(!letras.test(cli_nombre.value)){
        formulario.cli_nombre.parentElement.children[2].innerHTML = 'Nombre invalido'; 
        formulario.cli_nombre.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else{
          formulario.cli_nombre.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.cli_nombre.parentElement.children[2].className = "correcto"; 
        }
      }

     var val_apellido = function(e){
        if(formulario.cli_apellido.value == 0){
          
        formulario.cli_apellido.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.cli_apellido.parentElement.children[2].className = "error";
          e.preventDefault();
        }else if(!letras.test(cli_apellido.value)){
        formulario.cli_apellido.parentElement.children[2].innerHTML = 'Apellido invalido'; 
        formulario.cli_apellido.parentElement.children[2].className = "error"; 
          e.preventDefault();
          
        }else{
            formulario.cli_apellido.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.cli_apellido.parentElement.children[2].className = "correcto"; 
        }
      }


        var val_telefono = function(e){
            if(formulario.cli_telefono.value == 0){
              formulario.cli_telefono.parentElement.children[2].innerHTML = 'Debes rellenar el campo';
              formulario.cli_telefono.parentElement.children[2].className = "error"; 
              e.preventDefault();
  
          }else if(!codigo.test(cli_telefono.value)){
            formulario.cli_telefono.parentElement.children[2].innerHTML = 'Télefono invalido'; 
            formulario.cli_telefono.parentElement.children[2].className = "error";
              e.preventDefault();
  
          }else{
            formulario.cli_telefono.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.cli_telefono.parentElement.children[2].className = "correcto"; 
          }
  
          }

          var val_codigo = function(e){
            if(formulario.cli_codigo.value == 0){
                formulario.cli_codigo.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
                formulario.cli_codigo.parentElement.children[2].className = "error";
              e.preventDefault();
  
          }else if(!codigo.test(formulario.cli_codigo.value)){
            formulario.cli_codigo.parentElement.children[2].innerHTML = 'Codigo invalido'; 
            formulario.cli_codigo.parentElement.children[2].className = "error";
              e.preventDefault();
          }else{
            formulario.cli_codigo.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.cli_codigo.parentElement.children[2].className = "correcto"; 
          }
  
          }

        var inputs =  function(){
            this.parentElement.children[2].innerHTML = ""; 
        }


    var validar = function(e){
        val_nombre(e); 
        val_telefono(e);
        val_codigo(e);
        val_apellido(e);
    }
    
    formulario.addEventListener('submit', validar); 
    for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == "text"){
            elementos[i].addEventListener('focus', inputs); 
            if(elementos[i].name == "cli_nombre"){
                elementos[i].addEventListener('blur',val_nombre);
            }else if(elementos[i].name == "cli_apellido"){
              elementos[i].addEventListener('blur',val_apellido);    
            }else if(elementos[i].name=="cli_telefono"){
                elementos[i].addEventListener('blur',val_telefono);
            }else if(elementos[i].name=='cli_codigo'){
                elementos[i].addEventListener('blur',val_codigo);

            }
        }
    }
    
}()); 
 
    
