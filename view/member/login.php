<div class="container-fluid">
    <h1>Connexion au Domaine</h1>
    <div class="container-fluid" id="alert_form"></div>
    <div class="container-fluid">
        <!-- Formulaire de connexion -->
        <form action="index.php?page=member/login" method="POST">
           <div class="form-group" id="group_pseudo">
               <label for="pseudo"><span class="glyphicon glyphicon-alert"></span> Pseudo:</label>
               <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Clever">
            </div>
            <div class="form-group" id="group_pwd">
                <label for="pwd"><span class="glyphicon glyphicon-alert"></span> Mot de passe:</label>
                <input type="password" class="form-control" name="password" id="pwd">
				<a href="#">Mot de passe oubli&eacute; ?</a>
            </div>
            <button type="submit" class="btn btn-lg btn-secondary">Se connecter</button>
        </form>
    </div> 
</div>