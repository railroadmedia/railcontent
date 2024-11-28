<?php

namespace App\Modules\Content\Models\Sanity;

use App\Modules\Content\Models\Sanity\Enums\FieldType;
use App\Modules\Content\Models\Sanity\Structure\Field;
use App\Modules\Content\Models\Sanity\Structure\Group;
use App\Modules\Content\Models\Sanity\Structure\ListItemPreview;
use App\Modules\Content\Models\Sanity\Structure\Reference;
use App\Modules\Content\Models\Sanity\Structure\Validation\Integer;
use App\Modules\Content\Models\Sanity\Structure\Validation\Max;
use App\Modules\Content\Models\Sanity\Structure\Validation\Min;
use App\Modules\Content\Models\Sanity\Structure\Validation\Required;
use Modules\Content\Models\Sanity\Structure\Block;
use Modules\Content\Models\Sanity\Structure\BrandField;
use Modules\Content\Models\Sanity\Structure\StatusField;

/**
 * Abstract class to represent a contentType schema in Sanity
 */
abstract class BaseSanityContentTypeModel extends BaseSanityModel
{
    protected function getCommonFields(Group $group, bool $includeLicense = true, bool $includeDescription = true): array
    {
        $permissionReference = new Reference([['type' => 'permission']], options: ['disableNew' => false]);
        $licenseReference = new Reference([['type' => 'license']], options: ['disableNew' => false]);

        $defaultFields = [
            new Field(FieldType::String, 'title', validation: [new Required()], group:$group),
            new Field(FieldType::Slug, 'slug', options:['source' => 'title','isUnique' => 'IsUniqueAcrossBrand'], hidden: "({document}) => !document?.title", validation: [new Required()], group:$group),
            new BrandField($group),
            new StatusField($group),
            new Field(FieldType::Number, 'xp', 'XP', validation: [new Min(0), new Integer()], group:$group),
            new Field(FieldType::Number, 'total_xp', 'Total XP', hidden: "({document}) => !document?.xp", readOnly: "true", group:$group),
            new Field(FieldType::Datetime, 'published_on', options: ['dateformat' => 'YYYY-MM-DD '], group:$group),
            new Field(FieldType::Array, 'permission', 'Permissions', of: $permissionReference, inputComponent: 'RolesBasedPermissionsInput', group:$group),
            new Field(
                FieldType::Number,
                'difficulty',
                validation: [new Min(0), new Max(10)],
                inputComponent: 'DifficultyInput',
                group:$group
            ),
            new Field(FieldType::String, 'difficulty_string', 'Difficulty String', readOnly: "true", group:$group),
            new Field(FieldType::Boolean, 'hide_from_recsys', 'Hide from recsys', group:$group),
            new Field(FieldType::Image, 'thumbnail', 'Thumbnail', group:$group),
            new Field(FieldType::Number, 'railcontent_id', 'MWP Railcontent ID', readOnly: "true", group:$group), //web_url_path
            new Field(FieldType::String, 'web_url_path', 'MWP web_url_path', readOnly: "true", group:$group),
        ];
        if ($includeLicense) {
            $defaultFields[] = new Field(FieldType::Array, 'license', 'License Information', of: $licenseReference, group:$group);
        }
        if ($includeDescription) {
            $defaultFields[] = new Field(FieldType::Array, 'description', 'Description', of: new Block(), group:$group);
        }
        return $defaultFields;
    }

    protected function getDefaultPreview(): ListItemPreview
    {
        return new ListItemPreview('title', 'brand', 'thumbnail');
    }


}
