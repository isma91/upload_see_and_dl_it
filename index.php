<?php
require_once('controler.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Un site pour un certain Jordan Berfroi" />
	<title>Jordan's HomeWork</title>
	<link href='http://fonts.googleapis.com/css?family=Abel|Pacifico' rel='stylesheet' type='text/css'>
	<link media="all" type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="css/my_style.css" />
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div class="container">
		<?php
		if (!empty($erreur)) {
			echo $erreur;
		}
		if (!empty($success)) {
			echo $success;
		}
		?>
		<h1><a href="index.php" title="page accueil" id="titre">Jordan's HomeWork</a></h1>
		<div class="jumbotron">
			<form action="#" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" name="dossierName" placeholder="Nom du dossier que tu veut creer" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="validerDossier" value="Creer dossier" class="btn btn-primary form-control">
				</div>
			</form>
		</div>
		<div class="jumbotron">
			<form action="#" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="fichier" class="form-control">Selectionner le fichier que vous voulez uploader</label>
					<input type="file" name="fichier"  id="fichier" class="form-control">
				</div>
				<div class="form-group">
					<label class="form-control" for="dossier">Selectionner le dossier ou vous voulez le mettre</label>
					<select class="form-control" name="dossier" id="dossier">
						<?php
						for ($i=0; $i < count($dossiers); $i++) {
							if ($dossiers[$i] === false) {
								?>
								<option value="">Dans le dossier racine</option>
								<?php
							} else {
								?>
								<option value="<?php echo $dossiers[$i]; ?>"><?php echo $dossiers[$i]; ?></option>
								<?php
							}
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="validerFichier" value="Upload Fichier" class="btn btn-primary form-control">
				</div>
			</form>
		</div>
		<div class="jumbotron">
			<h2>Voici vos fichiers uploader :</h2>
			<h3>Cliquer sur le nom du fichier pour avoir le contenu du fichier directement sur le navigateur ou telecharger le !!</h3>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>Visualiser</th>
							<th>Telecharger</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($j=0; $j < count($files); $j++) {
							?>
							<tr>
								<td><a href="<?php echo $files[$j]; ?>"><?php echo $nameFiles[$j]; ?></a></td>
								<td><a href="<?php echo $files[$j]; ?>" download>Telecharger moi !!</a></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>