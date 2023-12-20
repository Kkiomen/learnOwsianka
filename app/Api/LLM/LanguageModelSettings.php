<?php

namespace App\Api\LLM;

class LanguageModelSettings
{
    private LanguageModelType $languageModelType = LanguageModelType::NORMAL;
    private float $temperature = 0.7;

    public function getLanguageModelType(): LanguageModelType
    {
        return $this->languageModelType;
    }

    public function setLanguageModelType(LanguageModelType $languageModelType): self
    {
        $this->languageModelType = $languageModelType;

        return $this;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }
}
