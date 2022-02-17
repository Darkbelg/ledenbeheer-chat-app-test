$(function (){
    var base_url = "http://localhost:8000";
    $('#chatMessage').hide();

    $("#chatSession").submit(function (e) {
        e.preventDefault();
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let email = $('#email').val();
        $.post(base_url + "/chatsessions.php",{ firstname: firstname, lastname: lastname, email: email})
            .done(function (data) {
                console.log('it works', data);
                if ( data.includes("id")) {
                    $("#chatSession").hide();
                    $('#chatMessage').show();
                };
            })
            .fail(function () {
                console.log('it doesn\'t work', );
            })
        });
});