<?php
$erreur = ''; // les messages d'erreur sont enregistrer ici
$success = ''; // les messages de succes sont enregistrer ici

$jordan = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'upload'));
//on recupere les fichiers pour les afficher
$files = [];
foreach ($jordan as $file) {
	if ($file->isDir()) {
		continue;
	}
	$files[] = $file->getPathname();
}
//on transforme le chemin absolut en relatif pour le telechargement
for ($l=0; $l < count($files) ; $l++) {
	$files[$l] = strstr($files[$l], 'upload');
}
//creation d'un tableau qui va contenir que les nom des fichiers
$nameFiles = $files;
for ($m=0; $m < count($nameFiles); $m++) {
	$nameFiles[$m] = strrchr($nameFiles[$m], DIRECTORY_SEPARATOR);
	$nameFiles[$m] = substr($nameFiles[$m], 1);
}
//on recupere les dossiers deja creer dans le dossier "upload" et on les met dans le tableau $dossiers
$dossiers = [];
foreach ($jordan as $folder) {
	if ($folder->isDir()) {
		$dossiers[] = $folder->getRealPath();
	}
}
//on filtre les dossiers racines et on garde juste le nom du dossier
for ($i=0; $i < count($dossiers) ; $i++) {
	$dossiers[$i] = strstr($dossiers[$i], 'upload');
}
//deuxieme verification pour garder que des false et les dossiers
for ($j=0; $j < count($dossiers); $j++) {
	if ($dossiers[$j] == false || $dossiers[$j] == "upload") {
		array_splice($dossiers, $j, 1);
	}
}
//on enleve le debut car le chemin montre le nom du dossier racine
for ($k=0; $k < count($dossiers); $k++) { 
	if ($dossiers[$k] !== false) {
		$dossiers[$k] = substr($dossiers[$k], strlen('upload') + 1);
	}
}
if (isset($_POST['validerDossier'])) {
	//le nom du dossier est-il vide ?
	if (!empty($_POST['dossierName'])) {
		//ce dossier existe ?
		if (file_exists('upload' . DIRECTORY_SEPARATOR . $_POST['dossierName'])) {
			$erreur = '<div class="alert alert-danger" role="alert">Dossier déjà creer !!!</div>';
		} else {
			mkdir('upload' . DIRECTORY_SEPARATOR . $_POST['dossierName']);
			$success = '<div class="alert alert-success" role="alert">Dossier creer avec success !!! Appuie sur le titre du site pour refresh et faire afficher le nouveau dossier dans le champs de selection</div>';
		}
	} else {
		$erreur = '<div class="alert alert-danger" role="alert">Si tu veut creer un dossier bah il faut qu\'il est un nom non ???</div>';
	}
}
if (isset($_POST['validerFichier'])) {
	//si aucun fichier n'est uploader
	if (empty($_FILES['fichier']['tmp_name'])) {
		$erreur = '<div class="alert alert-danger" role="alert">Pas de fichier selectionner !!!</div>';	
	} else {
		//on essaie de deplacer le fichier dans le dossier selectionner
		try {
			move_uploaded_file($_FILES['fichier']['tmp_name'], 'upload' . DIRECTORY_SEPARATOR . $_POST['dossier'] . DIRECTORY_SEPARATOR . $_FILES['fichier']['name']);
			$success = '<div class="alert alert-success" role="alert">Fichier "' . $_FILES['fichier']['name'] . '" ajouter avec success dans "' . $_POST['dossier'] . DIRECTORY_SEPARATOR . $_FILES['fichier']['name'] . '"</div>';
		} catch (Exception $e) {
			$erreur = '<div class="alert alert-danger" role="alert">Le fichier c\'est uploader corectement mais ne n\'est pas dans le dossier selectionner... Il est dans : "' . $_FILES['fichier']['tmp_name'] . '" SINON ERREUR = ' . $e . '</div><br/>';
		}	
	}
}
?>