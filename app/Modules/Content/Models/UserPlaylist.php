<?php

namespace App\Modules\Content\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Modules\Brand\Enums\Brand;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\UserManagementSystem\Models\User;

/**
 * App\Modules\Content\Models\UserPlaylist
 *
 * @property integer $id
 * @property string $brand
 * @property string $type
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $thumbnail_url
 * @property string $first_item_thumbnail_url
 * @property string $category
 * @property int $private
 * @property int $duration
 * @property Carbon $last_progress
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserPlaylist extends Model
{
    protected $table = 'railcontent_user_playlists';
    protected $fillable = ['user_id', 'type', 'brand', 'name', 'description', 'thumbnail_url', 'category', 'private', 'created_at', 'first_item_thumbnail_url'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(UserPlaylistContent::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(UserPlaylistLike::class, 'playlist_id');
    }

    public function scopeOfBrand(Builder $query, Brand $brand): Builder
    {
        return $query->where("{$this->table}.brand", $brand->value);
    }

    public function scopeSortBy(Builder $query, string $column, string $direction = 'desc'): Builder
    {
        if ($column == 'name') {
            return $query->orderBy('name', 'asc');
        } elseif ($column == 'pinned') {
            return $query->leftJoin('railcontent_pinned_playlists as pinned', function ($join) {
                $join->on('pinned.playlist_id', '=', "{$this->table}.id");
            })->select(
                "{$this->table}.*"
            )
                ->selectRaw('IF( pinned.id IS NULL, FALSE, TRUE) as  isPinned')
              ->orderByRaw('isPinned desc, pinned.created_at ' . $direction);
        } elseif ($column == 'most_recent') {
            return $query->select(
                '*',
                \DB::raw('GREATEST(' .
                                           "{$this->table}.created_at, COALESCE("
                                          . "{$this->table}.updated_at, 0), COALESCE(last_progress, 0)) as datemax")
            )
                ->orderBy('datemax', 'desc');
        } else {
            // Default sorting if the column is not recognized
            return $query->orderBy($column, $direction);
        }
    }

    public function scopeSearchTerm(Builder $query, $term = null): Builder
    {
        if (!$term) {
            return $query;
        }

        if (config('railcontent.search_in_playlist_items_name', false)) {
            $query->where(function (Builder $builder) use ($term) {
                $termWildcard = '%' . $term . '%';

                // Search in playlist name
                $builder->where('name', 'LIKE', $termWildcard);

                // Search in related playlist items' content and name if exists
                $builder->orWhereExists(function (\Illuminate\Database\Query\Builder $subQuery) use ($termWildcard) {
                    $subQuery->select('railcontent_user_playlist_content.user_playlist_id')
                        ->from('railcontent_user_playlist_content')
                        ->whereRaw(
                            'railcontent_user_playlist_content.user_playlist_id = ' .
                             "{$this->table}.id"
                        )
                        ->where(function (\Illuminate\Database\Query\Builder $contentQuery) use ($termWildcard) {
                            $contentQuery->where('content_name', 'LIKE', $termWildcard)
                                ->orWhere('playlist_item_name', 'LIKE', $termWildcard);
                        });
                });
            });
        } else {
            // Simple search in playlist name
            $query->where('name', 'LIKE', '%' . $term . '%');
        }

        return $query;
    }

    public function scopeFilterOptions(Builder $query, $userId, $brand = null, $term = null): Builder
    {
        $brand = $brand ?? config('railcontent.brand');

        return $query->select('category')
            ->selectRaw('COUNT(id) as playlistsCount, GROUP_CONCAT(id) as playlistIds')
            ->where('user_id', $userId)
            ->where('brand', $brand)
            ->when($term, fn ($q) => $q->searchTerm($term))
            ->groupBy('category');
    }

}
