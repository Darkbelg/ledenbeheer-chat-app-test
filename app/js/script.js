$(function () {
    var base_url = "http://localhost:8000";
    var session;
    $('#chatMessage').hide();

    $.get(base_url + "?q=chatsessions")
        .done(function (data) {
            results =  JSON.parse(data);
            console.log(results);
            let rows = "<div>";
            for (let i = 0; i < results.length; i++) {
                 rows = rows +
                     "<a class='row' href='" +
                     base_url + "?q=chatmessages&chatsessionid=" + results[i].id +
                     "'> firstname= " +
                     results[i].firstname +
                     " lastname= " +
                     results[i].lastname +
                     " email=" +
                     results[i].email +
                     "</a>";
             }
            rows = rows + "</div>";
            $("#allSessions").html(rows);
        });

    //create session
    $("#chatSession").submit(function (e) {
        e.preventDefault();
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let email = $('#email').val();
        $.post(base_url + "?q=chatsessions", {firstname: firstname, lastname: lastname, email: email})
            .done(function (data) {
                console.log('it works', data);
                if (data.includes("id")) {
                    session = JSON.parse(data);
                    $("#chatSession").hide();
                    $('#chatMessage').show();

                    $.get(base_url + "?q=chatmessages",{ chatsessionid: session.id})
                        .done(function (data) {
                            results = JSON.parse(data);
                            for (let i = 0; i < results.length; i++) {
                                $("#chatMessage").before("<p><span>" + session.firstname + ":</span>" + results[i].message + "</p>");
                            };
                        });
                };

                if (data.includes("error")) {
                    $("#chatSession").before("<p class='error'>" + data["error"] + "</p>");
                }
            })
            .fail(function () {
                $("#chatSession").before("<p class='error'>Something went wrong starting the session.</p>");
                console.log('it doesn\'t work',);
            })
    });

    // send message
    $("#chatMessage").submit(function (e) {
        e.preventDefault();
        let message = $('#chatTextMessage').val();
        $("#chatMessage").before("<p><span>" + session.firstname + ":</span>" + message + "</p>");
        $.post(base_url + "?q=chatmessages", {message: message, chatsessionid: session.id})
            .done(function (data) {
                console.log('it works', data);
                $('#chatTextMessage').val("");
                if (data.includes("error")) {
                    $("#chatMessage").before("<p class='error'>" + data["error"] + "</p><hr>");
                }
                ;
            })
            .fail(function () {
                $("#chatMessage").before("<p class='error'>Something went wrong sending the message.</p>");
                console.log('it doesn\'t work',);
            })
    });
});