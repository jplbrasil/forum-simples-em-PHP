<?
require("header.php");

if($cadastrar)
{
 $H=hoje();

 $query="UPDATE perguntas SET respondida = \"S\" WHERE id = $pergunta";

 if(!mysql_query($query,$link))
  printerro("Atenção: Sua resposta não foi enviada devido um erro em nosso banco de dados!");
 else
 {
  $query="INSERT INTO respostas VALUES (\"\",\"$pergunta\",\"$resposta\",\"$remetente\",\"$H\")";

  if(mysql_query($query,$link))
   printok("OK. Sua resposta foi enviada com sucesso!");
  else
   printerro("Atenção: Sua resposta não foi enviada devido um erro em nosso banco de dados!");
 }

}
else
{

 $query="SELECT titulo,texto FROM perguntas WHERE id = $pergunta";
 $resultado=mysql_query($query,$link);
 $linha=mysql_fetch_array($resultado);

 print "<B>Pergunta: &nbsp $linha[titulo]</B>\n";

 print "<BR><BR>";

 print "<I>$linha[texto]</I>\n";

 print "<BR><BR>";

 print "<FORM ACTION=\"$PATH_INFO\" METHOD=\"POST\">\n";

 print "Resposta: (Texto livre. Será visualizado apenas quando alguém clicar no link para a resposta.)\n";
 print "<BR>\n";
 print "<TEXTAREA COLS=80  NAME=\"resposta\"></TEXTAREA>\n";

 print "<BR><BR>";

 print "Seu nome: (Email também, se quiser)\n";
 print "<BR>\n";
 print "<INPUT TYPE=\"TEXT\" SIZE=80 NAME=\"remetente\">\n";

 print "<BR><BR>";

 print "<INPUT TYPE=\"HIDDEN\" NAME=\"pergunta\" VALUE=\"$pergunta\">";

 print "<INPUT TYPE=\"RESET\" NAME=\"limpar\" VALUE=\"Limpar\">";

 print "<INPUT TYPE=\"SUBMIT\" NAME=\"cadastrar\" VALUE=\"Enviar\">";

 print "</FORM>\n";
}

require("footer.php");
?>
