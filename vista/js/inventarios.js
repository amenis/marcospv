const getProduct = (ref) => {
    const p = JSON.parse(ajax('inventarios/getProductById', { ref: ref }));
    document.getElementById('descripcion').value = p[0].descripcion;
    document.getElementById('codigo').value = p[0].codigo;
    document.getElementById('precio').value = p[0].precio;
    document.getElementById('costo').value = p[0].costo;
    document.getElementById('stMin').value = p[0].stock_min;
    document.getElementById('stMax').value = p[0].stock_max;
    document.getElementById('existencia').value = p[0].existencia;
    const cat = document.querySelectorAll('#categoria > option');
    cat.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === p[0].id_categoria) { o[i].setAttribute('selected', 'true'); }
    });
    const prov = document.querySelectorAll('#proveedor > option');
    prov.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === p[0].id_proveedor) { o[i].setAttribute('selected', 'true'); }
    });

    document.getElementById('btn-update').setAttribute('onclick', 'updateP(' + p[0].id_inventario + ')')

    $('#update_product').modal('show');
}

const newProduct = () => {
    saved = ajax("inventarios/newArticule", $('#newA').serialize());
    if (saved == 1) alertify.notify('Registro Guardado Correctamente', 'success', 5);
    setTimeout(() => {
        window.location.reload();
    }, 6000);
}

const updateP = ref => {
    const inputs = $('#update').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);

    }
    formData.append('ref', ref);

    updated = ajax("inventarios/updateArticule", formData);
    if (updated == 1) alertify.notify('Registro Actualizado Correctamente', 'success', 5);
    setTimeout(() => {
        window.location.reload();
    }, 6000);
}

const unsubcribe = ref => {
    alertify.confirm('Esta seguro que desea dar de baja el articuclo').set('onok', () => {
        const uns = ajax('inventarios/unsubscribeArticule', { ref: ref });
        if (uns == 1) {
            alertify.notify('El articulo ha sido dado de baja', 'success', 1000);
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            alertify.error('Ha ocurrido un error');
        }
    });
}

const restore = ref => {
    alertify.confirm('Esta seguro que desea restaurar el articuclo').set('onok', () => {
        const uns = ajax('restoreArticule', { ref: ref });
        if (uns == 1) {
            alertify.notify('Articulo Restaurado', 'success', 1000);
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            alertify.error('Ha ocurrido un error');
        }
    });
}

$(document).ready(function() {
    $('#tbl-storage').DataTable({
        "language": {
            "lengthMenu": "Mostrar_MENU_ Registros por pagina",
            "sSearch": 'Buscar',
            "sInfo": "Pagina _PAGE_  de _TOTAL_ Registros",
        }
    });
});