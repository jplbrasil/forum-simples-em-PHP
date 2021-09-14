<?

function printok($string)
{
 print "<B><FONT SIZE=3 COLOR=\"GREEN\">$string</FONT></B><BR><BR>\n";
}

function printerro($string)
{
 print "<B><FONT SIZE=3 COLOR=\"RED\">$string</FONT></B><BR><BR>\n";
}

function hoje()
{
 return date("y") . date("m") . date("d");
}

function dataie($data)
{
 $data=explode("-",$data);
 return $data[2] . "/" . $data[1] . "/" . $data[0];
}

$link=mysql_connect("localhost","","");
mysql_select_db("FORUM",$link);

print "<HTML>\n";
print "<TITLE>Fórum SI Puc Contagem</TITLE>\n";
print "<BODY BGCOLOR=\"WHITE\">\n";

print "<HR>\n";
print "<TABLE ALIGN=\"CENTER\">\n";
print "<TR>\n";
print "<TD BGCOLOR=\"GREEN\" ALIGN=\"CENTER\" WIDTH=2000>\n";
print "<FONT SIZE=6 COLOR=\"YELLOW\">Fórum de Discussão</FONT>\n";
print "<BR>\n";
print "<FONT SIZE=4 COLOR=\"YELLOW\"><I>Sistemas de Informação - Puc Contagem</I></FONT>\n";
print "</TD>\n";
print "</TR>\n";
print "</TABLE>\n";
print "<HR>\n";
print "<TABLE ALIGN=\"CENTER\" BORDER=1 CELLPADDING=5>\n";
print "<TR>\n";
print "<TD><A HREF=\"index.php\">Homepage</TD>\n";
print "<TD><A HREF=\"pergunta.php\">Enviar Pergunta</TD>\n";
print "<TD><A HREF=\"admin.php\">Administração</TD>\n";
print "</TR>\n";
print "</TABLE>\n";
print "<HR>\n";
print "<BR>\n";
?>
