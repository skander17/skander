(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    var codigo = /[0-9]/;

 
   var val_mercancia = function(e){
        if(formulario.entra_mercancia.value == 0){
        formulario.entra_mercancia.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.entra_mercancia.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else{
            formulario.entra_mercancia.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.entra_mercancia.parentElement.children[2].className = "correcto"; 
        }
      }

      var val_proveedor= function(e){
          if(formulario.entra_proveedor.value == 0){
            formulario.entra_proveedor.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.entra_proveedor.parentElement.children[2].className = "error";
            e.preventDefault();

          }else{
            formulario.entra_proveedor.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.entra_proveedor.parentElement.children[2].className = "correcto"; 
        }

        }
        var val_fecha = function(e){
          if(formulario.entra_fecha.value == 0){
              formulario.entra_fecha.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
              formulario.entra_fecha.parentElement.children[2].className = "error"; 
            e.preventDefault();

        }else{
          formulario.entra_fecha.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
          formulario.entra_fecha.parentElement.children[2].className = "correcto"; 
        }

        }


         
         var val_cantidad = function(e){
            if(formulario.entrada_can.value == 0){
                formulario.entrada_can.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
                formulario.entrada_can.parentElement.children[2].className = "error";
              e.preventDefault();
  
          }else if(!codigo.test(formulario.entrada_can.value)){
            formulario.entrada_can.parentElement.children[2].innerHTML = 'Cantidad invalida'; 
            formulario.entrada_can.parentElement.children[2].className = "error";
              e.preventDefault();
          }else{
            formulario.entrada_can.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.entrada_can.parentElement.children[2].className = "correcto"; 
          }
  
          }

        var inputs =  function(){
            this.parentElement.children[2].innerHTML = ""; 
        }

        var selects = function(){
          this.parentElement.children[2].innerHTML = ""; 
        }


  var validar = function(e){
      val_mercancia(e);
       val_fecha(e); 
       val_cantidad(e); 
    }
    
    formulario.addEventListener('submit', validar); 
    for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == 'text'){
          elementos[i].addEventListener('focus', inputs); 
          if(elementos[i].name == 'entrada_can'){
            elementos[i].addEventListener('blur', val_cantidad); 
          }
        }else if(elementos[i].type == 'date'){
          elementos[i].addEventListener('focus', inputs); 
          elementos[i].addEventListener('blur', val_fecha); 
        }else if(elementos[i].classList.contains('select')){
          elementos[i].addEventListener('focus', selects); 
          if(elementos[i].name == 'entra_mercancia'){
            elementos[i].addEventListener('blur', val_mercancia); 
          }
         
        }
    }

}()); 
 
    







        

     
