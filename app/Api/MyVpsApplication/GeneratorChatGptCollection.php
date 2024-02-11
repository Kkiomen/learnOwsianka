<?php

namespace App\Api\MyVpsApplication;

use App\Api\MyVpsApplication\Dto\ChatGptCollectionRequestDto;
use Illuminate\Support\Facades\Http;

class GeneratorChatGptCollection
{
    const API_URL = 'http://51.83.128.170:215/api/';

    public function generateContentByCollection(array|ChatGptCollectionRequestDto $data): array
    {
        $suffixApi = 'generate/chat-gpt/collection/';

        if($data instanceof ChatGptCollectionRequestDto) {
            $preparedData = [$this->prepareDataToGenerate($data)];
        }else{
            foreach ($data as $key => $value) {
                $preparedData[$key] = $this->prepareDataToGenerate($value);
            }
        }

        $response = Http::post(static::API_URL . $suffixApi, $preparedData);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getGeneratedContentByIdExternal(int $id): array
    {
        $suffixApi = 'generate/chat-gpt/collection/' . $id;

        $response = Http::get(static::API_URL . $suffixApi);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function prepareDataToGenerate(ChatGptCollectionRequestDto $data): array
    {
        $result = [];

        $result['id_external'] = $data->getIdExternal();
        $result['model'] = $data->getModel();
        $result['temperature'] = $data->getTemperature();
        $result['type'] = $data->getType();

        $resultCollection = [];
        foreach ($data->getCollection() as $collection) {
            $resultCollection[] = [
                'id_external' => $collection->getIdExternal(),
                'prompt' => $collection->getPrompt(),
                'system' => $collection->getSystem(),
                'sort' => $collection->getSort(),
                'add_last_messages' => $collection->getAddLastMessage() ?? false
            ];
        }

        $result['collections'] = $resultCollection;

        return $result;
    }
}
