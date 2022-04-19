
window.addEventListener('load', () => {

    $(".boton").click(function () {
        var values = [];
        var thvalues = [];
        for (var i = 0; i < ($(this).parents("tr").find("td").length) - 1; i++) {
            values.push($(this).parents("tr").find("td")[i].innerHTML)
        }

        for (var i = 0; i < ($("#trhead").find("th").length) - 1; i++) {
            thvalues.push($("#trhead").find("th")[i].innerHTML)
        }

        for (var i = 0; i < thvalues.length; i++) {
            $('#' + thvalues[i]).val(values[i]);
        }

        $('#info').show();
    });


    $('#delete').click(function () {
        var url = window.location.href;
        var sort = "";
        if (url.endsWith('tablets')) {
            sort = 'tablets';
            var id = $('#Id').val();
            var tablet = $('#Tablet').val();
            var raum = $('#Raum').val();
            $.ajax({
                url: "../server/ajaxPetition.php",
                data: {
                    type: "delete",
                    sort: sort,
                    id: id,
                    tablet: tablet,
                    raum: raum

                },
                type: "post",
                success: function (json) {
                    console.log(json);
                },
                error: function (err) {
                    console.log('Error: ' + err);
                }
            });
        } else if (url.endsWith('raeume')) {
            sort = 'raeume';
            var id = $('#ID').val();
            var raeume = $('#Name').val();
            var idFirma = $('#Id_firma').val();
            $.ajax({
                url: "../server/ajaxPetition.php",
                data: {
                    type: "delete",
                    sort: sort,
                    id: id,
                    raeume: raeume,
                    idFirma: idFirma

                },
                type: "post",
                success: function (json) {
                    console.log(json);
                },
                error: function (err) {
                    console.log('Error: ' + err);
                }
            });

        } else if (url.endsWith('firmas')) {
            sort = 'firmas';
            var id = $('#ID').val();
            var firma = $('#Firma').val();
            $.ajax({
                url: "../server/ajaxPetition.php",
                data: {
                    type: "delete",
                    sort: sort,
                    id: id,
                    firma: firma,
                },
                type: "post",
                success: function (json) {
                    console.log(json);
                },
                error: function (err) {
                    console.log('Error: ' + err);
                }
            });
        }


    });

    $('#alter').click(function () {
        $.ajax({
            url: "../server/ajaxPetition.php",
            data: {
                type: "alter",
            },
            type: "post",
            success: function (json) {
                console.log(json);
            },
            error: function (err) {
                console.log('Error: ' + err);
            }
        });
    });
});