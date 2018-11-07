<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-left" href="./"><img src="webroot/pictures/Clever_logo_2.PNG" alt="Logo de Clever" class="logo-btn"></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php?page=index">Index</a></li>
    </ul>

    <?php
    if ($lvl === 1){
        echo '
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?page=member/register"><span class="glyphicon glyphicon-user"></span> S\'inscrire</a></li>
            <li><a href="index.php?page=member/login"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
        </ul>';
    } elseif ($lvl === 2){
            echo '
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Liste des membres</a></li>
                    <li><a href="index.php?page=member/profil">Profil</a></li>
					<li><a href="index.php?page=member/disconnect">Déconnexion</a></li>
                </ul>';
    } elseif ($lvl === 3){
        echo '
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php?page=member/list">Liste de membres</a></li>
                <li><a href="#">Modération</a></li>
                <li><a href="index.php?page=member/profil">Profil</a></li>
				<li><a href="index.php?page=member/disconnect">Déconnexion</a></li>
            </ul>';
    }
     ?>
  </div>
</nav>
<div style="margin-top:50px"></div>