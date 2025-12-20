<?php

namespace Src\_Public;

class Util
{
    public static function CreateTokenAuthentication(array $dados_user)
    {
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $payload = $dados_user;

        $header = json_encode($header);
        $payload = json_encode($payload);

        $header = base64_encode($header);
        $payload = base64_encode($payload);

        $sign = hash_hmac(
            "sha256",
            $header . '.' . $payload,
            SECRET,
            true
        );

        $sign = base64_encode($sign);
        $token = $header . '.' . $payload . '.' . $sign;
        return $token;
    }

    /**
     * Recupera o header Authorization de forma segura, com fallbacks.
     */
    public static function GetAuthorizationHeader(): ?string
    {
        // Tenta via apache_request_headers
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
            if (is_array($headers) && !empty($headers)) {
                // Normaliza chaves para minúsculas
                $headersLower = array_change_key_case($headers, CASE_LOWER);
                if (isset($headersLower['authorization']) && $headersLower['authorization'] !== '') {
                    return $headersLower['authorization'];
                }
            }
        }

        // Fallbacks comuns em diferentes servidores
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] !== '') {
            return $_SERVER['HTTP_AUTHORIZATION'];
        }
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) && $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] !== '') {
            return $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        }

        // getallheaders em alguns ambientes não-Apache
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            if (is_array($headers) && !empty($headers)) {
                $headersLower = array_change_key_case($headers, CASE_LOWER);
                if (isset($headersLower['authorization']) && $headersLower['authorization'] !== '') {
                    return $headersLower['authorization'];
                }
            }
        }

        // Fallback para cookie de token (definido no frontend)
        if (isset($_COOKIE['user_tkn']) && $_COOKIE['user_tkn'] !== '') {
            return 'Bearer ' . $_COOKIE['user_tkn'];
        }
        return null;
    }

    /**
     * Valida token JWT e retorna true/false
     */
    public static function AuthenticationTokenAccess(): bool
    {
        // Recupera o header Authorization com fallbacks
        $authHeader = self::GetAuthorizationHeader();
        if ($authHeader === null || $authHeader === '') {
            return false;
        }

        // Procura por esquema Bearer e extrai o token
        $tokenStr = null;
        if (preg_match('/Bearer\s+(\S+)/i', $authHeader, $m)) {
            $tokenStr = $m[1];
        } else {
            // Caso não venha com "Bearer ", tenta usar o header bruto
            $tokenStr = trim($authHeader);
        }

        // Token precisa ter 3 partes separadas por ponto
        $parts = explode('.', $tokenStr);
        if (count($parts) !== 3) {
            return false;
        }

        [$header, $payload, $sign] = $parts;

        // Recalcula a assinatura para validar
        $valid = hash_hmac('sha256', $header . '.' . $payload, SECRET, true);
        $valid = base64_encode($valid);

        // hash_equals para comparação segura
        return hash_equals($valid, $sign);
    }

    /**
     * Extrai dados do payload do JWT
     * Retorna array com dados ou null se inválido
     */
    public static function GetTokenData(): ?array
    {
        $authHeader = self::GetAuthorizationHeader();
        if ($authHeader === null || $authHeader === '') {
            return null;
        }

        // Extrai token
        $tokenStr = null;
        if (preg_match('/Bearer\s+(\S+)/i', $authHeader, $m)) {
            $tokenStr = $m[1];
        } else {
            $tokenStr = trim($authHeader);
        }

        $parts = explode('.', $tokenStr);
        if (count($parts) !== 3) {
            return null;
        }

        // Decodifica payload
        try {
            $payload = json_decode(base64_decode($parts[1]), true);
            return $payload;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Valida se o ID do usuário no token corresponde ao ID solicitado
     */
    public static function ValidateTokenOwnership(int $userId): bool
    {
        if (!self::AuthenticationTokenAccess()) {
            return false;
        }

        $tokenData = self::GetTokenData();
        if ($tokenData === null) {
            return false;
        }

        // Verifica se o cod_user do token corresponde ao userId solicitado
        return isset($tokenData['cod_user']) && (int)$tokenData['cod_user'] === $userId;
    }

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
        if (isset($_SESSION['cod']) && !empty($_SESSION['cod'])) {
            return;
        }

        // Tenta autenticar via token JWT (cookie/header)
        if (self::AuthenticationTokenAccess()) {
            $tokenData = self::GetTokenData();
            if ($tokenData && isset($tokenData['cod_user']) && isset($tokenData['nome'])) {
                // Popular sessão para compatibilidade com páginas antigas
                $_SESSION['cod'] = (int)$tokenData['cod_user'];
                $_SESSION['nome'] = $tokenData['nome'];
                return;
            }
        }

        // Se não autenticou, redireciona para login unificado
        self::ChamarPagina('http://localhost:9090/ControleOs/src/View/acesso/login.php');
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
