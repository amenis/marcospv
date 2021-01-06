const setDataOnTable = (rows) => {

    rows.forEach(el => {

        $('#tbl-gastos tbody').append(`
            <tr>
                <td>${el.fecha}</td>
                <td>${el.empleado}</td>
                <td>${el.categoria}</td>
                <td>${el.descripcion}</td>
                <td>${el.cantidad}</td>
                <td>
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, 27px, 0px);">
                        <a class="dropdown-item" href="#" onclick="getExpense('${el.id_gastos}');" ><i class="fa fa-pencil-alt m-r-5"></i> Editar</a>
                        <a class="dropdown-item" href="#" onclick="deleteExpense('${el.id_gastos}')"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                    </div>
                </div>
                </td>
            </tr>
        `);
    });
}


const getExpense = (ref) => {
    let res = ajax('gastos/getExpense', { ref: ref });
    let jsonRes = JSON.parse(res);

    document.querySelector('#mod_ref').value = jsonRes[0].id_gastos;
    document.querySelector('#mod_date').value = jsonRes[0].fecha;
    document.querySelector('#mod_description').value = jsonRes[0].descripcion;
    document.querySelector('#mod_cantidad').value = jsonRes[0].cantidad;
    let mod_category = document.querySelectorAll('#mod_category > option');
    mod_category.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === jsonRes[0].id_categoria) { o[i].setAttribute('selected', 'true'); }
    });

    $('.bs-example-modal-lg-udp').modal('show');
}

const deleteExpense = (ref) => {
    alertify.confirm('Esta seguro que desea eliminar este gasto').set('onok', () => {
        let del = ajax('gastos/deleteExpense', { ref: ref });
        if (del) {
            alertify.notify('Gato Eliminado');
        } else {
            alertify.erro(del);
        }

    });
}

const searchBy = () => {
    const dateIn = document.querySelector('#date-in').value;
    const dateEnd = document.querySelector('#date-end').value;
    const cat = document.querySelector('#cat').value;
    const search = ajax('gastos/searchBy', { dateIn: dateIn, dateEnd: dateEnd, category: cat });
    let response = JSON.parse(search);
    cleanTable();
    setDataOnTable(response);
}



const saveExpense = () => {
    const inputs = $('#form-expense').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);
    }

    const saveExp = ajax('gastos/newExpense', formData);
    console.log(saveExp);
    if (saveExp === 1) alertyfy.notify('Guardado', 'success', 5);
    setTimeout(() => { window.location.reload(); }, 5000);
}

const cleanTable = () => {
    document.querySelector('#tbl-gastos tbody').innerHTML = "";
}

const updateExpense = () => {

    const inputs = $('#mod_form-expense').serialize();
    const entrada = inputs.split('&');
    const formData = new FormData();
    for (x = 0; x < entrada.length; x++) {
        let temp = entrada[x].split("=");
        let val = replaceAll(decodeURIComponent(temp[1].toString()), "+", " ");
        formData.append(temp[0], val);
    }

    const updateExp = ajax('gastos/updateExpense', formData);
    console.log(updateExp);
    if (updateExp === 1) alertyfy.notify('Guardado', 'success', 5);
    setTimeout(() => { window.location.reload(); }, 10);
};

window.onload = () => {
    //loadExpenses();
    $('#tbl-gastos').DataTable();
}