
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
        var id = "";
        if (url.endsWith('tablets')) {
            sort = 'tablets';
            id = $('#Id').val();
        } else if (url.endsWith('raeume')) {
            sort = 'raeume';
            id = $('#Id').val();
        } else if (url.endsWith('firmas')) {
            sort = 'firmas';
            id = $('#Id').val();
        }


        $.ajax({
            url: "../server/ajaxPetition.php",
            data: {
                type: "delete",
                sort: sort,
                id: id,
            },
            type: "post",
            success: function (json) {
                console.log(json);
            },
            error: function (err) {
                console.log('Error: ' + err);
            }
        });
        setTimeout(() => location.replace(url), 500);
        ;
    });

    $('#update').click(function () {
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
                    type: "update",
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
            var id = $('#Id').val();
            var raeume = $('#Name').val();
            var idFirma = $('#Id_firma').val();
            $.ajax({
                url: "../server/ajaxPetition.php",
                data: {
                    type: "update",
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
            var id = $('#Id').val();
            var firma = $('#Firma').val();
            $.ajax({
                url: "../server/ajaxPetition.php",
                data: {
                    type: "update",
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

        setTimeout(() => location.replace(url), 500);

    });
});
