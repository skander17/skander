(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    
    var letras = /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)$/;
    var correo = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/; 

    var val_nombre = function(e){
        if(formulario.nombre.value == 0){
          
        formulario.nombre.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.nombre.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else if(!letras.test(nombre.value)){
        formulario.nombre.parentElement.children[2].innerHTML = 'Nombre invalido, solo letras'; 
        formulario.nombre.parentElement.children[2].className = "error"; 
          e.preventDefault();
          
        }else{
            formulario.nombre.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.nombre.parentElement.children[2].className = "correcto"; 
        }
      }

      var val_apellido = function(e){
        if(formulario.apellido.value == 0){
          
        formulario.apellido.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.apellido.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else if(!letras.test(apellido.value)){
        formulario.apellido.parentElement.children[2].innerHTML = 'Apellido invalido, solo letras'; 
        formulario.apellido.parentElement.children[2].className = "error"; 
          e.preventDefault();
          
        }else{
            formulario.apellido.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.apellido.parentElement.children[2].className = "correcto"; 
        }
      }

    var val_cargo = function(e){
        if(formulario.cargo.value == 0){
        formulario.cargo.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.cargo.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else if(!letras.test(cargo.value)){
        formulario.cargo.parentElement.children[2].innerHTML = 'Cargo invalido, solo letras'; 
        formulario.cargo.parentElement.children[2].className = "error"; 
          e.preventDefault();
          
        }else{
            formulario.cargo.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.cargo.parentElement.children[2].className = "correcto"; 
        }
      }

       var val_email = function(e){
          if(formulario.email.value == 0){
            formulario.email.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.email.parentElement.children[2].className = "error"; 
            e.preventDefault();

        }else if(!correo.test(email.value)){
            formulario.email.parentElement.children[2].innerHTML = 'Correo invalido'; 
            formulario.email.parentElement.children[2].className = "error"; 
            e.preventDefault();

        }else{
            formulario.email.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.email.parentElement.children[2].className = "correcto"; 
        }

        }

         var val_pass = function(e){
            if(formulario.pass.value == 0){
                formulario.pass.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
                formulario.pass.parentElement.children[2].className = "error"; 
                e.preventDefault();
            }else if(formulario.pass.value.length<8 || formulario.pass.value.length>20){
                formulario.pass.parentElement.children[2].innerHTML = 'Contraseña invalida, minimo 8 máximo 20'; 
                formulario.pass.parentElement.children[2].className = "error"; 
            }else if(formulario.pass.value !== formulario.rpass.value){
                formulario.rpass.parentElement.children[2].innerHTML = 'Las contraseñas no coinciden'; 
                formulario.rpass.parentElement.children[2].className = "error"; 
              e.preventDefault();
            }else{ 
                formulario.pass.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
                formulario.pass.parentElement.children[2].className = "correcto"; 
                formulario.rpass.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
                formulario.rpass.parentElement.children[2].className = "correcto"; 
            }
          }


        var inputs =  function(){
            this.parentElement.children[2].innerHTML = ""; 
        }


    var validar = function(e){
        val_nombre(e); 
       val_apellido(e);
         val_cargo(e); 
       val_email(e); 
         val_pass(e);
    }
    
    formulario.addEventListener('submit', validar); 

    for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == "text"){
          elementos[i].addEventListener('focus', inputs); 
            if(elementos[i].name == "nombre"){
                elementos[i].addEventListener('blur',val_nombre); 
            }else if(elementos[i].name == "apellido"){
                elementos[i].addEventListener('blur',val_apellido); 
            }else if(elementos[i].name == "cargo"){
                elementos[i].addEventListener('blur',val_cargo); 
            }else if(elementos[i].name == "email"){
                elementos[i].addEventListener('blur', val_email);
            }

    }else if(elementos[i].type == "password"){
      elementos[i].addEventListener('focus', inputs); 
        elementos[i].addEventListener('blur',val_pass);
    }
}

}());
