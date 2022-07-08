<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesDetails extends Model
{
    use HasFactory;

    // Link company details to company
    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }
}
