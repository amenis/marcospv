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

const buscarAbonos =  () => {
    $.post('../../../controladores/control_abonos.php',{accion: 'buscarAbono', clienteRef: $('#clientRef').val()}, function(data){
       let response = JSON.parse(data);
       sumaAbono(response);
       response.forEach(el => {
            document.querySelector('#tbody-abono').innerHTML = `
            <tr>
                <td>${el.fecha}</td>
                <td>${el.cantidad}</td>
                <td>${el.total}</td>
            </tr>
             `;
       });
    });
}

const sumaAbono = (elements) => {
    let suma = 0;
    elements.forEach(e => {
        suma = parseInt(suma + e.cantidad);
    })

    $('#total').html('<span>Total Abonado $ '+suma+'</span>');
}

const abonar = ()=> {
    $.post('../../../controladores/control_abonos.php',{accion: 'abonar'});
}