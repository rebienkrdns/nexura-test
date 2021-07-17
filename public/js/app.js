$(document).ready(() => {
    findData(0)
});

function findData(id) {
    Swal.showLoading();
    $.get(`${window.App.baseurl}/empleados/0`, {
        "_token": window.App.csrf
    }, function (data, status) {
        if (status == 'success') {
            var content = '';
            for (var i = 0; i < data.length; i++) {
                content += `<tr>
                    <td class="pt-3">${data[i].nombre}</td>
                    <td class="pt-3">${data[i].email}</td>
                    <td class="pt-3">${data[i].sexo == 'F' ? 'Femenino' : 'Masculino'}</td>
                    <td class="pt-3">${data[i].area}</td>
                    <td class="pt-3">${data[i].boletin > 0 ? 'Si' : 'No'}</td>
                    <td><button class="btn btn-light" onclick="modificarEmpleado(${data[i].id})"><i class="fas fa-edit"></i></button></td>
                    <td><button class="btn btn-light" onclick="borrarEmpleado(${data[i].id})"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>`;
            }
            $('table tbody').html(content);
        }
        Swal.close();
    });
}

function modificarEmpleado(id) {
    Swal.showLoading();
    $.get(`${window.App.baseurl}/empleados/${id}`, {
        "_token": window.App.csrf
    }, function (data, status) {
        if (status == 'success') {
            $('[name="id"]').val(id);
            $('[name="nombreM"]').val(data.empleado.nombre);
            $('[name="correoM"]').val(data.empleado.email);
            $('[name="sexoM"]').val(data.empleado.sexo);
            $('[name="areaM"]').val(data.empleado.area_id);
            $('[name="descripcionM"]').val(data.empleado.descripcion);
            $('[name="boletinM"]').attr('checked', data.empleado.boletin > 0);
            for (let i = 0; i < data.roles.length; i++) {
                $('[name="rol' + data.roles[i].rol_id + 'M"]').attr('checked', true);
            }
            $('#modificarEmpleado').modal('show');
        }
        Swal.close();
    });
}

function borrarEmpleado(id) {
    Swal.fire({
        title: '¿Confirma que desea borrar este empleado?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result["value"] == true) {
            Swal.showLoading();
            $.ajax({
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': window.App.csrf
                },
                url: `${window.App.baseurl}/empleados/${id}`,
                data: {},
                success: function (r) {
                    Swal.close();
                    Swal.fire({
                        title: 'Empleado borrado correctamente',
                        confirmButtonText: `Genial`,
                    }).then((result) => {
                        window.location.reload()
                    })
                }
            })
        }
    });
}
