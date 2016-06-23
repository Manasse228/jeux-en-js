function clearSucessMessage(id) {
    $("#".id).html("");
}


setTimeout(function () {
    $(".flash").fadeOut("slow", function () {
        $(".flash").remove();
    });
}, 2000);

function alertBorder(id){
    console.log("id "+id);
    $("#" + id).css("border-color", "#AA0000");
}

function check(name, id, idmessage, file, sucesssms, failsms) {

    if (document.getElementById(id).value == "") {
        clearSucessMessage(idmessage);
    } else {
        $("#" + idmessage).html("<img src='images/loader.gif' /> checking...");
        $.ajax({
            type: "post",
            url: file + ".php",
            data: '' + name + '=' + $("#" + id).val(),
            success: function (data) {
                if (data == 0) {
                    $("#" + idmessage).html("<img src='images/tick.gif' /> " + sucesssms);
                    $("#" + idmessage).show().delay(5000).queue(function (n) {
                        $("#" + idmessage).html("<p></p>");
                        n();
                    });
                    $("#" + id).css("border-color", "");
                } else {
                    $("#" + idmessage).html("<img src='images/cross.png' /> " + failsms);
                    $("#" + idmessage).show().delay(5000).queue(function (n) {
                        $("#" + idmessage).html("<p></p>");
                        n();
                    });
                    $("#" + id).css("border-color", "#AA0000");
                }
            }
        });
    }
}

function verifSaisie(champ1, champ2, idmsg) {
    var val1 = document.getElementById(champ1).value;
    var val2 = document.getElementById(champ2).value;

    if ((val1 != val2) && (val1 != "") && (val2 != "")) {
        $("#" + champ1).css("border-color", "#AA0000");
        $("#" + champ2).css("border-color", "#AA0000");
        document.getElementById(idmsg).innerHTML = "Les deux mots de passe sont differents";
        document.getElementById(champ1).value = "";
        document.getElementById(champ2).value = "";
        document.getElementById(champ1).focus();
    } else {
        if ($("#" + champ1).css("border-color"))

            $("#" + champ1).css("border-color", "");
        $("#" + champ2).css("border-color", "");
        $("#" + champ1).css("border-color", "");
        document.getElementById(idmsg).innerHTML = "";
    }
}


function checkmail(name, id, idmessage, file, sucesssms, failsms) {
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    var email = document.getElementById("idEmail").value;

    if (reg.test(email)) {
        check(name, id, idmessage, file, sucesssms, failsms);
       // return (true);
    }else {
        $("#" + idmessage).html("<img src='images/cross.png' /> " + 'Format de l\'adresse email incorrect');
        $("#" + idmessage).show().delay(5000).queue(function (n) {
            $("#" + idmessage).html("<p></p>");
            n();
        });
        $("#" + id).css("border-color", "#AA0000");
      //  return (false);
    }
}


