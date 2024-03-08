// Inicialización de la tabla DataTable
var table;

$(document).ready(function () {
    // Configuración y creación de la tabla DataTable
    table = $("#tablaEmpleados").DataTable({
        dom: "prt",
        paging: false,
        autoWidth: false,
        scrollCollapse: true,
        scrollY: "30rem",
        fixedHeader: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
        },
    });

    // Filtro de búsqueda en tiempo real
    $("#inputField").on("keyup", function () {
        var valor = $(this).val().toLowerCase();
        table.search(valor).draw();
    });

    // Configuración de CSRF para AJAX
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Función para mostrar una alerta de éxito
    function showSuccessAlert(message) {
        // Configuración de la alerta de SweetAlert
        Swal.fire({
            icon: "success",
            title: "Éxito",
            text: message,
            showConfirmButton: true,
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6",
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // Recarga la página después de cerrar la alerta
                location.reload();
            }
        });
    }

    // Evento de clic para abrir el modal de creación de anexo
    $(document).on("click", "#createAnexo", function () {
        $("#anexo_id").val("");
        $("#empleadosForm").trigger("reset");
        $("#modalHeading").html("Agregar Anexo");
        $("#ajaxModel").modal("show");
    });

    // Evento de clic para guardar el formulario de creación de anexo mediante AJAX
    $("#saveBtn").click(function (e) {
        e.preventDefault();
        $(this).html("Guardar");

        var formData = $("#empleadosForm").serializeArray();
        formData.push({ name: "_token", value: "{{ csrf_token() }}" });

        // Envío de la solicitud AJAX para crear un nuevo anexo
        $.ajax({
            data: $("#empleadosForm").serialize(),
            url: "/auth/agregar_anexo",
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#empleadosForm").trigger("reset");
                $("#ajaxModel").modal("hide");
                table.draw();
                showSuccessAlert("Se ha creado el anexo exitosamente");
            },
            error: function (data) {
                console.log("Error", data);
                $("#saveBtn").html("Guardar");
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error al crear el anexo",
                });
            },
        });
    });

    // Evento de redimensionamiento de la ventana para ajustar las columnas de DataTable
    $(window).resize(function () {
        table.columns.adjust();
    });

    // Solicitud AJAX para obtener la lista de anexos al cargar la página
    $.ajax({
        url: "/auth/listar-anexo",
        type: "POST",
        dataType: "json",
        success: function (data) {
            actualizarTabla(data);
        },
    });

    // Función para actualizar la tabla con datos proporcionados por la solicitud AJAX
    function actualizarTabla(data) {
        var tableBody = $("#tablaEmpleados tbody");
        tableBody.empty();

        // Mapeo de datos para formar las filas de la tabla
        filasOriginales = data.map(function (anexo) {
            return [
                anexo.numeros_publicos,
                anexo.anexo,
                anexo.nombre_anexo,
                anexo.departamento,
                "<button class='btn me-2 btn-primary btn-sm editar-btn' data-id='" +
                    anexo.id +
                    "' data-number='" +
                    anexo.numeros_publicos +
                    "' data-anexo='" +
                    anexo.anexo +
                    "' data-name='" +
                    anexo.nombre_anexo +
                    "' data-departamento='" +
                    anexo.departamento +
                    "' data-bs-toggle='modal' data-bs-target='#editModal'>Editar</button>" +
                    "<button class='btn btn-danger btn-sm eliminar-btn' id='eliminarbtn' data-id='" +
                    anexo.id +
                    "' data-name='" +
                    anexo.nombre_anexo +
                    "' data-bs-toggle='modal' data-bs-target='#deleteModal'>Eliminar</button>",
            ];
        });

        table.rows.add(filasOriginales).draw();
    }

    // Evento de clic para abrir el modal de edición de anexo
    $(document).on("click", ".editar-btn", function () {
        var anexos_id = $(this).attr("data-id");
        var anexos_numeros = $(this).attr("data-number");
        var anexos_anexo = $(this).attr("data-anexo");
        var anexos_name = $(this).attr("data-name");
        var anexos_departamento = $(this).attr("data-departamento");

        // Asignación de valores a los campos del formulario de edición
        $("#anexo_numeros").val(anexos_numeros);
        $("#anexo_anexo").val(anexos_anexo);
        $("#anexo_name").val(anexos_name);
        $("#anexo_departamento").val(anexos_departamento);
        console.log("anexos_id:", anexos_id);
        $("#anexo_ids").val(anexos_id);
    });

    // Evento de envío del formulario de edición de anexo mediante AJAX
    $("#editAnexoForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: "http://buscador.test/auth/edit/anexo",
            data: formData,
            method: "POST",
            dataType: "json",
            beforeSend: function () {
                console.log(formData);
                $(".editButton").prop("disabled", true);
            },
            complete: function () {
                $(".editButton").prop("disabled", false);
            },
            success: function (data) {
                console.log(data);
                if (data.success == true) {
                    $("#editModal").modal("hide");
                    showSuccessAlert("Se ha editado el anexo exitosamente");
                } else if (data.success == false) {
                    printErrorMsg(data, "123");
                    console.log(data, "123");
                } else {
                    printValidationErrorMsg(data);
                    console.log(data);
                }
            },
        });
    });

    var anexoId;

    $(document).on("click", ".eliminar-btn", function () {
        var anexo_name = $(this).attr("data-name");
        anexoId = $(this).attr("data-id");
        $(".anexo_names").html("");
        $(".anexo_names").html(anexo_name);
    });

    $(document).on("click", ".deleteButton", function () {
        anexo_id = anexoId;
        console.log(anexo_id);
        var url = "http://buscador.test/auth/delete/anexo/" + anexo_id;
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".deleteButton").prop("disabled", true);
            },
            complete: function () {
                $(".deleteButton").prop("disabled", false);
            },
            success: function (data) {
                console.log("Respuesta del servidor:", data);
                if (data.success == true) {
                    showSuccessAlert("Se ha eliminado el anexo exitosamente");
                } else {
                    printErrorMsg(data.msg);
                }
            },
        });
    });
});
