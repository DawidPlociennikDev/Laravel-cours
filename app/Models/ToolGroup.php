<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolGroup extends Model
{
    use HasFactory;

    public function tools() {
        return $this->belongsToMany(Tool::class, 'tool_toolgroup');
    }
}
