    <div style="margin-top:50px"></div>
  </div>
</body>

<!-- Footer <div style="margin-top:50px"></div>  -->
<footer>
<div class="footer container-fluid">
    <?php
        $nb_member = $db->query('SELECT COUNT(*) FROM members')->fetchColumn();
        $last_member = $db->query('SELECT id, pseudo FROM members ORDER BY id DESC LIMIT 0, 1');
        $data = $last_member->fetch();
        $last_member = stripslashes(htmlspecialchars($data['pseudo']));
        $nb_post = $db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
        ?>
    <!-- Footer Elements -->
    <p>Nombre d'inscrits : <?php echo $nb_member; ?><br>
    Dernier inscrit : <?php echo $last_member; ?><br>
    Nombre de posts : <?php echo $nb_post; ?></p>
</div>
<!-- Copyright -->
<div class="footer-copyright text-center">
      Forum développé par Cyborg<br>
      © 2018 Copyright:<a href="http://localhost/Clever"> Clever.net</a>
    </div>
<!-- Copyright -->
</footer>

</html>