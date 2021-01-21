const getProve = id => {
    $.post('Proveedores/getProviderById', { id: id }, req => {
        prove = JSON.parse(req)
        form = document.getElementById('form_mod_prove');
        formInput = [];       
        for (let index = 0; index < form.length; index++) {
            formInput.push(form[index].id);
        }
        prove.map(x=>{
            document.getElementById(formInput[0]).value = x.id_proveedor
            document.getElementById(formInput[1]).value = x.nombre
            document.getElementById(formInput[2]).value = x.domicilio
            document.getElementById(formInput[3]).value = x.ciudad
            estado = document.querySelectorAll("#"+formInput[4]+" > option").forEach((e,i,o)=>{
                o[i].removeAttribute('selected');
                if(o[i].getAttribute('value') == x.estado) { o[i].setAttribute("selected",true) }
            });
            document.getElementById(formInput[5]).value = x.codigopostal
            document.getElementById(formInput[6]).value = x.telefono
        })
        
        $('#update_provider').modal('show');
    });
}

const nuevo = () => {
    form = document.getElementById('newProve');
    formData = new FormData();
    for (let index = 0; index < form.length; index++) {
        formData.append(form[index].name, form[index].value);
    }
    req = ajax('proveedores/newProvider', formData)
    console.log(req);
    if (req == 1) {
        alertify.notify('Actualizado Correctamente', 'success');
        setTimeout(() => {
            window.location.reload()
        }, 3000);
    } else {
        alertify.error(req);
    }
}

const actualizar = () => {
    formData = new FormData();
    form = document.getElementById('form_mod_prove');
    for (let index = 0; index < form.length; index++) {
        formData.append(form[index].name, form[index].value);
    }
   
    update  = ajax('proveedores/updateProvider',formData);
    if(update ==1){
        alertify.notify('Actualizado Correctamente','success');
        setTimeout(()=>{window.location.reload()},3000);
    } else {
        alertify.error(update);
    }
    
}

const eliminar = ref => {
    $.post('proveedores/deleteProvider',{ref:ref}, req=>{
        if(req ==1){
            alertify.notify('Actualizado Correctamente','success');
            setTimeout(()=>{window.location.reload()},3000);
        } else {
            alertify.error(req);
        }
    });
}

$(document).ready(function() {
    $('#tbl-provider').DataTable({
        "language": {
            "lengthMenu": "Mostrar_MENU_ Registros por pagina",
            "sSearch": 'Buscar por Nombre',
            "sInfo": "Pagina _PAGE_ de  _PAGES_ de _TOTAL_ Registros",
        }
    });
});