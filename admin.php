<?
require("header.php");

if(!$senha)
{
 print "<CENTER>Informe a senha de administrador do fórum:";
 print "<FORM ACTION=\"$PATH_INFO\" METHOD=\"POST\">\n";
 print "<INPUT TYPE=\"PASSWORD\" SIZE=20 NAME=\"senha\" VALUE=\"\">\n";
 print "<INPUT TYPE=\"SUBMIT\" NAME=\"entrar\" VALUE=\"Entrar\">\n";
 print "</FORM></CENTER>\n";
}

else
{
 if($senha!="admin")
 {
  printerro("<CENTER>Senha incorreta. Você não tem permissão para administrar este fórum!</CENTER>");
 }

 else
 {

  //Links para criacao das tabelas de dados
  print "<TABLE BORDER=1 ALIGN=\"CENTER\">\n";
  print "<TR>\n";
  print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
  print "<A HREF=\"$PATH_INFO?criar=perguntas&senha=$senha\">Criar tabela de perguntas</A>\n";
  print "</TD>\n";
  print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
  print "<A HREF=\"$PATH_INFO?criar=respostas&senha=$senha\">Criar tabela de respostas</A>\n";
  print "</TD>\n";
  print "<TD WIDTH=25% ALIGN=\"CENTER\">\n";
  print "<A HREF=\"$PATH_INFO?criar=emails&senha=$senha\">Criar tabela de emails</A>\n";
  print "</TD>\n";
  print "</TR>\n";
  print "</TABLE>\n";

  //Procedimento para criacao de tabelas de dados
  if($criar)
  {
   if($criar=="perguntas")
   {
    $query="CREATE TABLE perguntas (id INT PRIMARY KEY AUTO_INCREMENT, titulo TEXT, texto TEXT, remetente TEXT, data DATE, respondida CHAR)";

    if(mysql_query($query,$link))
     printok("OK. Tabela \"perguntas\" criada com sucesso!");
    else
     printerro("Atenção: A tabela \"perguntas\" não foi criada devido um erro em nosso banco de dados!");
   }

   if($criar=="respostas")
   {
    $query="CREATE TABLE respostas (id INT PRIMARY KEY AUTO_INCREMENT, pergunta INT, texto TEXT, remetente TEXT, data DATE)";

    if(mysql_query($query,$link))
     printok("OK. Tabela \"respostas\" criada com sucesso!");
    else
     printerro("Atenção: A tabela \"respostas\" não foi criada devido um erro em nosso banco de dados!");
   }

   if($criar=="emails")
   {
    $query="CREATE TABLE emails (id INT PRIMARY KEY AUTO_INCREMENT, email TEXT)";

    if(mysql_query($query,$link))
     printok("OK. Tabela \"emails\" criada com sucesso!");
    else
     printerro("Atenção: A tabela \"emails\" não foi criada devido um erro em nosso banco de dados!");
   }

  }

  //Procedimento para excuir perguntas
  if($excluirp)
  {
   $query="DELETE FROM perguntas WHERE id = $excluirp";

   if(mysql_query($query,$link))
    printok("OK. Pergunta excluída com sucesso!");
   else
    printerro("Atenção: A pergunta não foi excluída devido um erro em nosso banco de dados!");

   $query="DELETE FROM respostas WHERE pergunta = $excluirp";

   if(mysql_query($query,$link))
    printok("OK. Resposta(s) da pergunta excluída(s) com sucesso!");
   else
    printerro("Atenção: A(s) resposta(s) da pergunta não foi(foram) excluída(s) devido um erro em nosso banco de dados!");
  }

  //Procedimento para excluir respostas
  else if($excluirr)
  {
   $query="DELETE FROM respostas WHERE id = $excluirr";

   if(mysql_query($query,$link))
    printok("OK. Resposta excluída com sucesso!");
   else
    printerro("Atenção: A resposta não foi excluída devido um erro em nosso banco de dados!");
  }

  //Recupera os dados das perguntas
  $query="SELECT id,titulo,remetente,data FROM perguntas";
  $resultado=mysql_query($query,$link);

  print "<TABLE>\n";

  while($linha=mysql_fetch_array($resultado))
  {
   $data=dataie($linha[data]);
   print "<TR><TD><B>Pergunta: &nbsp $linha[titulo] </B> &nbsp &nbsp <A HREF=\"$PATH_INFO?excluirp=$linha[id]&senha=$senha\"><I>Excluir</I></A>\n";
   print "<TR><TD><I>Remetente: $linha[autor] * Data: $data</I></TD></TR>\n";

   $query2="SELECT id,remetente,data FROM respostas WHERE pergunta = $linha[id]";
   $resultado2=mysql_query($query2,$link);

   while($linha2=mysql_fetch_array($resultado2))
   {
    $data2=dataie($linha2[data]);
    print "<TR><TD> &nbsp &nbsp &nbsp <B>Re:$linha[titulo] </B>  &nbsp &nbsp <A HREF=\"$PATH_INFO?excluirr=$linha2[id]&senha=$senha\"><I>Excluir</I></A></TD></TR>\n";
    print "<TR><TD> &nbsp &nbsp &nbsp <I>Remetente: $linha2[autor] * Data: $data2</I></TD></TR>\n";
   }

   print "<TR><TD><BR></TD></TR>\n";
  }

  print "</TABLE>\n";

 }//Fim do else senha incorreta

}//Fim do else nao tem senha

require("footer.php");
?>
