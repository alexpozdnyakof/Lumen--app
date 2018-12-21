<?php

namespace App\Models\Datatable;

use Illuminate\Database\Eloquent\Model;

class TableCell extends Model
{
    protected $table = 'datatable_cells';
    public $timestamps = false;
    protected $fillable = ['id','value', 'created_at', 'updated_at', 'type', 'row'];
    public function row(){
        return $this->belongsTo(TableRow::class, 'id', 'row');
    }
    public function column(){
        return $this->belongsTo(TableColumn::class, 'id', 'type');
    }

}


