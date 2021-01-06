const getClient = (ref) => {
    $('#update_client').modal('show');
    const refId = ref;
    const clientResponse = JSON.parse(ajax('clientes/getClientById', {ref: refId }));
   
    document.getElementById('ref').value = clientResponse[0].id_cliente;
    document.getElementById('mod_nombre').value = clientResponse[0].nombre;
    document.getElementById('mod_apellidos').value = clientResponse[0].apellidos;
    document.getElementById('mod_domicilio').value = clientResponse[0].domicilio;
    const estado = document.querySelectorAll('#mod_estado > option');
    estado.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === clientResponse[0].estado) { o[i].setAttribute('selected', 'true'); }
    });
    document.getElementById('mod_ciudad').value = clientResponse[0].ciudad;
    document.getElementById('mod_codigopostal').value = clientResponse[0].codigopostal;
    document.getElementById('mod_telefono').value = clientResponse[0].telefono;
}

const editClient = () => {
    const inputs = $('#form_mod_client').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);

    }
    formData.append('accion', 'editClient');

    const edit = ajax('clientes/updateClient', formData);
    console.log(edit);
    if (edit == 1) {
        alertify.notify('Los datos han sido actualizados correctamente', 'success');
        setTimeout(() => { window.location.reload() }, 1000);
    }

}

const baja = (id) => {
    alertify.confirm('Esta seguro que desea eliminar al cliente').set('onok', () => {
        const deleteClient = ajax('clientes/unsubcribe', { ref: id });
        if($deleteClient == 1){
            alertify.notify('Ok', 'success', 1000, () => { window.location.reload(); });            
        } else {
            alertify.error('Ha ocurrido un error');
        }
    });

}
/*
const restaurar = (id) => {

    var r = confirm('Esta seguro que desea restaurar el cliente');
    if (r == true) {
        $.ajax({
            url: '../../../controladores/control_clientes.php',
            type: "post",
            data: { accion: 'restaurar', ref: id },
            success: (data) => {
                alert(data);
                window.location.reload()
            }
        });
    }

}*/

const newClient = () => {
    
    const newC = ajax('clientes/newClient',$('#newClient').serialize());
    if(newC == 1){
        alertify.notify('','success', 5, ()=>{window.location.reload();});
    } else{
        alertify.error('Ha ocurrido un error');
    }
}

$(document).ready(function() {
    $('#tbl-clients').DataTable({
        "language": {
            "lengthMenu": "Mostrar_MENU_ Registros por pagina",
            "sSearch": 'Buscar por Nombre',
            "sInfo": "Pagina _PAGE_ de  _PAGES_ de _TOTAL_ Registros",
        }
    });
});