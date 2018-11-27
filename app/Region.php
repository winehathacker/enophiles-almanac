<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use Yajra\Auditable\AuditableTrait;

/**
 * App\Region
 *
 * @property int $id
 * @property string $name
 * @property int|null $country_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Region|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Region[] $outerRegions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Region[] $subregions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property string|null $searchable
 * @property-read \App\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Region[] $districts
 * @property-read string $created_by_name
 * @property-read string $updated_by_name
 * @property-read \App\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region owned()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereSearchable($value)
 * @property bool $is_country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Region whereIsCountry($value)
 */
class Region extends Model
{
    use AuditableTrait,
        Searchable;

    protected $fillable = ['name', 'is_country'];

    protected $hidden = ['searchable'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function outerRegions()
    {
        return $this->belongsToMany(self::class, 'region_relationships', 'child_id', 'parent_id');
    }

    public function subregions()
    {
        return $this->belongsToMany(self::class, 'region_relationships', 'parent_id', 'child_id');
    }

    public function country()
    {
        return $this->belongsTo(self::class);
    }

    public function districts()
    {
        return $this->hasMany(self::class, 'country_id', 'id');
    }

    /**
     * Find all continents in the system.
     *
     * A continent is defined here as a region that has no country and no outer regions.
     *
     * @return Collection
     */
    public static function continents(): Collection
    {
        return self::newQuery()
            ->whereCountryId(null)
            ->whereDoesntHave('outerRegions')
            ->get();
    }

    public static function countries(): Collection
    {
        /**
         * select c.*, count(sub.country_id) as count_states from regions c
        left join regions sub on c.id = sub.country_id
        group by c.id, sub.country_id
        having count(sub.country_id) > 0;
         */
        return self::query()
            ->select('regions.*')
            ->leftJoin('regions as sub', 'sub.country_id', '=', 'regions.id')
            ->groupBy('regions.id', 'sub.country_id')
            ->havingRaw('count(sub.country_id) > 0')
            ->get();
    }

    /*
     * As needed, the following query patterns can be used to find all relations, regardless of depth.
SELECT r.name, r.id, rr.parent_id FROM regions r
  	JOIN region_relationships rr on rr.child_id = r.id;

-- Get all children of a node
WITH RECURSIVE included_regions(name, id) AS (
    SELECT r.name, r.id, rr.parent_id FROM regions r
  	LEFT JOIN region_relationships rr on rr.child_id = r.id
    WHERE rr.parent_id = 2
  UNION
    SELECT r.name, r.id, 0
  	FROM regions r
  	LEFT JOIN region_relationships rr on rr.child_id = r.id
  	INNER JOIN included_regions ir on rr.parent_id = ir.id
  )
SELECT name, id
FROM included_regions;

-- Get all parents of a node
WITH RECURSIVE included_regions(name, id) AS (
    SELECT r.name, r.id, rr.child_id FROM regions r
  	LEFT JOIN region_relationships rr on rr.parent_id = r.id
    WHERE rr.child_id = 5
  UNION
    SELECT r.name, r.id, 0
  	FROM regions r
  	LEFT JOIN region_relationships rr on rr.parent_id = r.id
  	INNER JOIN included_regions ir on rr.child_id = ir.id
  )
SELECT name, id
FROM included_regions;
     */
}
