<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Type options used for Shopify Metafield entries.
 * @link https://shopify.dev/docs/apps/custom-data/metafields/types
 */
enum ShopifyMetafieldTypes: string
{
    case boolean = 'boolean';
    case color = 'color';
    case date = 'date';
    case date_time = 'date_time';
    case dimension = 'dimension';
    case json = 'json';
    case json_string = 'json_string';
    case money = 'money';
    case multi_line_text_field = 'multi_line_text_field';
    case decimal = 'number_decimal';
    case integer = 'number_integer';
    case rating = 'rating';
    case rich_text_field = 'rich_text_field';
    case single_line_text_field = 'single_line_text_field';
    case url = 'url';
    case volume = 'volume';
    case weight = 'weight';

}
