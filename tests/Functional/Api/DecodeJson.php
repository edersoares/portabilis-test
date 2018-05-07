<?php

namespace Tests\Functional\Api;

trait DecodeJson
{
    public function decodeJsonResponse($response)
    {
        $json = (string) $response->getBody();

        return json_decode($json, true);
    }
}