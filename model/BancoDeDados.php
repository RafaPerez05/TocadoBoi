<?php
class BancoDeDados{

    private static $instance;

    private $host;
    private $login;
    private $senha;
    private $dataBase;

    public function __construct($Host, $Login, $Senha, $DataBase){
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

    // Inserção na tabela produto
    $consulProd = "INSERT INTO produto (nome, fabricante, descricao, valor, imagem_path, sexo, tipo, tamanho, material) 
                   VALUES ('{$produto->get_Nome()}', '{$produto->get_Fabricante()}', '{$produto->get_Descricao()}', '{$produto->get_Valor()}', '{$produto->get_Imagem()}', '{$produto->get_Sexo()}', '{$produto->get_Tipo()}', '{$produto->get_Tamanho()}', '{$produto->get_Material()}')";
    if (mysqli_query($conexao, $consulProd)) {
        // Obtendo o ID do produto inserido
        $produtoId = mysqli_insert_id($conexao);

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
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulProd);
        return $listaProdutos;
    }
    
    public function retornarProdutosCarrinho($usuarioLogado) {
        $conexao = $this->conectarBD();
        $consulProd = "SELECT c.cod AS codigo_carrinho, p.nome AS nome_produto, p.imagem_path AS caminho_imagem, p.valor AS valor_produto, c.quantidade AS quantidade
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

    public function excluirProdutos($cod){
        $conexao = $this->conectarBD();
        
        $query = "DELETE FROM produto WHERE cod = $cod";
        
        if(mysqli_query($conexao, $query)){
            echo "Produto excluído com sucesso.";
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
        mysqli_query($conexao,$consulta);
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
    
    


}

?>