<?php

declare(strict_types=1);

namespace SharpAPI\FinanceParseInvoice;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

class InvoiceParserClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPInvoiceParser/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Parse an invoice file and return the async status URL.
     *
     * Supported formats: PDF, TIFF/TIF, JPG/JPEG/JPE, PNG.
     * Max file size: 100 MB. Max filename length: 255 characters.
     *
     * @api
     * @throws GuzzleException
     */
    public function parseInvoice(string $invoiceFilePath): string
    {
        $response = $this->makeRequest(
            'POST',
            '/invoice/parse',
            [],
            $invoiceFilePath
        );

        return $this->parseStatusUrl($response);
    }
}
