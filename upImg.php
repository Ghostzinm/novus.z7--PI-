<?php
// Caminho da pasta onde a imagem será salva
$pastaDestino = "imagens/";

// Obtém o caminho temporário do arquivo enviado
$arquivoTmp = $_FILES['imagem']['tmp_name'];

// Obtém o nome original do arquivo enviado (ex: "foto.png")
$nomeOriginal = basename($_FILES['imagem']['name']);

// Gera um nome único para o novo arquivo, para evitar que um arquivo substitua outro
// uniqid() cria um ID único baseado no tempo atual em microssegundos
$novoNome = date("Ymd_His") . "_" . $nomeOriginal;

// Define o caminho completo onde o arquivo será salvo (ex: "imagens/6512b7a3a3a1f_foto.png")
$caminhoFinal = $pastaDestino . $novoNome;

// move_uploaded_file() move o arquivo da pasta temporária para o destino final
// Retorna true se der certo
if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
    // Mensagem de sucesso e link para ver a imagem
    echo "Imagem enviada com sucesso!<br>";
    echo "<a href='$caminhoFinal' target='_blank'>Ver Imagem</a>";
}
?>
