<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentName',
        'documentPath',
        'lastUpdatedBy',
    ];

    public function users(){
        //document_user is the pivot table
        return $this->belongsToMany(User::class, 'document_user');
    }
}
