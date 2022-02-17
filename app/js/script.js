$(function (){
    var base_url = "http://localhost:8000";
    $.get(base_url + "?q=moderators",function(data,status){
        //alert("Data: " + data + "\nStatus: " + status);
    });

    $("#chatSession").click(function (e) {
        e.preventDefault();
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let email = $('#email').val();
        $.post(base_url + "/chatsessions.php",{ firstname: firstname, lastname: lastname, email: email})
            .done(function (data) {
                console.log('it works', data);
                if (  data.includes("id")) {
                    $("#chatSession").hide();
                };
            })
            .fail(function () {
                console.log('it doesn\'t work', );
            })
        // $.ajax({
        //     url: base_url + "/chatsessions",
        //     headers: {'Access-Control-Allow-Origin':'*'},
        // })
        // .done(function (data){
        //         console.log('done');
        //     alert( "Data Loaded: " + data );
        // })
        // .fail(function (data) {
        //     console.log('failed', data);
        //     //alert( "Data Loaded: " + data );
        // });
        // $.get(base_url + "?q=chatsessions", { firstname: "Stijn" , lastname: "Sagaert", email: "stijn.sagaert@outlook.com"},function(data,status){
        //     console.log("Data: " , data);
        //     console.log("Status: " , status);
        // });
    });
});