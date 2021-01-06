const newGroup = () => {
    const description = document.getElementById('descripcion').value;
    const newG = ajax('grupos/newG', {descripcion: description});
    console.log(newG);
    if (newG == 1) {
        alertify.notify('Elemento Guardado', 'success', 5);
    } else {
        alertify.error(newG);
    }
    setTimeout(() => { window.location.reload() }, 6000);
}

const getData = ref => {
    gData = JSON.parse(ajax('grupos/getGroupById',{ref:ref}));
    document.getElementById('mod_ref').value=gData[0].id_grupo;
    document.getElementById('mod_descripcion').value = gData[0].descripcion;
    $('#update_group').modal('show');
}

const update = () => {
    
    const description = document.getElementById('mod_descripcion').value;
    const ref = document.getElementById('mod_ref').value;
 
    const updated = ajax('grupos/updateG', { descripcion: description, ref: ref });
    console.log(updated);
    if (updated == 1) { 
        alertify.notify('Elemento Actualizado', 'success', 5);
    } else {
        alertify.error(updated);
    }
    setTimeout(() => { window.location.reload() }, 6000);
    
}

const baja = ref => {
    alertify.confirm('Esta seguro que desea eliminar el grupo').set('onok', () => {
        const deleteGroup = ajax('grupos/deleteG', { ref: ref });
        if(deleteGroup == 1){
            alertify.notify('Ok', 'success', 1000);
            setTimeout( () => { window.location.reload() }, 2000);            
        } else {
            alertify.error(deleteGroup[2]);
        }
    });
}



$(document).ready(function() {
    $('#tbl-cat').DataTable({
        "language": {
            "lengthMenu": "Mostrar_MENU_ Registros por pagina",
            "sSearch": 'Buscar por Nombre',
            "sInfo": "Pagina _PAGE_ de  _PAGES_ de _TOTAL_ Registros",
        }
    });
});