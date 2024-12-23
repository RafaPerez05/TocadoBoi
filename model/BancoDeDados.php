<?php
class BancoDeDados{

    private static $instance;

    private $host;
    private $login;
    private $senha;
    private $dataBase;

    private function __construct($Host, $Login, $Senha, $DataBase){
        $this->host = $Host;
        $this->login = $Login;
        $this->senha = $Senha;
        $this->dataBase = $DataBase;
    }

    // Método estático para obter a instância única da classe
    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new BancoDeDados("localhost", "root", "", "toca");
        }
        return self::$instance;
    }

    //Métodos
    public function conectarBD(){

        $conexao = mysqli_connect($this->host,$this->login,$this->senha,$this->dataBase);
        return($conexao);
    }

    public function verificaLoginBD($email,$senha){
        $conexao = $this->conectarBD();
        $sql_code = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
        $quantidade = $sql_query->num_rows;
        $usuario_tipo = "cliente";

        if($quantidade == 0)
        {
            $sql_code = "SELECT * FROM funcionario WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
            $usuario_tipo = "funcionario";
   
        }
        return [$sql_query->fetch_assoc(), $usuario_tipo];

}
public function inserirCarrinho($carrinho) {
    $conexao = $this->conectarBD();

    // Verificar se já existe um registro com o mesmo código de cliente e produto
    $consultaExistente = "SELECT COUNT(*) AS total FROM carrinho WHERE cliente_cod = '{$carrinho->get_clienteCod()}' AND produto_cod = '{$carrinho->get_produtoCod()}'";
    $resultadoConsulta = mysqli_query($conexao, $consultaExistente);
    $linha = mysqli_fetch_assoc($resultadoConsulta);

    // Se já existir, retornar false
    if ($linha['total'] > 0) {
        return false;
    }

    // Caso contrário, realizar a inserção
    $codCarrinho = "INSERT INTO carrinho (cliente_cod, produto_cod, quantidade) 
                    VALUES ('{$carrinho->get_clienteCod()}', '{$carrinho->get_produtoCod()}', '{$carrinho->get_quantidade()}')";
    
    $result = mysqli_query($conexao, $codCarrinho);

    // Verificar se a inserção foi bem-sucedida
    if ($result) {
        return true;
    } else {
        return false;
    }
}



public function inserirProduto($produto) {
    $conexao = $this->conectarBD();

    //INSERT INTO `produto`(`nome`, `fabricante`, `descricao`, `valor`, `cod`, `imagem_path`, `sexo`, `tipo`, `tamanho`, `material`)
    // Inserção na tabela produto
    $consulProd = "INSERT INTO produto (nome, fabricante, descricao, valor, imagem_path, sexo, tipo, tamanho, material) 
                   VALUES (
                    '{$produto->get_Nome()}', 
                    '{$produto->get_Fabricante()}', 
                    '{$produto->get_Descricao()}', 
                    '{$produto->get_Valor()}', 
                    '{$produto->get_Imagem()}', 
                    '{$produto->get_Sexo()}', 
                    '{$produto->get_Tipo()}', 
                    '{$produto->get_Tamanho()}', 
                    '{$produto->get_Material()}')";
    if (mysqli_query($conexao, $consulProd)) {
        // Obtendo o ID do produto inserido
        $produtoId = mysqli_insert_id($conexao);

       echo $produto->get_Tipo(); 
        // Inserção nas tabelas específicas
        switch (get_class($produto)) {
            case 'Bota':
                $alturaCano = $produto->getAlturaCano();
                $consulEspecifico = "INSERT INTO bota (produto_cod, altura_cano) VALUES ('$produtoId', '$alturaCano')";
                if (!mysqli_query($conexao, $consulEspecifico)) {
                    echo "Erro ao inserir na tabela bota: " . mysqli_error($conexao);
                }
                break;
            case 'Camisa':
                $modelo = $produto->getModelo();
                $cor = $produto->getCor();
                $consulEspecifico = "INSERT INTO camisa (produto_cod, modelo, cor) VALUES ('$produtoId', '$modelo', '$cor')";
                if (!mysqli_query($conexao, $consulEspecifico)) {
                    echo "Erro ao inserir na tabela camisa: " . mysqli_error($conexao);
                }
                break;
            case 'Chapeu':
                $estilo = $produto->getEstilo();
                $circunferencia = $produto->getCircunferencia();
                $consulEspecifico = "INSERT INTO chapeu (produto_cod, estilo, circunferencia) VALUES ('$produtoId', '$estilo', '$circunferencia')";
                if (!mysqli_query($conexao, $consulEspecifico)) {
                    echo "Erro ao inserir na tabela chapeu: " . mysqli_error($conexao);
                }
                break;
            case 'Cinto':
                $largura = $produto->getLargura();
                $materialFivela = $produto->getMaterialFivela();
                $consulEspecifico = "INSERT INTO cinto (produto_cod, largura, material_fivela) VALUES ('$produtoId', '$largura', '$materialFivela')";
                if (!mysqli_query($conexao, $consulEspecifico)) {
                    echo "Erro ao inserir na tabela cinto: " . mysqli_error($conexao);
                }
                break;
            default:
                // Não há inserção específica para produtos genéricos
                break;
        }
    } else {
        echo "Erro ao inserir na tabela produto: " . mysqli_error($conexao);
    }
}

public function inserirCupom($nomeCupom, $tipo, $desconto) {
    $conexao = $this->conectarBD();

    $sql = "INSERT INTO cupons (nome, tipo, desconto, status, data_expiracao) 
            VALUES ('{$nomeCupom}', '{$tipo}', '{$desconto}', 'ativo', DATE_ADD(NOW(), INTERVAL 30 DAY))";

    if (mysqli_query($conexao, $sql)) {
        return true;
    } else {
        throw new Exception("Erro ao inserir cupom: " . mysqli_error($conexao));
    }
}

    
    public function inserirCliente($cliente){
        
        $conexao = $this->conectarBD();
        $consulta = "INSERT INTO cliente (nome, sobrenome, cpf, dataNascimento, telefone, email, senha) 
                     VALUES ('{$cliente->get_nome()}','{$cliente->get_sobrenome()}', '{$cliente->get_cpf()}','{$cliente->get_datanasc()}','{$cliente->get_telefone()}','{$cliente->get_email()}','{$cliente->get_senha()}')";
        mysqli_query($conexao,$consulta);
    }

    public function alterarCliente($cliente){
        $conexao = $this->conectarBD();

        $consulta = "UPDATE cliente SET 
                        nome = '{$cliente->get_nome()}',
                        sobrenome = '{$cliente->get_sobrenome()}',
                        dataNascimento = '{$cliente->get_datanasc()}',
                        telefone = '{$cliente->get_telefone()}',
                        email = '{$cliente->get_email()}',
                        senha = '{$cliente->get_senha()}'
                    WHERE cod = '{$cliente->get_cod()}'";
        $resultado = mysqli_query($conexao, $consulta);

        if($resultado) {
            echo "Cliente alterado com sucesso!";
        } else {
            echo "Ocorreu um erro ao tentar alterar o cliente.";
        }
    }
    
    
    public function retornarClientes(){
    
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente";
        $listaClientes = mysqli_query($conexao,$consulta);
        return $listaClientes;
    }
    public function retornarClienteLogado($usuarioLogado){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente WHERE cod = '{$usuarioLogado}'";
        $clienteLogado = mysqli_query($conexao,$consulta);
        return $clienteLogado;
    }

    public function excluirCliente($cod){
        $conexao = $this->conectarBD();
        $query = "DELETE FROM endereco WHERE cod_cliente = $cod";

        if(mysqli_query($conexao, $query)){
            echo "Endereço excluído com sucesso.";
            $query = " DELETE FROM cliente WHERE cod = $cod";
                if(mysqli_query($conexao, $query)){
                echo "Cliente excluído com sucesso.";

                }else{
                echo "Erro ao excluir o cliente: " . mysqli_error($conexao);
                }
        } else{
            echo "Erro ao excluir o endereço: " . mysqli_error($conexao);
        }
    }
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulProd);
        return $listaProdutos;
    }
    
    public function retornarProdutosCarrinho($usuarioLogado) {
        $conexao = $this->conectarBD();
        $consulProd = "SELECT 
        c.cod AS codigo_carrinho, 
        p.nome AS nome_produto,
        p.cod AS cod_produto, 
        p.imagem_path AS caminho_imagem, 
        p.valor AS valor_produto, 
        c.quantidade AS quantidade
        
                        FROM carrinho c
                        JOIN produto p ON c.produto_cod = p.cod
                        WHERE c.cliente_cod = '{$usuarioLogado}'";
        $listaProdutosCarrinho = mysqli_query($conexao, $consulProd);
        return $listaProdutosCarrinho;
    }
    

    public function retornarProdutosCod($cod){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto WHERE cod = $cod";
        $Produto = mysqli_query($conexao,$consulProd);
        return $Produto;
    }

    public function excluirProdutos($cod,$tipo){
        $conexao = $this->conectarBD();
        $tipo = strtolower($tipo);
        $query = "DELETE FROM $tipo WHERE produto_cod = $cod";


        if(mysqli_query($conexao, $query)){
            echo "Produto excluído com sucesso.";

            $query = " DELETE FROM produto WHERE cod = $cod";
                if(mysqli_query($conexao, $query)){
                echo "Produto2 excluído com sucesso.";

                }else{
                echo "Erro ao excluir o produto: " . mysqli_error($conexao);
                }
        } else{
            echo "Erro ao excluir o produto: " . mysqli_error($conexao);
        }
    }

    public function excluirCarrinho($cod){
        $conexao = $this->conectarBD();
        $query = "DELETE FROM carrinho WHERE cod = $cod";
        
        if(mysqli_query($conexao, $query)){
            echo "Removido com sucesso.";
        } else{
            echo "Erro ao excluir o produto: " . mysqli_error($conexao);
        }
    }

    public function cadastrarEndereco($endereco){
        $conexao = $this->conectarBD();
        $consulta = "INSERT INTO endereco (cod_cliente, cep, rua, numero, bairro, complemento) 
                     VALUES ('{$endereco->get_cod_cliente()}','{$endereco->get_cep()}', '{$endereco->get_rua()}','{$endereco->get_numero()}','{$endereco->get_bairro()}','{$endereco->get_complemento()}')";
                if(mysqli_query($conexao, $consulta)){
                    echo "Endereço cadastrado com sucesso.";
                } else{
                    echo "Erro ao cadastrar endereço: " . mysqli_error($conexao);
                }
    }

    public function retornarEndereco($usuarioLogado){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT cod FROM endereco WHERE cod_cliente = $usuarioLogado";
        $resultado = mysqli_query($conexao, $consulProd);
    
        // Verifica se a consulta retornou algum resultado
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Retorna o resultado da consulta diretamente
            return mysqli_fetch_assoc($resultado);
        } else {
            // Se não houver resultado, retorna null
            return null;
        }
    }

    public function iniciarVenda($venda, $listaProdutosCarrinho) {
        $conexao = $this->conectarBD();
        
        // Inserir a venda na tabela vendas
        $query = "INSERT INTO vendas(cliente_cod, valor_total, data_venda) 
                  VALUES (
                  '{$venda->getClienteCod()}', 
                  '{$venda->getValorTotal()}', 
                  '{$venda->getDataVenda()}')";
        
        if (mysqli_query($conexao, $query)) {
            // Obter o ID da venda recém-criada
            $idVenda = mysqli_insert_id($conexao);
            echo "Venda iniciada. ID da venda: " . $idVenda . "<br>";
            
            // Obter os produtos do carrinho
            $listaProdutos = $this->retornarProdutosCarrinho($venda->getClienteCod());
            
            while ($produto = mysqli_fetch_assoc($listaProdutos)) {
                if (is_array($produto)) {
                    // Preparar os dados para inserção na tabela itensVenda
                    $codProduto = $produto['cod_produto'];
                    $qtd = $produto['quantidade'];
                    $valorUnitario = $produto['valor_produto'];
                    $valorTotal = $qtd * $valorUnitario;
                    
                    // Inserir o produto na tabela itensVenda
                    $queryItem = "INSERT INTO itensVenda (codVenda, codProduto, qtd, valorUnitario, valorTotal) 
                                  VALUES ('$idVenda', '$codProduto', '$qtd', '$valorUnitario', '$valorTotal')";
                    
                    if (!mysqli_query($conexao, $queryItem)) {
                        echo "Problema ao inserir item na venda: " . mysqli_error($conexao) . "<br>";
                    }
                } else {
                    echo "O produto não é um array.<br>";
                }
            }
            
            // Atualizar o valor total da venda
            $this->atualizaValorVendas($idVenda);

            // Limpar o carrinho do cliente após o registro da venda
            $this->limparCarrinhoCliente($venda->getClienteCod());

            
            return true;
        } else {
            echo "Problema ao iniciar venda: " . mysqli_error($conexao);
            return false;
        }
    }
    
    public function atualizaValorVendas($idVenda) {
        $conexao = $this->conectarBD();
        
        // Calcular o total da venda
        $queryTotal = "SELECT SUM(valorTotal) as somaTotal FROM itensVenda WHERE codVenda = '$idVenda'";
        $result = mysqli_query($conexao, $queryTotal);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDaVenda = floatval($row['somaTotal']);
            
            // Atualizar o valor total na tabela vendas
            $queryUpdate = "UPDATE vendas SET valor_total = '$totalDaVenda' WHERE cod = '$idVenda'";
            
            if (!mysqli_query($conexao, $queryUpdate)) {
                echo "Erro ao atualizar o valor total da venda: " . mysqli_error($conexao);
            }
        } else {
            echo "Erro ao calcular o total da venda: " . mysqli_error($conexao);
        }
    }

    public function limparCarrinhoCliente($clienteCod) {
        $conexao = $this->conectarBD();
    
        // Query para deletar os produtos do carrinho do cliente
        $query = "DELETE FROM carrinho WHERE cliente_cod = '$clienteCod'";
    
        if (mysqli_query($conexao, $query)) {
            echo "Carrinho do cliente limpo com sucesso.<br>";
            return true;
        } else {
            echo "Erro ao limpar carrinho do cliente: " . mysqli_error($conexao) . "<br>";
            return false;
        }
    }
    
    public function retornarRelatorioVendas() {
        $conexao = $this->conectarBD();

        $sql = "
            SELECT 
                v.cod AS venda_cod, 
                v.valor_total, 
                v.data_venda, 
                c.nome AS cliente_nome, 
                c.sobrenome AS cliente_sobrenome, 
                e.rua, 
                e.numero, 
                e.bairro, 
                e.cep, 
                GROUP_CONCAT(p.nome SEPARATOR ', ') AS produtos,
                GROUP_CONCAT(iv.qtd SEPARATOR ', ') AS quantidades,
                GROUP_CONCAT(iv.valorTotal SEPARATOR ', ') AS valores_totais
            FROM 
                vendas v
                JOIN cliente c ON v.cliente_cod = c.cod
                LEFT JOIN endereco e ON e.cod_cliente = c.cod
                JOIN itensvenda iv ON v.cod = iv.codVenda
                JOIN produto p ON iv.codProduto = p.cod
            GROUP BY 
                v.cod
            ORDER BY 
                v.data_venda DESC
        ";
    
        $result = mysqli_query($conexao, $sql);
    
        if (!$result) {
            die('Erro na consulta: ' . mysqli_error($conexao));
        }
    
        return $result;
    }

    public function gerarJsonRelatorioVendas() {
        // Chama a função para obter os dados
        $result = $this->retornarRelatorioVendas();
        
        // Inicializa um array para armazenar os dados
        $dados = array();
        
        // Itera sobre o resultado e converte cada linha em um array associativo
        while ($row = mysqli_fetch_assoc($result)) {
            $dados[] = $row;
        }
        
        // Converte o array em JSON
        $json_data = json_encode($dados, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT para formatar o JSON com indentação
        
        // Especifica o caminho do arquivo na pasta /JSON/
        $caminhoArquivo = __DIR__ . '/JSON/relatorio_vendas.json';
        
        // Abre o arquivo para escrita (cria ou substitui)
        if (file_put_contents($caminhoArquivo, $json_data) === false) {
            return 'Erro ao escrever o arquivo JSON.';
        }
        
        return $json_data;
    }
    
    public function retornarQuantidadeCarrinho($usuarioLogado){
        $conexao = $this->conectarBD();

        $sql = "
            SELECT cliente_cod, COUNT(produto_cod) AS total_produtos
            FROM carrinho
           	WHERE cliente_cod = '$usuarioLogado';
        ";
    
        $quantidade = mysqli_query($conexao, $sql);
    
        if (!$quantidade) {
            die('Erro na consulta: ' . mysqli_error($conexao));
        }
    
        return $quantidade;
    }
    
    

    
    
    
    
    
    
    
    


}

?>