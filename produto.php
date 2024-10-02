<?php

// Conexão
$servidor = 'localhost';
$banco = 'produto'; 
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $url_foto = $_POST['url_foto'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        echo "Recebido: <br>";
        echo "Nome do Produto: " . htmlspecialchars($nome) . "<br>";
        echo "URL da Foto: " . htmlspecialchars($url_foto) . "<br>";
        echo "Descrição: " . nl2br(htmlspecialchars($descricao)) . "<br>";
        echo "Preço: R$ " . htmlspecialchars(number_format($preco, 2, ',', '.')) . "<br>";

        $codigoSQL = "INSERT INTO `produtos` (`id`, `nome`, `url_foto`, `descricao`, `preco`) VALUES (NULL, :nome, :url_foto, :descricao, :preco)";

        $comando = $conexao->prepare($codigoSQL);
        $resultado = $comando->execute(array(
            ':nome' => $nome,
            ':url_foto' => $url_foto,
            ':descricao' => $descricao,
            ':preco' => $preco
        ));

        if ($resultado) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados!";
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

$conexao = null;

?>
