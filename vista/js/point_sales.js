let productQuantity = 1;

const searchByCode = function(este) {
    const barcode = $(este).val();

    $.post('ventas/searchProduct', { item: barcode }, function(data) {
        let items = JSON.parse(data);
        document.querySelector('#articulo').value = items[0].codigo;
        document.querySelector('#description').value = items[0].descripcion;
        document.querySelector('#price').value = items[0].precio;

    });
}


const busca_producto = function(este) {
    const item = $(este).val();

    if (item == "" || item == null) {
        $('#search-results').html(
            `
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            `
        );
    } else {

        $.post('ventas/searchProduct', { item: item }, function(data) {
            let items = JSON.parse(data);

            $('#search-results').html('');
            items.forEach(e => {

                $('#search-results').append(
                    `
                        <tr>
                            <td>${e.codigo}</td>
                            <td>${e.descripcion}</td>
                            <td>${e.precio}</td>
                            <td><button class="btn btn-primary" onClick="add_art($(this))">Agregar</button></td>
                        </tr>
                    `
                );
            });
        });
    }
    $(este).val('');
}

const add_art = (este) => {
    let codigo = este.parent().parent().find('td').eq(0).html();
    let description = este.parent().parent().find('td').eq(1).html();
    let price = parseInt(este.parent().parent().find('td').eq(2).html());
    document.querySelector('#articulo').value = codigo;
    document.querySelector('#description').value = description;
    document.querySelector('#price').value = price;
    $('#modalSearchProduct').modal('hide');

}

const addToList = function(este) {
    // console.log(este.parent().parent().find('td').eq(1).html());
    let codigo = document.querySelector('#articulo').value;
    let des = document.querySelector('#description').value;
    let price = document.querySelector('#price').value;
    let quantity = document.querySelector('#quantity').value;
    let total = 0;
    if (quantity <= 0) {
        alertify.alert('SISTEMA', 'La cantidad no puede estar en 0');
    } else {
        total = quantity * price;

        $('#tbody-ventas').append(
            `
                <tr>
                    <td>${productQuantity}</td>
                    <td>${codigo}</td>
                    <td>${des}</td>
                    <td>${price}</td>
                    <td contenteditable onkeypress="change_total($(this))">${quantity}</td>
                    <td>${total}</td>
                    <td><button class="btn btn-block btn-danger btn-sm" onclick="quit($(this))"> Eliminar</button></td>
                </tr> 
                
                `
        );
        total_amount_payable();

        productQuantity += 1;
    }
    cancel_art();
}

const quit = (este) => {
    const parent = este.parents().parents().get(0);
    $(parent).remove();
    total_amount_payable();
}

const change_total = (este) => {
    //console.log(este.parent().find('td').eq(3).html());
    total = parseInt(este.parent().find('td').eq(4).html()) * parseInt(este.parent().find('td').eq(3).html());
    este.parent().find('td').eq(5).html(total);
    total_amount_payable();
    //cash_discount();
}

const total_amount_payable = () => {
    let arrtotal = new Array();
    let total = 0;
    $('#tbl-ventas > tbody > tr ').each(function() {
        arrtotal.push(parseInt($(this).find('td').eq(5).html()));
    });

    total = arrtotal.reduce((a, b) => a + b);

    $('#total_articulos').html(arrtotal.length);
    $('#total').html(total + '.00');
    $('#total_de_venta').val(total + '.00');
    $('#subtotal').val(total + '.00');
    $('#paga_con').val(total);
    calcula_cambio();

}

const cash_discount = () => {
    let descuento = parseInt($('#descuento').val());
    let subtotal = parseInt($('#total').html());
    let base = descuento / 100;
    let total = subtotal * base;
    $('#total').html($('#total').html() - total);
}

const calcula_cambio = () => {
    const m1 = parseFloat($('#total_de_venta').val());
    const m2 = parseFloat($('#paga_con').val());
    const c1 = m2 - m1;
    $('#el_cambio').val(c1.toFixed(2));
}

const endingSale = () => {
    let total_amount = $('#total').html();
    $('#modalFinalizarVenta').modal('show');
    $('#total_de_venta').val(total_amount);
    if ($('#cliente').val() === 1) {
        $('#btn-credit').attr('disabled');
    }
}

const process_credit = () => {
    process_sale();
    procces_details();
    setTimeout(async function() {
        await $.ajax({
            url: '../../../controladores/control_ventas.php',
            type: 'POST',
            data: { accion: 'credit' },
            success: function(d) {
                console.log(d);
            }
        });
    }, 2000);
}

const process_sale = type => {

    let arrayV = [{

        'ventas': {
            'descuento': $('#descuento').val() > 0 ? 'si' : 'no',
            'porcentaje': $('#descuento').val(),
            'total': $('#total').html(),
            'cliente': $('#cliente').val(),
            'tipoVenta': type,
            'pago': $('#paga_con').val()
        },
        'detalle': []


    }];

    $('#tbl-ventas > tbody > tr ').each(function(index) {
        let codigo = $(this).find('td').eq(1).html();
        let descripcion = $(this).find('td').eq(2).html();
        let cantidad = $(this).find('td').eq(4).html();
        let precio_u = $(this).find('td').eq(3).html();
        let total = $(this).find('td').eq(5).html();


        arrayV[0].detalle.push(
            [{
                    'codigo': codigo
                },
                {
                    'descripcion': descripcion
                },
                {
                    'cantidad': cantidad
                },
                {
                    'precio_u': precio_u
                },
                {
                    'total': total
                }
            ]
        );
    });

    const result = ajax('ventas/sale', {
        datos: JSON.stringify(arrayV[0])
    });
    
    if (result == true) {
        alertify.notify('Venta Realizada con exito', 'success', 5);
        print_ticket();
        setTimeout(() => { window.location.reload(); }, 6000);
    }


}
const cancela_venta = function() {
    $('#tbl-ventas > tbody').html('');
}



const cancel_art = () => {
    document.querySelector('#articulo').value = '';
    document.querySelector('#description').value = '';
    document.querySelector('#price').value = 0;
    document.querySelector('#quantity').value = 0;
}

const print_ticket = () => {
    let res = ajax('ventas/fill_ticket', { });
    console.log(res);
    $('#btn-ticket').printPage({
        url: "ticket.txt",
        attr: "href",
        message: "Generando vista previa del ticket.."
    });
    $('#btn-ticket').click();
}


const cleanModal = function() {
    $("#search input").val("");
    $('#search-results').html("");
};