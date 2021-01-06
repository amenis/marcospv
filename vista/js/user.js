'use strict'

const newUser = () => {
    let formData = new FormData();
    let formInput = $('#newUser').serialize();
    let splitInput = formInput.split('&');
    let req;
    for (let index = 0; index < splitInput.length; index++) {
        let temp = splitInput[index].split('=');
        let value = replaceAll(decodeURIComponent(temp[1].toString()), '+', ' ');
        formData.append(temp[0], value);
    }
    req = ajax('Users/newUser', formData);
    if (req == 1) {
        alertify.notify('Datos Actualizados Correctamente', 'success', 5);
        setTimeout(() => {
            window.location.reload()
        }, 2000);
    } else {
        alertify.error(req);
    }
}

const getUser = (user) => {
    let usuario = ajax('Users/getUser', {
        ref: user
    });
    let inputJson = JSON.parse(usuario);
    document.getElementById('editnombre').value = inputJson[0].nombre;
    document.getElementById('editapellidos').value = inputJson[0].apellidos;
    document.getElementById('editdomicilio').value = inputJson[0].domicilio;
    document.getElementById('editciudad').value = inputJson[0].ciudad;
    document.getElementById('editcodigopostal').value = inputJson[0].codigopostal;
    document.getElementById('edittelefono').value = inputJson[0].telefono;
    document.getElementById('editusuario').value = inputJson[0].usuario;
    document.getElementById('editpassword').value = inputJson[0].password;
    let estado = document.querySelectorAll("#editestado > option");
    estado.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === inputJson[0].estado) {
            o[i].setAttribute('selected', true)
        };
    });
    let tipo = document.querySelectorAll("#edittipoUser > option");
    tipo.forEach((e, i, o) => {
        o[i].removeAttribute('selected');
        if (o[i].getAttribute('value') === inputJson[0].tipo_usuario) {
            o[i].setAttribute('selected', true)
        };
    });

    document.getElementById('btnEditUser').setAttribute('onclick', 'editUser(' + inputJson[0].id_empleado + ')');

    $("#edit_user").modal('show');
}

const baja = (user) => {

}

const editUser = (ref) => {
    let formData = new FormData();
    let formInput = $('#editUser').serialize();
    let splitInput = formInput.split('&');
    let req;
    for (let index = 0; index < splitInput.length; index++) {
        let temp = splitInput[index].split('=');
        let value = replaceAll(decodeURIComponent(temp[1].toString()), '+', ' ');
        formData.append(temp[0], value);
    }
    formData.append('ref', ref);
    const updated = ajax('Users/editUser', formData);
    if (updated == 1) {
        alertify.notify('Datos actualizados correctamente', 'success', 5);
        setTimeout(() => {
            window.location.reload();
        }, 3000);
    } else {
        alertify.error(updated);
    }
}

const deleteUser = (ref) => {
    alertify.confirm('Esta seguro que quieres dar de baja a este usuario').set('onok', () => {
        $.post('Users/deleteUser', { ref: ref }, req => {
            if (req == 1) {
                alertify.notify('Usuario dado de baja correctamente', 'success', 5);
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                alertify.error(req);
            }
        });
    });
}

const editarPerfil = ref => {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const edit = ajax('editPerfil', { username: username, password: password, ref: ref });
    console.log(edit);
    if (edit == 1) {
        alertify.notify('Datos actualizados correctamente', 'success', 5);
        setTimeout(() => { window.location.reload(); }, 3000)
    } else {
        alertify.error(edit);
    }
}