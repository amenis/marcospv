const change_type = () => {
    const selecType = document.querySelector('#type').value;
    if (selecType === 'fechas') {
        document.querySelector('#byDates').style.display = 'inline';
        document.querySelector('#ByNumber').style.display = 'none';
    } else {
        document.querySelector('#byDates').style.display = 'none';
        document.querySelector('#ByNumber').style.display = 'inline';
    }
}

const searchByDate = async() => {
    cleanTable();
    const dateIn = document.getElementById('date-in').value;
    const dateEnd = document.getElementById('date-end').value;
    const request = await JSON.parse(ajax('cancelaVentas/searchByDate', { dateIn: dateIn, dateEnd: dateEnd }));
    console.log(request);
    request.forEach((e) => {
        $('#table-ventasCancel > tbody').append(
            `
            <tr>
                <td>${e.fecha}</td>
                <td>${e.folio}</td>
                <td>${e.total}</td>    
                <td>${e.tipoVenta}</td>           
                <td> <button class="btn btn-danger btn-sm btn-block" onclick="cancelSell(${e.folio})" disabled = " ${e.status == 0} ? true : false" >cancelar</button> </td>
                <td> <button class="btn ${ e.status==0 ? 'btn-success' : 'btn-warning' } btn-block btn-sm disabled"> ${ e.status==0 ? 'Activa' : 'Cancelada' }</button>  </td>
            </tr>                    
            `
        );
    });
}


const searchTicket = () => {
    cleanTable()
    let ticketNumber = document.getElementById('ticket').value;
    $.post('cancelaVentas/ticketNumber', { folio: ticketNumber }, (req) => {

        JSON.parse(req).forEach((e) => {
            $('#table-ventasCancel > tbody').append(
                `
                <tr>
                    <td>${e.fecha}</td>
                    <td>${e.folio}</td>
                    <td>${e.total}</td>
                    <td>${e.tipoVenta}</td>
                    <td> <button class="btn btn-danger btn-sm btn-block" onclick="cancelSell(${e.folio})" disabled = " ${e.status == 0} ? true : false"  >cancelar</button> </td>
                    <td> <button class="btn ${ e.status== 0 ? 'btn-success' : 'btn-warning' } btn-block btn-sm disabled"> ${ e.status== 0 ? 'Activa' : 'Cancelada' }</button>  </td>
                </tr>                    
                `
            );
        });

    });
}

const cancelSell = (folio) => {
    alertify.confirm('Esta seguro que quiere cancelar la venta').set('onok', () => {
        let cancelada = ajax('cancelaVentas/cancela', { folio: folio });
        if (cancelada == 1) {
            alertify.notify('Venta Cancelada', 'success');
            setTimeout(() => { window.location.reload() }, 2000);
        } else {
            alertify.error(cancelada);
        }
    });
}

const cleanTable = () => {
    $('#table-ventasCancel > tbody').html('');
}