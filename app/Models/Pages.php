<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    public $table = 'pages';
    protected $fillable = ['titulo', 'descricao', 'rota', 'icon', 'permissao', 'situacao', 'page_superior_id'];

    public function isMenuPai(){        
        return Pages::where('page_superior_id', '=', $this->id)->count() >= 1 ? true : false;
    }

}
