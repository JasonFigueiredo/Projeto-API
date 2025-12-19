<?php

namespace Src\_Public;

class Util
{

    public static function IniciarSessao(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    public static function CriarSessao(int $id, string $nome): void
    {
        self::IniciarSessao();
        $_SESSION['cod'] = $id;
        $_SESSION['nome'] = $nome;
    }

    public static function CodigoLogado(): int
    {
        self::IniciarSessao();
        // Se não houver sessão (ambiente dev/API), usar fallback 4 para evitar erro
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] === '' || $_SESSION['cod'] === null) {
            return 4;
        }
        return (int) $_SESSION['cod'];
    }

    public static function NomeLogado(): string
    {
        self::IniciarSessao();
        return $_SESSION['nome'];
    }
    // deslogar finalizando as sessões
    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);
        self::ChamarPagina('http://localhost:9090/ControleOs/src/View/acesso/login');
    }
    public static function VerificarLogado()
    {
        self::IniciarSessao();
        if(!isset($_SESSION['cod']) || empty($_SESSION['cod']))
        {
            self::ChamarPagina('http://localhost:9090/ControleOs/src/View/acesso/login');
        }
    }
    // setar fuso horario
    private static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    // data atual
    public static function DataAtual()
    {
        self::SetarFusoHorario();
        return date('Y-m-d');
    }

    public static function HoraAtual()
    {
        self::SetarFusoHorario();
        return date('H:i');
    }

    public static function DataHoraAtual()
    {
        self::SetarFusoHorario();
        return date('Y-m-d H:i');
    }

    public static function TirarCaracteresEspeciais($palavra)
    {
        $especiais = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '\'', '"', ',', '<', '.', '>', '/', '?', '\\', '|');
        $palavra = str_replace($especiais, '', trim($palavra));
        return $palavra;
    }

    public static function RemoverTags($palavra)
    {
        $palavra = strip_tags($palavra);
        return $palavra;
    }

    public static function TratarDados($palavra)
    {
        $especiais = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '\'', '"', ',', '<', '.', '>', '/', '?', '\\', '|');
        $palavra = strip_tags($palavra);
        $palavra = str_replace($especiais, '', trim($palavra));
        return $palavra;
    }

    public static function ValidarNome($nome, $tamanhoMinimo = 2)
    {
        // Tratar dados primeiro
        $nomeTratado = self::TratarDados($nome);

        // Verificar se está vazio após tratamento
        if (empty($nomeTratado))
            return false;

        // Verificar tamanho mínimo
        if (strlen($nomeTratado) < $tamanhoMinimo)
            return false;

        // Verificar se não é apenas números
        if (is_numeric($nomeTratado))
            return false;

        return true;
    }


    public static function MostrarTipoUsuario(int $tipo): string
    {
        $tipoUsuario = '';
        switch ($tipo) {
            case USUARIO_ADM:
                $tipoUsuario = 'Administrador';
                break;
            case USUARIO_FUNCIONARIO:
                $tipoUsuario = 'Funcionário';
                break;
            case USUARIO_TECNICO:
                $tipoUsuario = 'Técnico';
                break;
        }
        return $tipoUsuario;
    }

    // Função para formatar o valor ATIVO e INATIVO e a com cores personalizadas
    public static function MostrarSituacao(int $sit): string
    {
        $situacao = '';

        switch ($sit) {
            case SITUACAO_ATIVO:
                $situacao = '<strong style="color: #008000;">ATIVO</strong>';
                break;
            case SITUACAO_INATIVO:
                $situacao = '<strong style="color: #ff0000ff;">INATIVO</strong>';
                break;
        }

        return $situacao;
    }

    public static function ChamarPagina($pag)
    {
        header("location: $pag.php");
        exit;
    }

    public static function MostrarDadosArray($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
        exit;
    }

    public static function CriptografarSenha($senha): string
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function VerificarSenha($senha_digitada, $senha_hash): bool
    {
        return password_verify($senha_digitada, $senha_hash);
    }
}
