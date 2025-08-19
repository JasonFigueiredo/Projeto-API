<?php

namespace Src\_Public;

class Util
{
    public static function CodigoLogado()
    {
        return 1;
    }

    private static function SetarFusoHorario()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

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
}
