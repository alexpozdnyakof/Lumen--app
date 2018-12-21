<?php

namespace App\Models\Datatable;

use Illuminate\Database\Eloquent\Model;

class TableChange extends Model
{
    protected $table = 'datatable_changelog';
    public $timestamps = false;

    protected $fillable = ['id','datatable', 'update'];

    public function table(){
        return $this->hasMany(DataTable::class, 'id', 'datatable');
    }
}


