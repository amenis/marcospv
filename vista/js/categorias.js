const newCategory = () => {

    const inputs = $('#newC').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);
    }
    const newC = ajax('categorias/newCat', formData);
    if (newC == 1) alertify.notify('Elemento Guardado', 'success', 5);
    setTimeout(() => { window.location.reload() }, 6000);
}

const getData = ref => {
    catData = JSON.parse(ajax('categorias/getCatById',{ref:ref}));
    document.getElementById('mod_ref').value=catData[0].id_categoria;
    document.getElementById('mod_descripcion').value = catData[0].descripcion;
    selectGroup = document.querySelectorAll('#mod_group > option');
  
    selectGroup.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if ( o[i].getAttribute('value') === catData[0].id_grupo  ) o[i].setAttribute('selected', 'true');
    }); 

    $('#update_cat').modal('show');
}

const update = ref => {
        
    const inputs = $('#updateC').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);
    }
    const updated = ajax('categorias/updateCat', formData);
    console.log(updated);
    if (updated == 1) { 
        alertify.notify('Elemento Actualizado', 'success', 5);
    } else {
        alertify.error(updated);
    }
    setTimeout(() => { window.location.reload() }, 6000);
    
}

const baja = ref => {
    alertify.confirm('Esta seguro que desea eliminar la Categoria').set('onok', () => {
        const deleteClient = ajax('categorias/deleteCat', { ref: ref });
        if(deleteClient == 1){
            alertify.notify('Ok', 'success', 1000);
            setTimeout( () => { window.location.reload() }, 2000);            
        } else {
            alertify.error('Ha ocurrido un error');
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