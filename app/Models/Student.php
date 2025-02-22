<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model {

	protected $fillable = [
		'displayName',
		'major_id',
		'level',
		'branch',
		'imageUrl'
	];

	protected $hidden = [
		'updated_at',
		'created_at',
	];

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function major(): HasOne {
		return $this->hasOne(Major::class);
	}

	use HasFactory;
}
