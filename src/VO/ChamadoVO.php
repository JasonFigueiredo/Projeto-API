<?php

namespace Src\VO;

use Src\_Public\Util;

class ChamadoVO extends LogErroVO
{
   private $id;
   private $problema;
   private $laudo;
   private $equipamento;
   private $tecnico_atendimento_id;
   private $tecnico_encerramento_id;
   private $funcionario;
   private $alocar;
   private $data_abertura;
   private $hora_abertura;
   private $situacao;
   private $data_atendimento;
   private $hora_atendimento;
   private $data_encerramento;
   private $hora_encerramento;
   private $chamado_id;


   public function getChamadoId(): int
   {
      return $this->chamado_id;
   }
   public function setChamadoId(int $chamado_id): void
   {
      $this->chamado_id = $chamado_id;
   }
   public function getSituacao(): string
   {
      return $this->situacao;
   }
   public function setSituacao(string $situacao): void
   {
      $this->situacao = Util::RemoverTags($situacao);
   }
   public function getDataAbertura(): string
   {
      return $this->data_abertura;
   }
   public function setDataAbertura(string $data_abertura): void
   {
      $this->data_abertura = Util::RemoverTags($data_abertura);
   }
   public function getHoraAbertura(): string
   {
      return $this->hora_abertura;
   }
   public function setHoraAbertura(string $hora_abertura): void
   {
      $this->hora_abertura = Util::RemoverTags($hora_abertura);
   }

   public function getDataAtendimento(): string
   {
      return $this->data_atendimento;
   }
   public function setDataAtendimento(string $data_atendimento): void
   {
      $this->data_atendimento = Util::RemoverTags($data_atendimento);
   }

   public function getHoraAtendimento(): string
   {
      return $this->hora_atendimento;
   }
   public function setHoraAtendimento(string $hora_atendimento): void
   {
      $this->hora_atendimento = Util::RemoverTags($hora_atendimento);
   }

   public function getDataEncerramento(): string
   {
      return $this->data_encerramento;
   }
   public function setDataEncerramento(string $data_encerramento): void
   {
      $this->data_encerramento = Util::RemoverTags($data_encerramento);
   }

   public function getHoraEncerramento(): string
   {
      return $this->hora_encerramento;
   }
   public function setHoraEncerramento(string $hora_encerramento): void
   {
      $this->hora_encerramento = Util::RemoverTags($hora_encerramento);
   }


   public function getId(): int
   {
      return $this->id;
   }

   public function setId(int $id): void
   {
      $this->id = $id;
   }

   public function getProblema(): string
   {
      return $this->problema;
   }

   public function setProblema(string $problema): void
   {
      $this->problema = Util::RemoverTags($problema);
   }

   public function getLaudo(): string
   {
      return $this->laudo;
   }

   public function setLaudo(string $laudo): void
   {
      $this->laudo = Util::RemoverTags($laudo);
   }

   public function getEquipamentoId(): int
   {
      return $this->equipamento;
   }

   public function setEquipamentoId(int $equipamento): void
   {
      $this->equipamento = $equipamento;
   }

   public function getTecnicoAtendimentoId(): int
   {
      return $this->tecnico_atendimento_id;
   }

   public function setTecnicoAtendimentoId(int $tecnico_atendimento_id): void
   {
      $this->tecnico_atendimento_id = $tecnico_atendimento_id;
   }

   // Alias para compatibilidade com chamadas do frontend
   public function getIdTecnicoAtendimento(): int
   {
      return $this->tecnico_atendimento_id;
   }

   public function setIdTecnicoAtendimento(int $tecnico_atendimento_id): void
   {
      $this->tecnico_atendimento_id = $tecnico_atendimento_id;
   }

   public function getTecnicoEncerramentoId(): int
   {
      return $this->tecnico_encerramento_id;
   }

   public function setTecnicoEncerramentoId(int $tecnico_encerramento_id): void
   {
      $this->tecnico_encerramento_id = $tecnico_encerramento_id;
   }

   public function getIdFuncionario(): int
   {
      return $this->funcionario;
   }

   public function setIdFuncionario(int $funcionario): void
   {
      $this->funcionario = $funcionario;
   }

   public function getIdAlocar(): int
   {
      return $this->alocar;
   }

   public function setIdAlocar(int $alocar): void
   {
      $this->alocar = $alocar;
   }
}