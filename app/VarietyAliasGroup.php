<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

/**
 * App\VarietyAliasGroup
 *
 * @property int $id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $creator
 * @property-read string $created_by_name
 * @property-read string $updated_by_name
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Variety[] $varieties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup owned()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VarietyAliasGroup whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class VarietyAliasGroup extends Model
{
    use AuditableTrait;

    public function varieties()
    {
        return $this->hasMany(Variety::class, 'alias_group_id');
    }
}
