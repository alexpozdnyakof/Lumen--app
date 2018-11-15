<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableRow extends Model
{
    protected $table = 'datatable_rows';
    public $timestamps = false;
    protected $fillable = ['id','order', 'status', 'table', 'author', 'created_at', 'updated_at'];

    public function table(){
        return $this->belongsTo(DataTable::class, 'id', 'table');
    }
    public function cells(){
        return $this->hasMany(TableCell::class, 'row', 'id');
    }

}


