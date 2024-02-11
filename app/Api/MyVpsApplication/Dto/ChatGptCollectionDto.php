<?php

namespace App\Api\MyVpsApplication\Dto;

class ChatGptCollectionDto
{
    private ?string $idExternal;
    private ?string $prompt;
    private ?string $system;
    private ?int $sort;

    private ?bool $addLastMessage = true;

    public function getIdExternal(): ?string
    {
        return $this->idExternal;
    }

    public function setIdExternal(?string $idExternal): self
    {
        $this->idExternal = $idExternal;

        return $this;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(?string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getSystem(): ?string
    {
        return $this->system;
    }

    public function setSystem(?string $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getAddLastMessage(): ?bool
    {
        return $this->addLastMessage;
    }

    public function setAddLastMessage(?bool $addLastMessage): self
    {
        $this->addLastMessage = $addLastMessage;

        return $this;
    }
}
