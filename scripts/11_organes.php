<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>code_4_groupes_supp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </head>
  <!--

  This script cleans the table 'organes' by keeping only rows from the last
  update (10_organes.php).

  -->
  <body>
    <?php
      $url = $_SERVER['REQUEST_URI'];
      $url = str_replace(array("/", "datan", "scripts", ".php"), "", $url);
      $url_current = substr($url, 0, 2);
      $url_next = $url_current + 1;
    ?>
		<div class="container" style="background-color: #e9ecef;">
			<div class="row">
				<h1>4-1. Suppression données bdd 'organes'</h1>
			</div>
			<div class="row">
				<div class="col-4">
					<a class="btn btn-outline-primary" href="./" role="button">Back</a>
				</div>
				<div class="col-4">
					<a class="btn btn-outline-secondary" href="http://<?php echo $_SERVER['SERVER_NAME']. ''.$_SERVER['REQUEST_URI'] ?>" role="button">Refresh</a>
				</div>
				<div class="col-4">
					<a class="btn btn-outline-success" href="./<?= $url_next ?>_organes.php" role="button">Next</a>
				</div>
			</div>
			<div class="row mt-3">
        <div class="col">
          <?php

  					//ini_set('memory_limit','500M');

  					$i=1;
  					$dateMaj = date('Y-m-d');
  					echo '<p>date ==>'.$dateMaj.'</p>';

  					// CONNEXION SQL //
  					include 'bdd-connexion.php';

            $reponse = $bdd->query('
            SELECT *
            FROM organes
            WHERE dateMaj < "'.$dateMaj.'" OR dateMaj IS NULL
            ');

            while ($data = $reponse->fetch()) {
              echo '<p>'.$i.'. '.$data['uid'].' ==> '.$data['libelle'].' '.$data['libelleAbrev'].'</p>';

              $i++;
            }

            if (isset($dateMaj)) {
              $bdd->exec('DELETE FROM organes WHERE dateMaj < "'.$dateMaj.'" OR dateMaj IS NULL');
              echo '<p>Données supprimées</p>';
            } else {
              echo '<p>Erreur</p>';
            }

  				?>
        </div>
      </div>
    </div>
  </body>
</html>