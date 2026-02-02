![SharpAPI GitHub cover](https://sharpapi.com/sharpapi-github-laravel-bg.jpg "SharpAPI PHP Client")

# Invoice Parser for PHP 8

## 🎯 Extract structured data from invoices (PDF/TIFF/JPG/PNG) — powered by SharpAPI AI.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sharpapi/php-invoice-parser.svg?style=flat-square)](https://packagist.org/packages/sharpapi/php-invoice-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/sharpapi/php-invoice-parser.svg?style=flat-square)](https://packagist.org/packages/sharpapi/php-invoice-parser)

Check the full documentation on the [Invoice Parsing API](https://sharpapi.com/en/catalog/ai/accounting-finance/invoice-parser) page.

---

## Quick Links

| Resource | Link |
|----------|------|
| **Main API Documentation** | [Authorization, Webhooks, Polling & More](https://documenter.getpostman.com/view/31106842/2s9Ye8faUp) |
| **Postman Documentation** | [View Docs](https://documenter.getpostman.com/view/31106842/2sBXVeGsaE) |
| **Product Details** | [SharpAPI.com](https://sharpapi.com/en/catalog/ai/accounting-finance/invoice-parser) |
| **SDK Libraries** | [GitHub - SharpAPI SDKs](https://github.com/sharpapi) |

---

## Requirements

- PHP >= 8.0

---

## Installation

### Step 1. Install the package via Composer:

```bash
composer require sharpapi/php-invoice-parser
```

### Step 2. Visit [SharpAPI](https://sharpapi.com/) to get your API key.

---

## What it does

This package uploads an invoice file to the SharpAPI AI endpoint and returns a status URL to poll for results. When the job completes, you can fetch a structured JSON containing parsed invoice data (seller, buyer, line items, financials, tax details, and more).

---

## Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use SharpAPI\FinanceParseInvoice\InvoiceParserClient;
use GuzzleHttp\Exception\GuzzleException;

$invoicePath = __DIR__ . '/invoice.pdf'; // make sure this file exists

$client = new InvoiceParserClient(apiKey: 'your_api_key_here');

try {
    // submit parsing job
    $statusUrl = $client->parseInvoice($invoicePath);

    // Optional: adjust polling settings
    $client->setApiJobStatusPollingInterval(10); // seconds
    $client->setApiJobStatusPollingWait(180);    // seconds total wait

    // fetch results when ready
    $result = $client->fetchResults($statusUrl)->toArray();
    print_r($result);
} catch (GuzzleException $e) {
    // Handle SharpAPI or network errors
    echo $e->getMessage();
}
```

---

## Example Response

```json
{
    "data": {
        "type": "api_job_result",
        "id": "c09ad101-209f-460f-afaf-4fd9a735f79d",
        "attributes": {
            "status": "success",
            "type": "invoice_parse",
            "result": {
                "document": {
                    "type": "invoice",
                    "original_type_label": "",
                    "is_copy": false,
                    "copy_type": null
                },
                "invoice": {
                    "invoice_number": "D7BDFA00-0019",
                    "issue_date": "2025-12-07",
                    "due_date": "2025-12-07",
                    "document_date": null,
                    "order_date": null,
                    "delivery_date": null,
                    "shipping_date": null,
                    "pricing_date": null,
                    "currency": "USD",
                    "exchange_rate": null,
                    "page_info": "1 of 1",
                    "amount_in_words": "",
                    "notes": "",
                    "remarks": "",
                    "delivery_instructions": "",
                    "terms_and_conditions": [],
                    "late_payment_interest_rate": null
                },
                "references": {
                    "delivery_order_number": "",
                    "purchase_order_number": "",
                    "sales_order_number": "",
                    "customer_reference": "",
                    "external_document_number": "",
                    "grn_number": "",
                    "route_number": "",
                    "lorry_number": "",
                    "serial_number": "",
                    "batch_number": "",
                    "other_references": []
                },
                "e_invoice": {
                    "uuid": "",
                    "e_invoice_code": "",
                    "e_invoice_type": "",
                    "e_invoice_version": "",
                    "submission_id": "",
                    "submission_document_id": "",
                    "submission_long_id": "",
                    "submission_status": "",
                    "validation_datetime": null,
                    "digital_signature_present": false,
                    "validated_link": "",
                    "original_e_invoice_ref": "",
                    "qr_code_present": false
                },
                "seller": {
                    "name": "OpenAl, LLC",
                    "trade_name": "OpenAl",
                    "registration_number": "",
                    "tin": "",
                    "sst_id": "",
                    "gst_id": "",
                    "vat_id": "GB434338990",
                    "msic_code": "",
                    "business_activity": "",
                    "address": {
                        "street_line_1": "548 Market Street",
                        "street_line_2": "PMB 97273",
                        "city": "San Francisco",
                        "state": "California",
                        "postcode": "94104-5401",
                        "country": "US"
                    },
                    "phone": "",
                    "fax": "",
                    "email": "",
                    "website": "",
                    "bank_details": [],
                    "contact_person": {
                        "name": "",
                        "role": "",
                        "phone": "",
                        "email": ""
                    }
                },
                "buyer": {
                    "name": "A2Z WEB LTD",
                    "trade_name": "",
                    "registration_number": "",
                    "tin": "",
                    "brn": "",
                    "sst_id": "",
                    "gst_id": "",
                    "vat_id": "",
                    "customer_account_number": "",
                    "billing_address": {
                        "location_name": "",
                        "street_line_1": "Unit 4e Enterprise Court, Farfield",
                        "street_line_2": "Park",
                        "city": "Rotherham",
                        "state": "",
                        "postcode": "S63 5DB",
                        "country": "GB"
                    },
                    "delivery_address": {
                        "recipient_name": "",
                        "location_name": "",
                        "street_line_1": "Unit 10 Enterprise Court",
                        "street_line_2": "Farfield Park",
                        "city": "Rotherham",
                        "state": "",
                        "postcode": "S63 5DB",
                        "country": "GB"
                    },
                    "delivery_address_same_as_billing": false,
                    "phone": "",
                    "fax": "",
                    "email": "",
                    "attention_to": {
                        "name": "",
                        "phone": "",
                        "email": ""
                    }
                },
                "sales_info": {
                    "salesperson_name": "",
                    "salesperson_code": "",
                    "salesperson_phone": "",
                    "sales_agent": "",
                    "sales_location": "",
                    "sales_department": "",
                    "outlet_name": ""
                },
                "financials": {
                    "subtotal": 15.57,
                    "gross_amount": null,
                    "total_discount_amount": null,
                    "shipping_charge": null,
                    "delivery_fee": null,
                    "total_excl_tax": 15.57,
                    "total_tax_amount": 3.11,
                    "service_tax_amount": null,
                    "total_incl_tax": 18.68,
                    "rounding_adjustment": null,
                    "total_payable": 18.68,
                    "amount_paid": null,
                    "amount_due": 18.68,
                    "tax_details": [
                        {
                            "tax_type": "VAT",
                            "tax_rate": 20,
                            "taxable_amount": 15.57,
                            "tax_amount": 3.11
                        }
                    ]
                },
                "line_items": [
                    {
                        "line_number": 1,
                        "item_code": "",
                        "stock_code": "",
                        "barcode": "",
                        "description": "OpenAl API usage credit",
                        "classification_code": "",
                        "country_of_origin": "",
                        "quantity": 1,
                        "free_quantity": null,
                        "unit_of_measure": "unit",
                        "unit_of_measure_raw": "",
                        "pack_size": "",
                        "total_units": null,
                        "weight": null,
                        "weight_uom": "",
                        "unit_price": 15.57,
                        "discount_percent": null,
                        "discount_amount": null,
                        "subtotal": 15.57,
                        "tax_rate": 20,
                        "tax_type": "VAT",
                        "tax_amount": 3.11,
                        "total_excl_tax": 15.57,
                        "total_incl_tax": 18.68,
                        "expiry_date": null,
                        "batch_lot_number": "",
                        "service_start_date": null,
                        "service_end_date": null
                    }
                ],
                "payment": {
                    "payment_terms": "",
                    "payment_terms_days": null,
                    "payment_method": "",
                    "payment_date": null,
                    "payment_reference": "",
                    "jompay_biller_code": "",
                    "jompay_ref_1": ""
                },
                "logistics": {
                    "shipping_method": "",
                    "vehicle_number": "",
                    "driver_name": "",
                    "delivery_zone": "",
                    "delivery_time_constraint": "",
                    "carton_count": null,
                    "total_volume": null,
                    "total_weight": null,
                    "goods_received_confirmation": false,
                    "received_by": "",
                    "receiver_signature_present": false
                }
            }
        }
    }
}
```

---

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

---

## Credits

- [A2Z WEB LTD](https://github.com/a2zwebltd)
- [Dawid Makowski](https://github.com/makowskid)
- Boost your [PHP AI](https://sharpapi.com/) capabilities!

---

## License

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE.md)

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---
## Social Media

🚀 For the latest news, tutorials, and case studies, don't forget to follow us on:
- [SharpAPI X (formerly Twitter)](https://x.com/SharpAPI)
- [SharpAPI YouTube](https://www.youtube.com/@SharpAPI)
- [SharpAPI Vimeo](https://vimeo.com/SharpAPI)
- [SharpAPI LinkedIn](https://www.linkedin.com/products/a2z-web-ltd-sharpapicom-automate-with-aipowered-api/)
- [SharpAPI Facebook](https://www.facebook.com/profile.php?id=61554115896974)
