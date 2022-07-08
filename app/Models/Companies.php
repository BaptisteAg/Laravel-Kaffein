<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    // Link company to company details
    public function details()
    {
        return $this->hasOne(CompaniesDetails::class);
    }
}
