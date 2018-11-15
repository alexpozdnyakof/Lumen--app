<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTable extends Model
{
    protected $table = 'datatable_tables';
    public $timestamps = false;

    protected $fillable = ['id','name', 'created_at', 'author'];

    public function columns(){
        return $this->hasMany(TableColumn::class, 'table', 'id');
    }
    public function rows(){
        return $this->hasMany(TableRow::class, 'table', 'id');
    }
    public function changes(){
        return $this->hasMany(TableChange::class, 'datatable', 'id');
    }
}


