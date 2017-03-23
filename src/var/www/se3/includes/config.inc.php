<?php

  /**
  * Lecture des variables dans la base MySQL

  * @Version $Id: config.inc.php.in 9184 2016-02-21 00:58:01Z keyser $

  * @Projet LCS / SambaEdu

  * @Auteurs Equipe Tice académie de Caen
  * @Auteurs « wawa »  olivier.lecluse@crdp.ac-caen.fr

  * @Note Ce fichier de fonction doit être appelé par un include dans entete.inc.php
  * @Note Ce fichier est complete a l'installation

  * @Licence Distribué sous la licence GPL
  */

   /**

   * file: config.inc.php
   * @Repertoire: includes/
   */




# Paramètres de la base de données

$dbhost="localhost";
$dbname="se3db";
$dbuser="se3db_admin";
$dbpass="jahlove";

$srv_id=1;

# Paramètres fixes

$secook=0;
$Pool  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$Pool .= "abcdefghijklmnopqrstuvwxyz";
$Pool .= "1234567890";
$SessLen = 20;
# Model caracteres speciaux pour les mots de passe
$char_spec = "&_#@£%§:!?*$";


$ldap_login_attr = "cn";

# Récupération des paramètres depuis la base de donnée

$authlink = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbhost, $dbuser, $dbpass));
@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $dbname)) or die("Impossible de se connecter à la base $dbname.");
$result=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from params where srv_id=0 OR srv_id=$srv_id");
if ($result)
    while ($r=mysqli_fetch_array($result))
        $$r["name"]=$r["value"];
else
    die ("paramètres absents de la base de donnée");
((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

$urlauth=$urlse3."/auth.php";

# Gettext

chdir($path_to_wwwse3);
putenv("LANG=$lang");
putenv("LANGUAGE=$lang");
setlocale(LC_ALL, "C");
bindtextdomain("messages","./locale");
textdomain("messages");

# Paramètres LDAP

$adminDn      = "$adminRdn,$ldap_base_dn";

# Declaration des «branches» de l'annuaire LCS/SE3 dans un tableau
$dn = array();
  $dn["people"] = "$peopleRdn,$ldap_base_dn";
  $dn["groups"] = "$groupsRdn,$ldap_base_dn";
  $dn["rights"] = "$rightsRdn,$ldap_base_dn";
  $dn["parcs"] = "$parcsRdn,$ldap_base_dn";
  $dn["computers"] = "$computersRdn,$ldap_base_dn";
  $dn["printers"] = "$printersRdn,$ldap_base_dn";
  $dn["trash"] = "$trashRdn,$ldap_base_dn";
?>
