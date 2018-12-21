<?php

namespace App\Models\Datatable;

use Illuminate\Database\Eloquent\Model;

class TableColumn extends Model
{
    protected $table = 'datatable_columns';
    public $timestamps = false;

    protected $fillable = ['id','name', 'author', 'status', 'description', 'created_at', 'updated_at', 'table'];

    public function table(){
        return $this->belongsTo(DataTable::class, 'id', 'table');
    }
}


