const byDate = () => {
    document.querySelector('#date-in').removeAttribute('disabled');
    document.querySelector('#date-end').removeAttribute('disabled');
    document.querySelector('#search-name').setAttribute('disabled', true);
    document.querySelector('#btn-sbd').removeAttribute('disabled');
}

const byName = () => {
    document.querySelector('#date-in').setAttribute('disabled', true);
    document.querySelector('#date-end').setAttribute('disabled', true);
    document.querySelector('#btn-sbd').setAttribute('disabled', true);
    document.querySelector('#search-name').removeAttribute('disabled');
}

const searchClient = function() {
    var clienteRef = document.querySelector('#txt-search').value;
    if (clienteRef == "") {
        $('#search-results').html('');
    } else {

        const dataRes = JSON.parse(ajax('apartados/name', { ref: clienteRef }));

        $('#search-results').html('');
        dataRes.forEach(e => {
            $('#search-results').append(
                `
                <tr>
                    <td>${e['id_cliente']}</td>
                    <td>${e['nombre_cliente']}</td>
                    <td>${e['domicilio']}</td>
                    <td>${e['ciudad']}</td>
                    <td>${e['estado']}</td>
                    <td>${e['telefono']}</td>
                    <td><button class="btn btn-primary" onclick="cargarDatosCliente(${e['id_cliente']})">Agregar</button></td>
                </tr>
                `
            );
        });

    }
}

const searchByDate = () => {

    let dateIn = document.querySelector('#date-in').value;
    let dateEnd = document.querySelector('#date-end').value;

    if (dateIn && dateEnd === '') {
        alertify.alert('Los campos de fecha no pueden estar vacios');
    } else {

        const items = JSON.parse(ajax('apartados/dates', {
            dateIn: dateIn,
            dateEnd: dateEnd
        }));

        $('#BuscaCliente').modal('hide');

        showSpiner();
        setTimeout(() => {
            hideSpiner();

            items.forEach(el => {
                document.querySelector('#tbl-info tbody').innerHTML = `
                        <tr>
                            <td>${items[0].fecha}</td>
                            <td>${items[0].folio}</td>
                            <td>${items[0].nombre_empleado}</td>
                            <td>${items[0].nombre_cliente}</td>
                            <td>${items[0].importe_total}</td>
                            <td><button onclick="resumen(${items[0].id_apartados})"><i class="fa fa-pen-square"></i></button></td>
                        <tr>
                    `;
            });
        }, 1000);


    }

}

const cargarDatosCliente = ref => {
    const items = JSON.parse(ajax('apartados/getOwe', { clienteRef: ref }))

    $('#BuscaCliente').modal('hide');
    document.querySelector('#search-name').value = items[0].nombre_cliente;
    showSpiner();
    setTimeout(() => {
        hideSpiner();
        document.querySelector('#tbl-info tbody').innerHTML = `
                <tr>
                    <td>${items[0].fecha}</td>
                    <td>${items[0].folio}</td>
                    <td>${items[0].nombre_empleado}</td>
                    <td>${items[0].nombre_cliente}</td>
                    <td>${items[0].importe_total}</td>
                    <td><button onclick="resumen(${items[0].id_apartados})"><i class="fa fa-pen-square"></i></button></td>
                <tr>
            `;
    }, 1000);

}

const resumen = ref => {
    const response = JSON.parse(ajax('apartados/getResumen', { ref: ref }));
    console.log( Object.keys(response).length);
    
    document.querySelector('#nom_cli').value = response.historial['nombre_cliente'];
    document.querySelector('#tab').value = response.balance['total_abonos'];
    document.querySelector('#tad').value = response.balance['total_ventas'];
    document.querySelector('#tdb').value = response.balance['total_ventas'] - response.balance['total_abonos'];
    console.log(response);
    response.historial.forEach((e, i) => {
        $('#tbody-vp').append(`
                <tr>
                    <td>${i+1}</td>
                    <td>${e.fecha}</td>
                    <td>Abono a Cuenta</td>
                    <td>${e.cantidad}</td>                   
                </tr>   
            `);
    });

    document.querySelector('#btn-pay').setAttribute('onclick', 'payment(' + response.historial[0]['id_apartado'] + ')');

    $('#verPagos').modal('show');

}

const payment = (folioVenta) => {

    alertify.prompt('Ingresa la cantidad a abonar', '', '0', function(evt, value) {
            abonar(folioVenta, value);
        }, function() { alertify.error('Cancel') })
        .set('type', 'number');
}

const abonar = (folio, quantity) => {
    const res = ajax('apartados/abonos', { folio: folio, cantidad: quantity });
    
    if (res == 1) { alertify.alert('Sistema', 'El registro exitoso', function() { window.location.reload(); }) } else if (res == 3) { alertify.alert('Sistema', 'La cuenta ha sido saldada', function() { window.location.reload(); }) } else { alertify.alert('Sistema', 'ha ocurrido un error al hace el registro', function() { window.location.reload(); }) }

}
const clearTables = () => {}

const showSpiner = () => {
    document.getElementsByClassName('spinner-border')[0].style.display = 'initial';
}

const hideSpiner = () => {
    document.getElementsByClassName('spinner-border')[0].style.display = 'none';
}


document.querySelector('#search-name').addEventListener('click', () => {
    $('#BuscaCliente').modal('show');
    //document.getElementsByClassName('spinner-border')[0].style.display = 'initial';  
});