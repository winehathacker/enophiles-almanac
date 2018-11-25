<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Yajra\Auditable\AuditableTrait;

/**
 * App\Variety
 *
 * @property int $id
 * @property string $name
 * @property int $alias_group_id
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereAliasGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property-read \App\User|null $creator
 * @property-read string $created_by_name
 * @property-read string $updated_by_name
 * @property-read \App\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety owned()
 * @property-read \App\VarietyAliasGroup|null $aliasGroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Variety[] $aliases
 * @property string|null $searchable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Variety whereSearchable($value)
 */
class Variety extends Model
{
    use AuditableTrait,
        Searchable;

    protected $fillable = ['name'];

    protected $hidden = ['searchable'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function aliasGroup()
    {
        return $this->belongsTo(VarietyAliasGroup::class, 'alias_group_id');
    }

    public function aliases()
    {
        return $this->hasMany(Variety::class, 'alias_group_id', 'alias_group_id')->whereKeyNot($this->id);
    }

    public function aliasTo(Variety $alias): void
    {
        if ($alias->alias_group_id == null || $alias->alias_group_id !== $this->alias_group_id) {
            // If the existing alias group will be down to a single item, delete it
            if ($this->alias_group_id && $this->aliases->count() === 1) {
                // Delete the old group
                $this->aliasGroup->delete();
            }

            // If the alias already has a group, use that, otherwise, create a new group and add both
            // varieties to it.
            if ($alias->aliasGroup != null) {
                $aliasGroup = $alias->aliasGroup;
            } else {
                $aliasGroup = VarietyAliasGroup::create();
                $alias->aliasGroup()->associate($aliasGroup);
                $alias->saveOrFail();
            }

            $this->aliasGroup()->associate($aliasGroup);
        }
    }

    public function removeFromAlias(): void
    {
        if (!$this->alias_group_id) {
            return;
        }

        if ($this->aliases()->count() === 1) {
            $this->aliasGroup->delete();
        } else {
            $this->aliasGroup()->dissociate();
        }
    }
}
