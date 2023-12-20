<?php

namespace App\Api\LLM\OpenApi;

use App\Api\LLM\LanguageModel;
use App\Api\LLM\LanguageModelSettings;
use App\Api\LLM\LanguageModelType;
use OpenAI\Client;

class OpenAiLanguageModel implements LanguageModel
{
    private Client $client;

    public function __construct(){
        $this->client = \OpenAI::client(getenv('OPEN_AI_KEY'));
    }

    public function generate(string $prompt, string $systemPrompt, LanguageModelSettings $settings): string
    {
        $openAiModel = $this->getOpenAiModelBySettings($settings);

        $openAiModelParamsToGenerate = [
            'temperature' => $settings->getTemperature(),
            'model' => $openAiModel->value,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $prompt]
            ]
        ];

        $response = $this->client->chat()->create($openAiModelParamsToGenerate);
        return $response->choices[0]->message->content;
    }

    public function generateStream(string $prompt, string $systemPrompt, LanguageModelSettings $settings): mixed
    {
        $openAiModel = $this->getOpenAiModelBySettings($settings);

        $openAiModelParamsToGenerate = [
            'temperature' => $settings->getTemperature(),
            'model' => $openAiModel->value,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $prompt]
            ]
        ];

        return $this->client->chat()->createStreamed($openAiModelParamsToGenerate);
    }


    protected function getOpenAiModelBySettings(LanguageModelSettings $languageModelSettings): OpenAiModel
    {
        /** @var OpenAiModel $model */
        $model = match ($languageModelSettings->getLanguageModelType()) {
            LanguageModelType::NORMAL => OpenAiModel::GPT_3_5_TURBO,
            LanguageModelType::INTELLIGENT => OpenAiModel::GPT_4
        };

        return $model;
    }

    public function generateStreamWithConversation(string $prompt, string $systemPrompt, LanguageModelSettings $settings, array $messages): mixed
    {
        $messages = [];
        $openAiModel = $this->getOpenAiModelBySettings($settings);

        // ============ Prepare Messages ============
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];


        foreach ($messages as $message){
            if(!empty($message['prompt'])){
                $messages[] = ['role' => $message['role'], 'content' => $message['prompt']];
            }
        }
        $messages[] = ['role' => 'user', 'content' => $prompt];
        // ============ Prepare Messages ============

        $openAiModelParamsToGenerate = [
            'temperature' => $settings->getTemperature(),
            'model' => $openAiModel->value,
            'messages' => $messages
        ];

        return $this->client->chat()->createStreamed($openAiModelParamsToGenerate);
    }

    public function generateWithConversation(string $prompt, string $systemPrompt, LanguageModelSettings $settings, array $messagesUser): mixed
    {
        $messages = [];
        $openAiModel = $this->getOpenAiModelBySettings($settings);

        // ============ Prepare Messages ============
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];


        foreach ($messagesUser as $message){
            if(!empty($message['prompt'])){
                $messages[] = ['role' => $message['role'], 'content' => $message['prompt']];
            }
        }

        $messages[] = ['role' => 'user', 'content' => $prompt];
        // ============ Prepare Messages ============

        $openAiModelParamsToGenerate = [
            'temperature' => $settings->getTemperature(),
            'model' => $openAiModel->value,
            'messages' => $messages
        ];

        $response = $this->client->chat()->create($openAiModelParamsToGenerate);
        return $response->choices[0]->message->content;
    }
}
