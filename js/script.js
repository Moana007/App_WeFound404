$(document).ready(function() {
    $('#form_newsletter').on('submit', function() {
        var mail = $('#newsl_mail').val();

        if(isEmail(mail) === false){
            // $('.error-msg').remove();
            $(".msg_error1").append("<p>Veuillez renseigner un email valide.</p>");
            //alert("Probléme mails");
            return false;
        }
            $("#form_newsletter").hide();
            $(".msg_succes").append("<p style='font-weight:bold;'>Vous etes bien inscrit a la newsletter</p>");
	});
});

function isEmail(email) {
     if ( ( email.indexOf("@") == -1 ) ||
      ( email.indexOf("@") === 0 ) ||
      ( email.indexOf("@") != email.lastIndexOf("@") ) ||
      ( email.indexOf(".") == email.indexOf("@") - 1 ) ||
      ( email.indexOf(".") == email.indexOf("@") + 1 ) ||
      ( email.indexOf("@") == email.length -1 ) ||
      ( email.indexOf (".") == - 1 ) ||
      ( email.lastIndexOf (".") == email.length - 1 ) )
         return false;
      else
         return true;
}
