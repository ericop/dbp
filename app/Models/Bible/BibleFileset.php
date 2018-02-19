<?php

namespace App\Models\Bible;

use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bible\BibleFileset
 *
 * @property string $id
 * @property string $bible_id
 * @property string|null $variation_id
 * @property string $name
 * @property string $set_type
 * @property int $hidden
 * @property int $response_time
 * @property int|null $organization_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Bible\Bible $bible
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bible\BibleFile[] $files
 * @property-read \App\Models\Organization\Organization|null $organization
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bible\BibleFileSetPermission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bible\BibleFileSetPermission[] $users
 * @mixin \Eloquent
 * @property string $size_code
 * @property string $size_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereBibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereSetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereSizeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereSizeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereVariationId($value)
 * @property string $bucket_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereBucketId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bible\BibleFilesetTag[] $meta
 * @property string|null $hash_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bible\BibleFilesetConnection[] $connections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereHashId($value)
 * @property string $set_type_code
 * @property string $set_size_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereSetSizeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bible\BibleFileset whereSetTypeCode($value)
 */
class BibleFileset extends Model
{

	public $primaryKey = 'id';
	public $incrementing = false;
	protected $keyType = "string";
	protected $hidden = ["created_at","updated_at","response_time","hidden","bible_id","hash_id"];
	protected $fillable = ['name','set_type','organization_id','variation_id','bible_id'];

	public function bible()
	{
		return $this->hasManyThrough(Bible::class,BibleFilesetConnection::class, 'hash_id','id','hash_id','bible_id');
	}

	public function connections()
	{
		return $this->hasMany(BibleFilesetConnection::class,'hash_id','hash_id');
	}

	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

	public function files()
	{
		return $this->HasMany(BibleFile::class,'hash_id', 'hash_id');
	}

	public function meta()
	{
		return $this->HasMany(BibleFilesetTag::class,'hash_id','hash_id');
	}
}
