<?
switch ($_SERVER['HTTP_ORIGIN']) {
    case 'https://piratenpartei-bayern.de': 
    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type');
    break;
}

/*
from http://stackoverflow.com/questions/298745/how-do-i-send-a-cross-domain-post-request-via-javascript
*/

$config = parse_ini_file("config.ini");


function formular($titel='',$vorname='',$nachname='',$email='',$gebdatum='',$strasse='',$snr='',$plz='',$ort='',$nat='',$telefon='',$fax='',$newsletter=0,$jupi=0,$arm=0,$liquid=0,$comment='',$umfragen=0)
{
?>
<FORM METHOD="POST">
<TABLE>
<TR> <TD>Titel</TD><TD><INPUT TYPE="text" name="titel" value='<?=$titel;?>'></TD></TR>
<TR> <TD>Vorname</TD><TD><INPUT TYPE="text" name="vorname" value='<?=$vorname;?>'></TD></TR>
<TR> <TD>Nachname</TD><TD><INPUT TYPE="text" name="nachname" value='<?=$nachname?>' ></TD></TR>
<TR> <TD>Email</TD><TD><INPUT TYPE="text" name="email" value='<?=$email?>' ></TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Die Kommunikation der Piratenpartei erfolgt zu großen Teilen per E-Mail. Eine funktionierende E-Mail Adresse ist deswegen unerlässlich</I></SMALL></TD></TR>
<TR> <TD>Geburtsdatum</TD><TD><INPUT TYPE="text" name="gebdatum" value='<?=$gebdatum?>' </TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Das Mindestalter für eine Mitgliedschaft liegt bei 16 Jahren</I></SMALL></TD></TR>
<TR> <TD>Strasse NR</TD><TD><INPUT TYPE="text" name="strasse" value='<?=$strasse?>'><INPUT TYPE="text" name="snr" size=4 value='<?=$snr?>'></TD></TR>
<TR> <TD>Plz Wohnort</TD><TD><INPUT TYPE="text" name="plz" size=5 value='<?=$plz?>' ><INPUT TYPE="text" name="ort" value='<?=$ort?>'></TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Ein Wohnsitz in Deutschland ist notwendig</I></SMALL></TD></TR>
<TR> <TD>Nationalität</TD><TD><INPUT TYPE="text" name="nat" value='<?=$nat?>'></TD></TR>
<TR> <TD>Telefon <I><SMALL>(optional)</SMALL></I></TD><TD><INPUT TYPE="text" name="tel" value='<?=$telefon?>'></TD></TR>
<TR> <TD>Fax <I><SMALL>(optional)</SMALL></I> </TD><TD><INPUT TYPE="text" name="fax" value='<?=$fax?>'></TD></TR>
<TR> <TD>Newsletter</TD><TD><input type="checkbox" name="newsletter" value="1" <?if ($newsletter==1) echo "checked";?>/></TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Ich möchte den Newsletter des Landesverband Bayern der Piratenpartei Deutschland abonnieren.</I></SMALL></TD></TR>
<TR> <TD>Junge Piraten</TD><TD><input type="checkbox" name="jupi" value="1" <?if ($jupi==1) echo "checked";?> /></TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Junge Piraten: Ich bin maximal 27 Jahre alt und möchte zusätzlich kostenlos Mitglied der Jugendorganisation Junge Piraten werden.
Die Satzung der Jungen Piraten erkenne ich an. Der Antrag gilt auch für alle bestehenden und zu gründenden Untergliederungen der Jungen Piraten an meinem Wohnsitz. Der Verein darf über meine E-Mailadresse mit mir Kontakt aufnehmen. Ich erteile mit diesem Antrag die notwendige schriftliche Einwilligung, dass die in diesem Formular gemachten Angaben an die Jungen Piraten übermittelt und ausschließlich für interne Zwecke des Vereins verarbeitet werden dürfen.</I></SMALL></TD></TR>
<TR> <TD>Beitragsminderung</TD><TD><input type="checkbox" name="arm" value="1" <?if ($arm==1) echo "checked";?>/></TD></TR>
<TR> <TD>Liquid Feedback Teilname </TD><TD><input type="checkbox" name="liquid" value="1"  <?if ($liquid==1) echo "checked";?>/></TD></TR>
<TR> <TD>Teilname an Umfragen erwünscht</TD><TD><input type="checkbox" name="umfragen" value="1"/ <?if ($umfragen==1) echo "checked";?>></TD></TR>
<TR> <TD COLSPAN=2><SMALL><I>Beitragsminderung Leider kann ich den Regelbeitrag von 3 . / Monat nicht aufbringen und bitte um Beitragsminderung. Mein Antrag zur Mitgliedschaft ruht solange bis die Beitragsminderung bewilligt wurde. Bitte senden Sie mir alle notwendigen Informationen an meine angegebene E-Mail Adresse.</I></SMALL></TD></TR>
<TR> <TD>Deine Mitteilung an uns <SMALL><I>(optional)</I></SMALL></TD><TD><textarea name=comment cols="70" rows="5"><?=$comment?></Textarea></TD></TR>
<TR> <TD><input type="submit" value="Abschicken"></TD><TD><input type="reset" value="Reset"></TD></TR>
</TABLE>
<INPUT TYPE="hidden" name="send" value=1>
</FORM>
<?
}?>

<?
function secure($was)
{
return mysql_real_escape_string(addslashes(trim($was)));
}
function leer($feld,$text,$titel='',$vorname='',$nachname='',$email='',$gebdatum='',$strasse='',$snr='',$plz='',$ort='',$nat='',$tel,$fax='',$newsletter=0,$jupi=0,$arm=0,$liquid=0,$comment='',$umfragen=0)
{
   if($feld=="")
   {
	echo "<p class='statusmessage' style='color: red;' > $text darf nicht leer sein </p>";
	formular($titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	exit;
   }
}

if(!isset($_POST["send"])) formular();
else
{
   if($_POST["send"]==1)
   {
     $link=mysql_connect('localhost',$config['username'],$config['password']);
      if (!$link) {
       echo "<p class='statusmessage' style='color: red;' > Daten konnten nicht gespeichert werden, bitte probiere es später nocheinmal.</p>";
      formular();
       exit;
      }
      $titel=secure($_POST["titel"]);
      $vorname=secure($_POST["vorname"]);
      $nachname=secure($_POST["nachname"]);
      $strasse=secure($_POST["strasse"]);
      $snr=secure($_POST["snr"]);
      $plz=secure($_POST["plz"]);
      $ort=secure($_POST["ort"]);
      $fax=secure($_POST["fax"]);
      $tel=secure($_POST["tel"]);
      $nat=secure($_POST["nat"]);
      $comment=secure($_POST["comment"]);
      $email=secure($_POST["email"]);
      if ($_POST["newsletter"]=="1") $news=1; else $news=0;
      if ($_POST["jupi"]=="1") $jupi=1; else $jupi=0;
      if ($_POST["arm"]=="1") $arm=1; else $arm=0;
      if ($_POST["liquid"]=="1") $liquid=1; else $liquid=0;
      if ($_POST["umfragen"]=="1") $umfragen=1; else $umfragen=0;
      $gebdatum=date("Y-m-d",strtotime(secure($_POST["gebdatum"])));
        
        leer($vorname,"Vorname",$titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	leer($nachname,"Nachname",$titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	leer($strasse,"Strasse",$titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	leer($plz,"Postleitzahl",$titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	leer($ort,"Ort",$titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
	$datum=secure($_POST["gebdatum"]);
        $zahlen=explode(".",$datum);
	if(!checkdate($zahlen[1],$zahlen[0],$zahlen[2]) )
        {
	   echo "<p class='statusmessage' style='color: red;' >Geburtsdatum bitte im Format <em>TT.MM.YYYY</em> eingeben</p>";
		formular($titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
		
		exit;
        }
	$doubler=md5($_SERVER['REMOTE_ADDR']);
      mysql_select_db("mitglieder",$link);
      $erg=mysql_query("insert into Mitglieder (titel,vorname,nachname,gebdatum,strasse,hausnummer,plz,ort,email,telefon,fax,nation,Newsletter,jupis,minderung,kommentar,liquid,umfragen,doubler) values('$titel','$vorname','$nachname','$gebdatum','$strasse','$snr','$plz','$ort','$email','$tel','$fax','$nat',$news,$jupi,$arm,'$comment',$liquid,$umfragen,'$doubler')",$link);
      if (mysql_errno()) 
        {
          echo mysql_error() ."<br />";
          if(mysql_errno()==1062)
	  {
            echo "<p class='statusmessage' style='color: red;' >Deine Daten sind schon bei uns eigegangen, sollte dies nicht stimme bitte wende dich per Email support@piratenpartei-bayern.de an uns</p>";
		formular($titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
 		exit;
          }
          else
	  {
                 echo "<p class='statusmessage' style='color: red;'> Daten konnten nicht gespeichert werden, bitte probiere es später nocheinmal</p>";
		formular($titel,$vorname,$nachname,$email,$_POST["gebdatum"],$strasse,$snr,$plz,$ort,$nat,$tel,$fax,$news,$jupi,$arm,$liquid,$comment,$umfragen);
                exit;
          }
        } 
      echo "<p class='statusmessage' style='color: green;'>Vielen Dank, Deine Daten wurden gespeichert</p>";
//		formular();
      mysql_close($link); 
   }
}
?>
