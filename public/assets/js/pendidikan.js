$(document).ready(function () {
    $("#asal_jurusan_id").change(function () {
        if ($(this).val() == "") {
            $("#jurusan_id").attr("disabled", true);
        } else {
            $("#jurusan_id").removeAttr("disabled", false);
        }

        var asalJurusanId = $(this).val();
        $.ajax({
            url: getJurusansRoute,
            type: "GET",
            data: {
                asal_jurusan_id: asalJurusanId,
            },
            success: function (response) {
                $("#jurusan_id").html('<option value="">Jurusan</option>');
                $.each(response.jurusans, function (key, jurusan) {
                    $("#jurusan_id").append(
                        '<option value="' +
                            jurusan.id +
                            '">' +
                            jurusan.jurusan +
                            "</option>"
                    );
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});

if (selectAsalJurusanId != null) {
    if ($("#asal_jurusan_id").val() != null && status == true) {
        $("#asal_jurusan_id").removeAttr("disabled", true);
    }
    var idAsalJurusanSelected = $("#asal_jurusan_id").val();
    $.ajax({
        url: "/load-filter-jurusan",
        method: "POST",
        data: {
            id: idAsalJurusanSelected,
            _token: "{{ csrf_token() }}",
        },
        dataType: "json",
        success: function (response) {
            $("#jurusan_id").empty();
            $("#jurusan_id").append("<option>Jurusan</option>");

            $.each(response["jurusans"], function (key, value) {
                var option =
                    '<option value="' +
                    value.id +
                    '">' +
                    value.jurusan +
                    "</option>";
                $("#jurusan_id").append(option);
            });
            $("#jurusan_id").val(selectJurusan);
        },
    });
}

$(document).ready(function () {
    $("#jurusan_id").change(function () {
        if ($(this).val() == "") {
            $("#prodi_id").attr("disabled", true);
        } else {
            $("#prodi_id").removeAttr("disabled", false);
        }

        var jurusanId = $(this).val();
        $.ajax({
            url: getProdisRoute,
            type: "GET",
            data: {
                jurusan_id: jurusanId,
            },
            success: function (response) {
                $("#prodi_id").html('<option value="">Program Studi</option>');
                $.each(response.prodis, function (key, prodi) {
                    $("#prodi_id").append(
                        '<option value="' +
                            prodi.id +
                            '">' +
                            prodi.prodi +
                            "</option>"
                    );
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});

if (selectJurusanId != null) {
    if ($("#jurusan_id").val() != null && status == true) {
        $("#jurusan_id").removeAttr("disabled", true);
    }
    var idJurusanSelected = selectJurusan;
    $.ajax({
        url: "/load-filter-prodi",
        method: "POST",
        data: {
            id: idJurusanSelected,
            _token: "{{ csrf_token() }}",
        },
        dataType: "json",
        success: function (response) {
            $("#prodi_id").empty();
            $("#prodi_id").append("<option>Program Studi</option>");

            $.each(response["prodis"], function (key, value) {
                var option =
                    '<option value="' +
                    value.id +
                    '">' +
                    value.prodi +
                    "</option>";
                $("#prodi_id").append(option);
            });
            $("#prodi_id").val(selectProdi);
        },
    });
}
