<?php

namespace App\Api\MyVpsApplication\Dto;

class ChatGptCollectionRequestDto
{
    private ?int $idExternal;
    private ?ChatGptCollectionRequestModelDto $model;
    private ?string $temperature;
    private ?string $type;

    /**
     * @var ChatGptCollectionDto[]
     */
    private array $collection = [];

    public function getIdExternal(): ?int
    {
        return $this->idExternal;
    }

    public function setIdExternal(?int $idExternal): self
    {
        $this->idExternal = $idExternal;

        return $this;
    }

    public function getModel(): ?ChatGptCollectionRequestModelDto
    {
        return $this->model;
    }

    public function setModel(?ChatGptCollectionRequestModelDto $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(?string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function setCollection(array $collection): self
    {
        $this->collection = $collection;

        return $this;
    }


}
