(function(){
   
    var formulario = document.formulario, 
    elementos = formulario.elements; 
    
    var letras = /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)$/;
    var codigo = /[0-9]/;


    var val_nombre = function(e){
        if(formulario.prov_nombre.value == 0){
          
        formulario.prov_nombre.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
        formulario.prov_nombre.parentElement.children[2].className = "error"; 
          e.preventDefault();
        }else if(!letras.test(prov_nombre.value)){
        formulario.prov_nombre.parentElement.children[2].innerHTML = 'Nombre invalido'; 
        formulario.prov_nombre.parentElement.children[2].className = "error"; 
          e.preventDefault();
          
        }else{
            formulario.prov_nombre.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.prov_nombre.parentElement.children[2].className = "correcto"; 
        }
      }


        var val_tel = function(e){
            if(formulario.prov_telefono.value == 0){
              formulario.prov_telefono.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
              formulario.prov_telefono.parentElement.children[2].className = "error"; 
              e.preventDefault();
  
          }else if(!codigo.test(prov_telefono.value)){
            formulario.prov_telefono.parentElement.children[2].innerHTML = 'Cédula invalida'; 
            formulario.prov_telefono.parentElement.children[2].className = "error"; 
              e.preventDefault();
  
          }else{
            formulario.prov_telefono.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.prov_telefono.parentElement.children[2].className = "correcto"; 
          }
        }


          var val_codigo = function(e){
            if(formulario.prov_codigo.value == 0){
                formulario.prov_codigo.parentElement.children[2].innerHTML = 'Debes rellenar el campo'; 
                formulario.prov_codigo.parentElement.children[2].className = "error"; 
              e.preventDefault();
  
          }else if(!codigo.test(formulario.prov_codigo.value)){
            formulario.prov_codigo.parentElement.children[2].innerHTML = 'Codigo invalido'; 
            formulario.prov_codigo.parentElement.children[2].className = "error"; 
              e.preventDefault();
          }else{
            formulario.prov_codigo.parentElement.children[2].innerHTML = '<i class="fas fa-check">'; 
            formulario.prov_codigo.parentElement.children[2].className = "correcto"; 
          }
  
          }

          var val_fecha = function(e){
            if(formulario.prov_fechaing.value == 0){
                formulario.prov_fechaing.parentElement.children[3].innerHTML = 'Debes rellenar el campo'; 
                formulario.prov_fechaing.parentElement.children[3].className = "error"; 
              e.preventDefault();
  
          }else{
            formulario.prov_fechaing.parentElement.children[3].innerHTML = '<i class="fas fa-check">'; 
            formulario.prov_fechaing.parentElement.children[3].className = "correcto"; 
          }
  
          }



        var inputs =  function(){
            this.parentElement.children[2].innerHTML = ""; 
        }


    var validar = function(e){
        val_nombre(e);  
        val_tel(e);
        val_codigo(e);
        val_fecha(e); 
    }
    
    formulario.addEventListener('submit', validar); 
    for(var i=0; i<elementos.length; i++){
        if(elementos[i].type == "text"){
            elementos[i].addEventListener('focus', inputs); 
            if(elementos[i].name == "prov_nombre"){
                elementos[i].addEventListener('blur',val_nombre); 
            }else if(elementos[i].name=="prov_telefono"){
                elementos[i].addEventListener('blur',val_tel);
            }else if(elementos[i].name=='prov_codigo'){
                elementos[i].addEventListener('blur',val_codigo);
            }
    }else if(elementos[i].type == "date"){
      if(elementos[i].name=='prov_fechaing'){
        elementos[i].addEventListener('blur',val_fecha);
    }
    }
}

}());
