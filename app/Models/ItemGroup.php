<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\itemSubGroup;
use App\Models\Inventorysetting;

class ItemGroup extends Model
{
    use HasFactory;
    public function itemsubgroup()
    {
        return $this->hasMany(itemSubGroup::class); 
    }
    public function InventorySetting()
    {
        return $this->hasMany(itemSubGroup::class); 
    }
}
