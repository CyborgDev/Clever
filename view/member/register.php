<div class="container-fluid">
    <h1>Inscription au forum</h1>
    <div class="container-fluid" id="alert_form"></div>
    <div class="container-fluid">
        <!--Formulaire d'inscription vérifié avec JavaScript-->
        <form action="index.php?page=member/register" method="POST" onsubmit="return checkInformations()">
           <div class="form-group" id="group_email">
               <label for="email"><span class="glyphicon glyphicon-alert"></span> Adresse mail:</label>
               <input type="email" class="form-control" name="email" id="email" placeholder="clever@clever.com">
           </div>
           <div class="form-group" id="group_pseudo">
               <label for="pseudo"><span class="glyphicon glyphicon-alert"></span> Pseudo:</label>
               <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Clever">
            </div>
            <div class="form-group" id="group_pwd">
                <label for="pwd"><span class="glyphicon glyphicon-alert"></span> Mot de passe:</label>
                <input type="password" class="form-control" name="password" id="pwd">
            </div>
            <div class="form-group" id="group_confirm_pwd">
                <label for="confirm_pwd"><span class="glyphicon glyphicon-alert"></span> Confirmez le mot de passe:</label>
                <input type="password" class="form-control" id="confirm_pwd">
            </div>
            <div class="form-group" id="group_discord">
                <label for="discord">Votre identifiant discord:</label>
                <input type="text" class="form-control" name="discord" id="discord" placeholder="Clever#1234">
            </div>
            <button type="submit" class="btn btn-lg btn-secondary">S'inscrire</button>
        </form>
    </div> 
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="http://localhost/Clever/webroot/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {

        // Dès le chargement on ajoute des listeners sur les champs pour vérifier qu'ils sont correctement entrés
        $("#email").keyup(function(){
                var textInput = $("#email").val();
                //console.log(textInput);
                if (validateEmail(textInput)){
                    $("#group_email").removeClass('form-group has-error has-success has-feedback');
                    $("#group_email").addClass('form-group has-success has-feedback');
                } else {
                    $("#group_email").removeClass('form-group has-error has-success has-feedback');
                    $("#group_email").addClass('form-group has-error has-feedback');
                }
            }
        );

        $("#pseudo").keyup(function(){
                var textInput = $("#pseudo").val();
                //console.log(textInput);
                if (validatePseudo(textInput)){
                    $("#group_pseudo").removeClass('form-group has-error has-success has-feedback');
                    $("#group_pseudo").addClass('form-group has-success has-feedback');
                } else {
                    $("#group_pseudo").removeClass('form-group has-error has-success has-feedback');
                    $("#group_pseudo").addClass('form-group has-error has-feedback');
                }
            }
        );

        $("#pwd").keyup(function(){
                var textInput = $("#pwd").val();
                //console.log(textInput);
                if (validatePwd(textInput)){
                    $("#group_pwd").removeClass('form-group has-error has-success has-feedback');
                    $("#group_pwd").addClass('form-group has-success has-feedback');
                } else {
                    $("#group_pwd").removeClass('form-group has-error has-success has-feedback');
                    $("#group_pwd").addClass('form-group has-error has-feedback');
                }
            }
        );

        $("#confirm_pwd").keyup(function(){
                var textInput = $("#confirm_pwd").val();
                //console.log(textInput);
                if (validateConfirmPwd(textInput)){
                    $("#group_confirm_pwd").removeClass('form-group has-error has-success has-feedback');
                    $("#group_confirm_pwd").addClass('form-group has-success has-feedback');
                } else {
                    $("#group_confirm_pwd").removeClass('form-group has-error has-success has-feedback');
                    $("#group_confirm_pwd").addClass('form-group has-error has-feedback');
                }
            }
        );

        $("#discord").keyup(function(){
                var textInput = $("#discord").val();
                //console.log(textInput);
                if (validateDiscord(textInput)){
                    $("#group_discord").removeClass('form-group has-error has-success has-feedback');
                    $("#group_discord").addClass('form-group has-success has-feedback');
                } else {
                    $("#group_discord").removeClass('form-group has-error has-success has-feedback');
                    $("#group_discord").addClass('form-group has-error has-feedback');
                }
            }
        );

    });

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(String(email).toLowerCase());
    };

    function validatePseudo(pseudo) {
        var re = /(\w|\'){3,45}$/;
        //console.log(re.test(String(pseudo)));
        return re.test(String(pseudo));
    };

    function validatePwd(pwd) {
        var re = /(\w|\'){6,45}$/;
        //console.log(re.test(String(pwd)));
        return re.test(String(pwd));
    };

    function validateConfirmPwd(pwd) {
        return $("#pwd").val() === pwd;
    };

    function validateDiscord(discord) {
        var re = /\S+#[0-9]{4}$/;
        return re.test(String(discord).toLowerCase());
    };  

    function checkInformations() {

        var email_ok = validateEmail($('#email').val());
        var pseudo_ok = validatePseudo($('#pseudo').val());
        var pwd_ok = validatePwd($('#pwd').val());
        var confirm_pwd_ok = validateConfirmPwd($('#confirm_pwd').val());

        if (!email_ok) {
            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>Votre adresse mail n'est pas conforme.</div>");
            return false;
        } else if (!pseudo_ok) {
            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>Votre pseudo est trop court.</div>");
            return false;
        } else if (!pwd_ok) {
            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>Votre mot de passe est trop court.</div>");
            return false;
        } else if (!confirm_pwd_ok) {
            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>Vous n'avez pas confirmé votre mot de passe.</div>");
            return false;
        } else {
            return true;
            /*// prépare la requête
            var xhr = new XMLHttpRequest();

            //Récupératon des données
            var email = $('#email').val(),
                pseudo = $('#pseudo').val(),
                pwd = $('#pwd').val(),
                discord = '';
            if ($('#discord').val() != '') {
                discord = $('#discord').val();
            }

            //Encodage des données
            var email_encoded = encodeURIComponent(email),
                pseudo_encoded = encodeURIComponent(pseudo),
                pwd_encoded = encodeURIComponent(pwd);
            if ($('#discord').val() != '') {
                discord = encodeURIComponent(discord);
            }

            //Préparation des paramètres
            var params = 'email=' + email_encoded + '&pseudo=' + pseudo_encoded + '&password=' + pwd_encoded;

            //Envoie des données au controller
            /**
            * NE PAS OUBLIER DE CHANGER L'ADRESSE DANS CE SCRIPT LORS DE LA RELEASE
            /
            xhr.open('POST', "http://localhost/Clever/controller/member/RegisterController.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            // Envoie la requête
            xhr.send(params);
            /*xhr.addEventListener('readystatechange', function () {
                    //Passage des constantes vers le script
                    var SUC_REGISTRATION = "<?php echo SUC_REGISTRATION; ?>",
                        ERR_DATA_NOT_TRANSMITTED = "<?php echo ERR_DATA_NOT_TRANSMITTED; ?>",
                        ERR_EMAIL_EXIST = "<?php echo ERR_EMAIL_EXIST; ?>",
                        ERR_PSEUDO_EXIST = "<?php echo ERR_PSEUDO_EXIST; ?>",
                        ERR_PWD_EXIST = "<?php echo ERR_PWD_EXIST; ?>";
                    
                    // Si le fichier est chargé sans erreur
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.response);
                        if(xhr.responseText === SUC_REGISTRATION){
                            $('#alert_form').html("<div class=\"alert alert-success alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Inscription réussie !</strong><br>Un mail vous a été envoyé, si vous n'avez rien reçu contactez un administrateur.</div>");
                        } else if (xhr.responseText === ERR_DATA_NOT_TRANSMITTED){
                            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>"+ xhr.responseText +"<br>Les vérifications n'ont pas fonctionné, contactez un administrateur pour qu'il règle le problème au plus vite.</div>");
                        } else if (xhr.responseText === ERR_EMAIL_EXIST){
                            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>"+ xhr.responseText +"</div>");
                            $("#group_email").removeClass('form-group has-error has-success has-feedback');
                            $("#group_email").addClass('form-group has-error has-feedback');
                        } else if (xhr.responseText === ERR_PSEUDO_EXIST){
                            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>"+ xhr.responseText +"</div>");
                            $("#group_pseudo").removeClass('form-group has-error has-success has-feedback');
                            $("#group_pseudo").addClass('form-group has-error has-feedback');                            
                        } else if (xhr.responseText === ERR_PWD_EXIST){
                            $('#alert_form').html("<div class=\"alert alert-danger alert-dismissible fade in\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Une erreur s'est produite !</strong><br>"+ xhr.responseText +"</div>");
                            $("#group_pwd").removeClass('form-group has-error has-success has-feedback');
                            $("#group_pwd").addClass('form-group has-error has-feedback');
                        }
                    }
                });*/
        }
    };
</script>