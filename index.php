<?
require("header.php");

print "<TABLE BORDER=1 ALIGN=\"CENTER\">\n";
print "<TR>\n";
print "<TD WIDTH=50%>\n";
print "Para quem gosta de programar, os fontes deste site e de outros programas que fiz estão disponíveis em minha homepage: <A HREF=\"http://www.jpl.cjb.net\">www.jpl.cjb.net</A> .";
print "</TD>\n";
print "<TD WIDTH=50%>\n";
if($cadastrar)
{
 $query="INSERT INTO emails VALUES (\"\",\"$email\")";

 if(mysql_query($query,$link))
  printok("OK. Seu email foi cadastrado com sucesso!");
 else
  printerro("Atenção: Seu email não foi cadastrado devido um erro em nosso banco de dados!");
}
else if($remover)
{
 $query="DELETE FROM emails WHERE email = \"$email\"";

 if(mysql_query($query,$link))
  printok("OK. Seu email foi <B>descadastrado</B> com sucesso!");
 else
  printerro("Atenção: Seu email não foi <B>descadastrado</B> devido um erro em nosso banco de dados!");
}
else
{
 print "Se você quiser receber um email a cada nova pergunta ou resposta cadastrada neste fórum, cadastra-se aqui:";
 print "<FORM ACTION=\"$PATH_INFO\" METHOD=\"POST\">\n";
 print "<INPUT TYPE=\"TEXT\" SIZE=20 NAME=\"email\" VALUE=\"\">\n";
 print "<INPUT TYPE=\"SUBMIT\" NAME=\"cadastrar\" VALUE=\"Cadastrar\">\n";
 print "<INPUT TYPE=\"SUBMIT\" NAME=\"remover\" VALUE=\"Remover\">\n";
 print "</FORM>\n";
}
print "</TD>\n";
print "</TR>\n";
print "</TABLE>\n";

print "<BR>\n";

if(!$ordem)
 $ordem="id";

if(!$situacao)
 $situacao="%";

print "<TABLE BORDER=1 ALIGN=\"CENTER\">\n";
print "<TR>\n";
print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
print "<A HREF=\"$PATH_INFO?ordem=titulo&situacao=$situacao\">Classificar pelo título</A>\n";
print "</TD>\n";
print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
print "<A HREF=\"$PATH_INFO?ordem=remetente&situacao=$situacao\">Classificar pelo remetente</A>\n";
print "</TD>\n";
print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
print "<A HREF=\"$PATH_INFO?ordem=data&situacao=$situacao\">Classificar pela data</A>\n";
print "</TD>\n";
print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
if($situacao=="%")
 print "<A HREF=\"$PATH_INFO?ordem=$ordem&situacao=N\">Ocultar respondidas</A>\n";
else
 print "<A HREF=\"$PATH_INFO?ordem=$ordem&situacao=%\">Exibir respondidas</A>\n";
print "</TD>\n";

print "</TR>\n";
print "</TABLE>\n";

print "<BR>\n";

$query="SELECT id,titulo,remetente,data,respondida FROM perguntas WHERE respondida LIKE \"%$situacao%\" ORDER BY $ordem";
$resultado=mysql_query($query,$link);

print "<TABLE>\n";

while($linha=mysql_fetch_array($resultado))
{
 $data=dataie($linha[data]);
 print "<TR><TD><A HREF=\"resposta.php?pergunta=$linha[id]\">$linha[titulo]</A></TD></TR>\n";
 print "<TR><TD><I>Remetente: $linha[remetente] * Data: $data</I></TD></TR>\n";

 $query2="SELECT id,remetente,data FROM respostas WHERE pergunta = $linha[id]";
 $resultado2=mysql_query($query2,$link);

 while($linha2=mysql_fetch_array($resultado2))
 {
  $data2=dataie($linha2[data]);
  print "<TR><TD> &nbsp &nbsp &nbsp <A HREF=\"ver_resposta.php?pergunta=$linha[id]&resposta=$linha2[id]\">Re:$linha[titulo]</A></TD></TR>\n";
  print "<TR><TD> &nbsp &nbsp &nbsp <I>Remetente: $linha2[remetente] * Data: $data2</I></TD></TR>\n";
 }

 print "<TR><TD><BR></TD></TR>\n";
}

print "</TABLE>\n";

require("footer.php");
?>
