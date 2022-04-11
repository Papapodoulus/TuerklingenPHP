
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
        $.ajax({
            url: "../server/ajaxPetition.php",
            data: {
                type: "delete",
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