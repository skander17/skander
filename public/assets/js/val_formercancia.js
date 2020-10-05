(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    
    var codigo = /[0-9]/;
    var letras = /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)$/;

    var mercancia_proveedor = function(e){
        if(formulario.mer_proveedor.value == 0){
            formulario.mer_proveedor.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_proveedor.parentElement.children[2].className = "error";
            e.preventDefault();
        }else{
            formulario.mer_proveedor.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_proveedor.parentElement.children[2].className = "correcto"; 
        }
         
      }
      var nombre_mercancia = function(e){
        if(formulario.mer_nombre.value == 0){
            formulario.mer_nombre.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_nombre.parentElement.children[2].className = "error";
            e.preventDefault();

          }else if(!letras.test(mer_nombre.value)){
            formulario.mer_nombre.parentElement.children[2].innerHTML = 'Nombre invalido'; 
            formulario.mer_nombre.parentElement.children[2].className = "error";
            e.preventDefault();
          }else{
            formulario.mer_nombre.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_nombre.parentElement.children[2].className = "correcto"; 
        }
         
      }

      var mercancia_cantidad = function(e){
        if(formulario.mer_canti.value == 0){
            formulario.mer_canti.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_canti.parentElement.children[2].className = "error";
            e.preventDefault();

          }else if(!codigo.test(mer_canti.value)){
            formulario.mer_canti.parentElement.children[2].innerHTML = 'Cantidad invalida'; 
            formulario.mer_canti.parentElement.children[2].className = "error";
            e.preventDefault();
          }else{
            formulario.mer_canti.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_canti.parentElement.children[2].className = "correcto"; 
        }
      }

      var codigo_mercancia = function(e){
        if(formulario.mer_codigo.value == 0){
            formulario.mer_codigo.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_codigo.parentElement.children[2].className = "error";
            e.preventDefault();

          }else if(!codigo.test(mer_codigo.value)){
            formulario.mer_codigo.parentElement.children[2].innerHTML = 'Codigo invalido'; 
            formulario.mer_codigo.parentElement.children[2].className = "error";
            e.preventDefault();
          }else{
            formulario.mer_codigo.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_codigo.parentElement.children[2].className = "correcto"; 
        }
      }

      var compra_mercancia = function(e){
        if(formulario.mer_precio_com.value == 0){
            formulario.mer_precio_com.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_precio_com.parentElement.children[2].className = "error";
            e.preventDefault();

          }else if(!codigo.test(mer_precio_com.value)){
            formulario.mer_precio_com.parentElement.children[2].innerHTML = 'Monto invalido'; 
            formulario.mer_precio_com.parentElement.children[2].className = "error";
            e.preventDefault();
          }else{
            formulario.mer_precio_com.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_precio_com.parentElement.children[2].className = "correcto"; 
        }
      }

      var venta_mercancia = function(e){
        if(formulario.mer_precio_ven.value == 0){
            formulario.mer_precio_ven.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
            formulario.mer_precio_ven.parentElement.children[2].className = "error";
            e.preventDefault();

          }else if(!codigo.test(mer_precio_ven.value)){
            formulario.mer_precio_ven.parentElement.children[2].innerHTML = 'Monto invalido'; 
            formulario.mer_precio_ven.parentElement.children[2].className = "error";
            e.preventDefault();
          }else{
            formulario.mer_precio_ven.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.mer_precio_ven.parentElement.children[2].className = "correcto"; 
        }
      }
     
        var inputs =  function(){
            this.parentElement.children[2].innerHTML = ""; 
        }

        var selects = function(){
          this.parentElement.children[2].innerHTML = ""; 
        }


    var validar = function(e){
      mercancia_proveedor(e);
      nombre_mercancia(e); 
      mercancia_cantidad(e); 
      codigo_mercancia(e); 
      compra_mercancia(e);  
      venta_mercancia(e); 
    }
    
    formulario.addEventListener('submit', validar); 
    for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == 'text'){
            elementos[i].addEventListener('focus', inputs); 
            if(elementos[i].name == 'mer_nombre'){
                elementos[i].addEventListener('blur',nombre_mercancia);
            }else if(elementos[i].name == 'mer_canti'){
                elementos[i].addEventListener('blur',mercancia_cantidad);
            }else if(elementos[i].name == 'mer_codigo'){
                elementos[i].addEventListener('blur',codigo_mercancia);
            }else if(elementos[i].name == 'mer_precio_com'){
                elementos[i].addEventListener('blur',compra_mercancia);
            }else if(elementos[i].name == 'mer_precio_ven'){
                    elementos[i].addEventListener('blur', venta_mercancia)
                
            }
        }else if(elementos[i].classList.contains('select')){
            elementos[i].addEventListener('focus', selects); 
            elementos[i].addEventListener('blur', mercancia_proveedor); 
        }
       
    }

}()); 
 
    