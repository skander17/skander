(function(){
   
  var formulario = document.formulario, 
  elementos = formulario.elements; 
  
 
  var codigo = /[0-9]/;


  var val_mercancia = function(e){
      if(formulario.salida_mercancia.value == 0){
        
      formulario.salida_mercancia.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
      formulario.salida_mercancia.parentElement.children[2].className = "error"; 
        e.preventDefault();
      }else{
          formulario.salida_mercancia.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
          formulario.salida_mercancia.parentElement.children[2].className = "correcto"; 
      }
    }

    var val_cliente= function(e){
        if(formulario.salida_cliente.value == 0){
          formulario.salida_cliente.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
          formulario.salida_cliente.parentElement.children[2].className = "error";
          e.preventDefault();

        }else{
          formulario.salida_cliente.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
          formulario.salida_cliente.parentElement.children[2].className = "correcto"; 
      }

      }

   var val_fecha = function(e){
        if(formulario.salida_fecha.value == 0){
            formulario.salida_fecha.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.salida_fecha.parentElement.children[2].className = "error"; 
          e.preventDefault();

      }else{
        formulario.salida_fecha.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
        formulario.salida_fecha.parentElement.children[2].className = "correcto"; 
      }

      }


          var val_cantidad = function(e){
          if(formulario.salida_cant.value == 0){
              formulario.salida_cant.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
              formulario.salida_cant.parentElement.children[2].className = "error";
            e.preventDefault();

        }else if(!codigo.test(formulario.salida_cant.value)){
          formulario.salida_cant.parentElement.children[2].innerHTML = 'Cantidad invalida'; 
          formulario.salida_cant.parentElement.children[2].className = "error";
            e.preventDefault();
        }else{
          formulario.salida_cant.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
          formulario.salida_cant.parentElement.children[2].className = "correcto"; 
        }

        }

    var val_monto = function(e){
          if(formulario.salida_precio.value == 0){
              formulario.salida_precio.parentElement.children[2].innerHTML = 'Debes rellenar el campo';
              formulario.salida_precio.parentElement.children[2].className = "error"; 
            e.preventDefault();

        }else if(!codigo.test(salida_precio.value)){
          formulario.salida_precio.parentElement.children[2].innerHTML = 'Monto invalido'; 
          formulario.salida_precio.parentElement.children[2].className = "error";
            e.preventDefault();

        }else{
          formulario.salida_precio.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
          formulario.salida_precio.parentElement.children[2].className = "correcto";
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
    val_cliente(e); 
    val_fecha(e); 
    val_cantidad(e); 
    val_monto(e);
  }
  
  formulario.addEventListener('submit', validar); 
  for(var i=0; i<elementos.length; i++){
      if(elementos[i].type == 'text'){
        elementos[i].addEventListener('focus', inputs); 
        if(elementos[i].name == 'salida_cant'){
          elementos[i].addEventListener('blur', val_cantidad); 
        }else if(elementos[i].name == 'salida_precio'){
          elementos[i].addEventListener('blur', val_monto); 
        }
      }else if(elementos[i].type == 'date'){
        elementos[i].addEventListener('focus', inputs); 
        elementos[i].addEventListener('blur', val_fecha); 
      }else if(elementos[i].classList.contains('select')){
        elementos[i].addEventListener('blur', selects); 
        if(elementos[i].name == 'salida_mercancia'){
          elementos[i].addEventListener('blur',val_mercancia);
        }else if(elementos[i].name == 'salida_cliente'){
          elementos[i].addEventListener('blur',val_cliente);
        }
      }
  }

}()); 