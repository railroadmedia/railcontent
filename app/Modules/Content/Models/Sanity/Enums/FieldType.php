<?php

namespace App\Modules\Content\Models\Sanity\Enums;

/**
 * Field Types supported by Sanity CMS.
 * @link https://www.sanity.io/docs/schema-types#types-8137822cbda1
 */
enum FieldType: string
{
    case Array = 'array';
    case Block = 'block';
    case Boolean = 'boolean';
    case Date = 'date';
    case Datetime = 'datetime';
    case Document = 'document';
    case File = 'file';
    case Geopoint = 'geopoint';
    case Image = 'image';
    case Number = 'number';
    case Object = 'object';
    case Reference = 'reference';
    case Slug = 'slug';
    case String = 'string';
    case Span = 'span';
    case Text = 'text';
    case URL = 'url';
}
