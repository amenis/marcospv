const newOrder = () => {
    let formData = new FormData();
    let input = $('#newO').serialize();
    let splitedInput = input.split('&');
    for (let index = 0; index < splitedInput.length; index++) {
        let temp = splitedInput[index].split('=');
        let val = replaceAll(decodeURIComponent(temp[1].toString()), '+', '');
        formData.append(temp[0], val);
    }

    let orderSaved = ajax('pedidos/newOrder', formData);
    if (orderSaved == 1) {
        alertify.notify('Pedido Guardado Correctamente', 'success', 5);
        setTimeout(() => {
            window.location.reload();
        }, 4000);
    } else {
        alertify.error(orderSaved);
    }

}

const editOrder = () => {
    let formData = new FormData();
    let input = $('#editO').serialize();
    let splitedInput = input.split('&');
    for (let index = 0; index < splitedInput.length; index++) {
        let temp = splitedInput[index].split('=');
        let val = replaceAll(decodeURIComponent(temp[1].toString()), '+', '');
        formData.append(temp[0], val);
    }
    let editO = ajax('pedidos/editOrder', formData);
    console.log(editO);
    if (editO) {
        alertify.notify('Registro Guardado correctamente', 'success', 5);
        setTimeout(() => {
            window.location.reload();
        }, 4000);
    } else {
        alertify.error(editO);
    }
}

const getOrder = ref => {
    order = JSON.parse(ajax('pedidos/getOrderById', { ref: ref }));
    document.getElementById('ref').value = order[0].id_pedidos;
    document.getElementById('editFecha').value = order[0].fecha;
    document.getElementById('editCantidad').value = order[0].cantidad;
    document.getElementById('editObservaciones').value = order[0].observaciones;
    selectArticulos = document.querySelectorAll('#editArticulo > option');
    selectArticulos.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') == order[0].id_inventario) { o[i].setAttribute('selected', 'true') }
    });

    $('#edit_order').modal('show');

}

const closeOrder = ref => {
    alertify.confirm('Esta seguro que desea cerrar el pedido').set('onok', () => {
        let del = ajax('pedidos/closeOrder', { ref: ref });
        if (del) {
            alertify.notify('Pedido Cerrado', 'success', 5);
            setTimeout(() => {
                window.location.reload();
            }, 6000);
        } else {
            alertify.error(del);
        }
    });
}

$(document).ready(function() {
    $('#tbl-pedidos').DataTable({
        "language": {
            "lengthMenu": "Mostrar_MENU_ Registros por pagina",
            "sSearch": 'Buscar por Nombre',
            "sInfo": "Pagina _PAGE_ de  _PAGES_ de _TOTAL_ Registros",
        }
    });
});