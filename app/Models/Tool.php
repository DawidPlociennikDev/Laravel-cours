<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = ['name', 'counter', 'description'];

    public function repairs() {
        return $this->hasMany(Repair::class);
    }

    public function toolgroups() {
        return $this->belongsToMany(ToolGroup::class, 'tool_toolgroup');
    }
}
