<?php

namespace App\Models;

class EstagioModel
{
    private $id;
    private $osId;
    private $nome;
    private $finishedAt;
    private $finishedBy;
    private $status;

    public function __construct($id = null, $osId = null, $nome = null, $finishedAt = null, $finishedBy = null, $status = null)
    {
        $this->id = $id;
        $this->osId = $osId;
        $this->nome = $nome;
        $this->finishedAt = $finishedAt;
        $this->finishedBy = $finishedBy;
        $this->status = $status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setOSId($osId)
    {
        $this->osId = $osId;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;
    }

    public function setFinishedBy($finishedBy)
    {
        $this->finishedBy = $finishedBy;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOSId()
    {
        return $this->osId;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    public function getFinishedBy()
    {
        return $this->finishedBy;
    }

    public function getStatus()
    {
        return $this->status;
    }
}