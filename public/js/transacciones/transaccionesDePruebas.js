var hayError;

$(document).ready(function ()
{
    //AGREGAR
        $('#agregarForm').on('submit', function(ev)
        {
            ev.preventDefault();
            $.ajax
            ({
                type: "POST",
                url: "/pruebas/registrar",
                data: $('#agregarForm').serialize(),
                success: function (response)
                {
                    console.log(response)
                    $('#agregarForm')[0].reset()
                    Alerta("HUMAcheck", "¡Datos del Análisis registrados exitosamente!", "success", "OK")
                },
                error: function(error)
                {
                    console.log(error)
                    Alerta("¡Error al registrar!", "Verifique que: \n\nEl código del análisis NO se encuentre previamente registrado." + "\nO bien, que todos los campos solicitados estén completos y en el formato adecuado.\n¡Inténtelo nuevamente!", "warning", "OK")
                }
            });
        });
    //FIN DE AGREGAR

    
    //ACTUALIZAR
        $('.btnEditar').on('click', function(ev)
        {
            ev.preventDefault();
            $('#editarPrueba').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function()
            {
                return $(this).text();
            }).get();
            console.log(data);
            $('#idEditar').val(data[0]);
            $('#codigoDelAnalisis3').val(data[0]);
            $('#nombreDelAnalisis3').val(data[1]);
            $('#categoria3').val(data[2]);
            $('#descripcionDelAnalisis3').val(data[3]);
            $('#costoDelAnalisis3').val(data[4]);
            $('#descuentoDelAnalisis3').val(data[5]);
        });

        $('#editarPrueba').on('submit', function(e)
        {
            e.preventDefault();
            var id = $('#idEditar').val();
            $.ajax
            ({
                type: "PUT",
                url: "/pruebas/"+id,
                data: $('#editarForm').serialize(),
                success: function (response)
                {
                    console.log(response)
                    $('#agregarForm')[0].reset()
                    Alerta("HUMAcheck", "¡Datos del Análisis actualizados correctamente!", "success", "OK")
                },
                error: function(error)
                {
                    console.log(error)
                    Alerta("¡Error al actualizar registro!", "Verifique que: \n\nTodos los campos solicitados estén completos y en el formato adecuado.\n¡Inténtelo nuevamente!", "warning", "OK")
                }
            });
        });
    //FIN DE ACTUALIZAR



    //ELIMINAR
        $('.btnEliminar').on('click', function(ev)
        {
            ev.preventDefault();
            $('#eliminarPrueba').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function()
            {
                return $(this).text();
            }).get();
            console.log(data);
            $('#idEliminar').val(data[0]);
            $('#codigoDelAnalisis4').val(data[0]);
            $('#nombreDelAnalisis4').val(data[1]);
            $('#costoDelAnalisis4').val(data[4]);
        });
        $('#eliminarForm').on('submit', function(e)
    {
        e.preventDefault();
        var id = $('#idEliminar').val();

        Swal.fire
        ({
            title: '¿Desea eliminar este registro?',
            text: "¡Los cambios no serán revertibles una vez sea eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!'
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.ajax
                ({
                    type: "DELETE",
                    url: "/pruebas/"+id,
                    data: $('#eliminarForm').serialize(),
                    success: function (response)
                    {
                        console.log(response);
                        $('#eliminarEmpresa').modal('hide');
                        Alerta("HUMAcheck", "¡Registro eliminado correctamente!", "success", "OK")
                    },
                    error: function(error)
                    {
                        console.log(error)
                        Alerta("¡Error al eliminar registro!", "\n\n¡Inténtelo nuevamente!", "warning", "OK")
                    }
                    
                });
            }else
            {
                Swal.fire({
                    title: 'Cancelado',
                    text: '¡El proceso fue cancelado y el registro no sufrió cambios!',
                    icon: 'error',
                }).then((result) => 
                {
                    window.location.href = "/pruebas";
                })
            }
        })
    });
    //FIN DE ELIMINAR




    
    //FUNCIONES DE Alerta
        function Alerta(titulo, mensaje, tipo, boton)
        {
            setTimeout(function () 
            {
                swal
                ({
                    title: titulo,
                    text: mensaje,
                    type: tipo,
                    confirmButtonText: boton
                },
                function(isConfirm)
                {
                    if(tipo == "success")
                    {
                        if (isConfirm) 
                        {
                            window.location.href = "/pruebas";
                        }
                    }
                }); 
            }, 000);
        }
    //FIN DE FUNCIONES DE Alerta
    
});
