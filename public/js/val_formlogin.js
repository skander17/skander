(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    
    var correo = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/; 

    

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
            }else{ 
                formulario.pass.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
                formulario.pass.parentElement.children[2].className = "correcto"; 
            }
          }


        var inputs =  function(){
         this.parentElement.children[2].innerHTML = "";
         this.parentElement.children[2].className = "";
        }


    var validar = function(e){
        val_email(e); 
        val_pass(e);
    }
    
    formulario.addEventListener('submit', validar); 

  for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == "text" || elementos[i].type == "password"){
            elementos[i].addEventListener('focus', inputs); 
            if(elementos[i].name == "email"){
                elementos[i].addEventListener('blur', val_email);
            }else if(elementos[i].name == "pass"){
                elementos[i].addEventListener('blur',val_pass);
              
            }
    } 
       
    
}

}());
