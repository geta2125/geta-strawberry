<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multipleupload extends Model
{
    protected $table = 'multipleuploads'; // pastikan sesuai nama tabel
    protected $fillable = ['ref_table', 'ref_id', 'filename'];
}
