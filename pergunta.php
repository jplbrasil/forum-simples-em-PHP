<?
require("header.php");

if($cadastrar)
{
 $H=hoje();

 $query="INSERT INTO perguntas VALUES (\"\",\"$titulo\",\"$texto\",\"$remetente\",\"$H\",\"N\")";

 if(mysql_query($query,$link))
  printok("OK. Sua pergunta foi enviada com sucesso!");
 else
  printerro("Aten��o: Sua pergunta n�o foi enviada devido um erro em nosso banco de dados!");
}
else
{
 print "<FORM ACTION=\"$PATH_INFO\" METHOD=\"POST\">\n";

 print "T�tulo da Pergunta: (Aparecer� como link na Homepage)\n";

 print "<BR>\n";

 print "<INPUT TYPE=\"TEXT\" SIZE=80 NAME=\"titulo\" VALUE=\"\">\n";

 print "<BR><BR>";

 print "Pergunta: (Texto livre. Ser� visualizado apenas por quem quiser responder � pergunta)\n";
 print "<BR>\n";
 print "<TEXTAREA COLS=80  NAME=\"texto\"></TEXTAREA>\n";

 print "<BR><BR>";

 print "Seu nome: (Email tamb�m, se quiser)\n";
 print "<BR>\n";
 print "<INPUT TYPE=\"TEXT\" SIZE=80 NAME=\"remetente\" VALUE=\"\">\n";

 print "<BR><BR>";

 print "<INPUT TYPE=\"RESET\" NAME=\"limpar\" VALUE=\"Limpar\">";

 print "<INPUT TYPE=\"SUBMIT\" NAME=\"cadastrar\" VALUE=\"Enviar\">";

 print "</FORM>\n";
}

require("footer.php");
?>
