function registro(opcion){
    
    if(opcion == 0){
        document.getElementById("login").hidden = true;
        document.getElementById("registro").hidden = false;
    }else{
        document.getElementById("login").hidden = false;
        document.getElementById("registro").hidden = true;
    }

}

function notifica(){
    console.log("Entro a notifica");
    var toastLiveExample = document.getElementById('carrito');
    var toast = new bootstrap.Toast(toastLiveExample);
    // toast.options({delay: 2000});
    toast.show();
    console.log("Ya se prendio el toast");
}

function bajar(id){
    var cantidad = document.getElementById(id);
    var precio = document.getElementById("P"+id);
    var total = document.getElementById("T"+id);
    var boton = document.getElementById("B"+id);
    
    console.log("Entro a baja");
    console.log(cantidad.value);
    cantidad.value --;
    total.value = precio.value * cantidad.value;
    boton.click();
}

function subir(id){
    var cantidad = document.getElementById(id);
    var precio = document.getElementById("P"+id);
    var total = document.getElementById("T"+id);
    var boton = document.getElementById("B"+id);
    console.log("Entro a subir");
    console.log(cantidad.value);
    cantidad.value ++;
    total.value = precio.value * cantidad.value;
    boton.click();
}