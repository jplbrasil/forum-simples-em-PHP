<?
require("header.php");

//Recupera os dados da pergunta
$query="SELECT titulo,texto,remetente,data FROM perguntas WHERE id = $pergunta";
$resultado=mysql_query($query,$link);
$linha=mysql_fetch_array($resultado);

$data=dataie($linha[data]);

print "<B>Pergunta:</B> &nbsp $linha[titulo]\n";
print "<BR>";
print "<I>Remetente: $linha[remetente] &nbsp - &nbsp Data: $data</I>\n";
print "<BR><BR>";
print "<I>$linha[texto]</I>\n";
print "<BR><BR>";

//Recupera os dados da resposta
$query2="SELECT texto,remetente,data FROM respostas WHERE id = $resposta";
$resultado2=mysql_query($query2,$link);
$linha2=mysql_fetch_array($resultado2);

$data2=dataie($linha2[data]);

print "<B>Resposta:</B>\n";
print "<BR>";
print "<I>Remetente: $linha2[remetente] &nbsp - &nbsp Data: $data2</I>\n";
print "<BR><BR>";
print "<I>$linha2[texto]</I>\n";
print "<BR><BR>";

require("footer.php");
?>