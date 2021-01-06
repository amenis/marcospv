const search = function() {
    var clienteRef = document.querySelector('#txt-search').value;
    if (clienteRef == "") {
        $('#search-results').html('');
    } else {
        $.post('../../../controladores/control_clientes.php', {
            accion: 'buscarCliente',
            ref: clienteRef
        }, function(data) {
            $('#search-results').html('');
            dataRes = JSON.parse(data);

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
                        <td><button class="btn btn-primary" onclick="cargarCliente(this)">Agregar</button></td>
                    </tr>
                    `
                );
            });

        });
    }
}

const cargarCliente = (este) => {
    //console.log($(este).parent().parent().find('td'));
    $('#clientRef').val($(este).parent().parent().find('td').eq(0).html());
    $('#clientName').val($(este).parent().parent().find('td').eq(1).html());
    $('#address').val($(este).parent().parent().find('td').eq(2).html());
    $('#city').val($(este).parent().parent().find('td').eq(3).html());
    $('#state').val($(este).parent().parent().find('td').eq(4).html());
    $('#phoneNumber').val($(este).parent().parent().find('td').eq(5).html());

    $('#BuscaCliente').modal('hide');
    document.querySelector('#cargarDatos').removeAttribute('disabled');
}

const getAdeudo = (f) => {
    $.post('../../../controladores/control_abonos.php', {accion: 'verificarSaldo', folio:f }, function(res){
        let itemResponse = JSON.parse(res);
        let balance = 0;
        localStorage.setItem('folio',f);
        if(typeof itemResponse === 'object') {
            itemResponse.forEach(element => {
                balance = balance + parseInt(element.cantidad)            
            });
        }
        document.querySelector('#total').innerHTML = '<span> Total Abonado $ ' + balance + ' </span>' + '<span> Total Facturado $ ' + itemResponse[0].total + '</span>';
       console.log(itemResponse);
    });
    
}


const cargarAdeudo = () => {
    document.querySelector('#cargarDatos').setAttribute('disabled', 'true');
    document.querySelector('#abono').removeAttribute('disabled');
    document.querySelector('#saldar').removeAttribute('disabled');

    $.post('../../../controladores/control_apartados.php', {
        accion: 'buscarAdeudo',
        clienteRef: $('#clientRef').val()
    }, function(response) {
        let jsonResponse = JSON.parse(response);

        if (jsonResponse.length == 0) {
            alertify.alert('No se encontraron registros', function() {
                window.location.reload();
            });
            //document.querySelector('#abono').setAttribute('disabled', 'true');
            //document.querySelector('#saldar').setAttribute('disabled', true);
        }
        getAdeudo(jsonResponse[0].folio);
        
       
        document.querySelector('#fecha').innerHTML = jsonResponse[0].fecha;
        document.querySelector('#folioVenta').innerHTML = jsonResponse[0].folio;

        jsonResponse.forEach(items => {
            $('#tbodyDetails').append(
                `
               <tr>
                    <td>${items['folio']}</td>
                    <td>${items['fecha']}</td>
                    <td>${items['nombre_cliente']}</td>
                    <td>${items['descripcion']}</td>
                    <td>${items['cantidad']}</td>
                    <td>${items['total'] / items['cantidad']}</td>
                    <td>${items['descuento']}</td>
                    <td>${items['porcentaje']}</td>
                    <td>${items['total']}</td>
               </tr>
                `
            );
        });
    });

}



const guardarAbono = () => {
    $.ajax({
        url: '../../../controladores/control_abonos.php',
        type: 'POST',
        data: {
            folio: $('#folioVenta').html(),
            cantidad: $('#cantidadAbonada').val(),
            accion: 'guardarAbono'
        },
        success: function(data) {
            if (data == 1) {
                alertify.success('Guardado exitoso');
                window.location.reload();
            }
        }
    });
}


const saldarAdeudo = () => {
    $.post('../../../controladores/control_abonos.php', {accion: 'saldarSaldo', folio:localStorage.getItem('folio'), adeudo: localStorage.getItem('adeudo') }, function(r) {
        if(r == 'success'){
            alertify.alert('Venta Finalizada', function() {
                window.location.reload();
            });
            
        }
    });
}

const deshabilitaBotones = ()=> {
    
}


window.onload = function(){
    localStorage.clear();
}