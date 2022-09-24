<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
    private const DEFAULT_API_CONTENT_TYPE = 'json';

    protected const CONTENT_TYPES = [
        'json' => 'application/json',
    ];

    protected function buildResponseData (int $statusCode, string $message, array $data = []) : array
    {
        $responseData = compact('statusCode', 'message', 'data');

        $responseData['ok'] = ($statusCode >= 200 && $statusCode < 400) ? true : false;

        return $responseData;
    }

    protected function transformData(array $data, string $type = self::DEFAULT_API_CONTENT_TYPE) : array
    {   
        if (!in_array($type, array_keys(self::CONTENT_TYPES))) {
            throw new \Exception('Content type not found for transforming data into.', 500);
        }

        $result = [
            'contentType' => self::CONTENT_TYPES[$type],
        ];

        switch ($type) {
            case 'json':
                $result['data'] = $this->transformIntoJson($data);
                break;
        }

        return $result;
    }

    protected function transformIntoJson(array $data) : string
    {
        return json_encode($data);
    }

    private function getIncomingHeaders(Request $request) : array
    {
        $incomingHeaders = $request->getHeaders();
        $incomingHeaders = array_change_key_case($incomingHeaders, CASE_LOWER);

        return $incomingHeaders;
    }

    protected function existsContentTypeInHeaders(Request $request) : bool
    {
        $incomingHeaders = $this->getIncomingHeaders($request);

        return array_key_exists('content-type', $incomingHeaders);
    }

    private function getIncomingContentTypesAsStr(Request $request)
    {
        $incomingHeaders = $this->getIncomingHeaders($request);

        $incomingContentTypes = $incomingHeaders['content-type'];        // an array of strings (headers)
        $incomingContentTypesStr = strtolower(implode('', $incomingContentTypes));

        return $incomingContentTypesStr;
    }

    protected function isIncomingContTypeSupported(Request $request) : bool
    {
        $incomingContentTypesStr = $this->getIncomingContentTypesAsStr($request);
        $supported = false;
        
        return str_contains($incomingContentTypesStr, self::DEFAULT_API_CONTENT_TYPE);
    }

    protected function outputResponse(Response $response, array $responseData, int $statusCode) : Response
    {
        $response->getBody()->write($responseData['data']);

        return $response
            ->withHeader('Content-Type', $responseData['contentType'])
            ->withStatus($statusCode);
    }
}