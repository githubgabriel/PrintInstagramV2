$(function() {

    $("input[name=set_hashtag]").change(function() {
        var hashtag = $("input[name=set_hashtag]").val();
        $.ajax({
            type: 'GET',
            url: 'index.php',
            data: {
                set_hashtag: hashtag
            },beforeSend: function() {

                $("#configure_hashtag #desc").html("Verificando quantidade de registros...");
                $("#configure_hashtag #desc").css("color","gray");

            },success: function(data) {
                $("#configure_hashtag #desc").html(data);
                $("#configure_hashtag #desc").css("color","green");
            }
        });

    });

});