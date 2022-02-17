$(function (){
    var base_url = "http://localhost:8000";
    var session;
    $('#chatMessage').hide();

    //create session
    $("#chatSession").submit(function (e) {
        e.preventDefault();
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let email = $('#email').val();
        $.post(base_url + "/chatsessions.php",{ firstname: firstname, lastname: lastname, email: email})
            .done(function (data) {
                console.log('it works', data);
                if ( data.includes("id")) {
                    session = JSON.parse(data);
                    $("#chatSession").hide();
                    $('#chatMessage').show();
                };

                if ( data.includes("error")){
                    $("#chatSession").before("<p class='error'>" + data["error"] + "</p>");
                }
            })
            .fail(function () {
                $("#chatSession").before("<p class='error'>Something went wrong starting the session.</p>");
                console.log('it doesn\'t work', );
            })
        });

    // send message
    $("#chatMessage").submit(function (e) {
        e.preventDefault();
        let message = $('#chatTextMessage').val();
        $("#chatMessage").before("<p><span>" + session.firstname + ":</span>" + message + "</p>");
        $.post(base_url + "/chatmessages.php",{ message: message, chatsessionid: session.id })
            .done(function (data) {
                console.log('it works', data);
                $('#chatTextMessage').val("");
                if ( data.includes("error")){
                    $("#chatMessage").before("<p class='error'>" + data["error"] + "</p><hr>");
                };
            })
            .fail(function () {
                $("#chatMessage").before("<p class='error'>Something went wrong sending the message.</p>");
                console.log('it doesn\'t work', );
            })
    });
});