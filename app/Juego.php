<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model{
    protected $table = 'juegos';

    protected $hidden = [
        'id_creador',
    ];
    

    //Relaciones
    protected function desarrollador(){
        return $this->belongsTo('App\User', 'id_creador', 'id');
    }

    protected function categorias(){
        return $this->belongsToMany('App\Categoria', 'juegos_categorias', 'id_juego', 'id_categoria');
    }

    protected function comentarios(){
        return $this->hasMany('App\Comentario', 'id_juego', 'id');
    }

    protected function plataformas(){
        return $this->belongsToMany('App\Plataforma', 'juegos_plataformas', 'id_juego', 'id_plataforma');
    }

    protected function reportes(){
        return $this->hasMany('App\Reporte', 'id_juego', 'id');
    }

    protected function logros(){
        return $this->hasMany('App\Logro', 'id_juego', 'id');
    }

    protected function productos(){
        return $this->hasMany('App\Tienda', 'id_juego', 'id');
    }

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->slug = $model->generateSlug();
            $model->hash = $model->generateHash();
        });
    }

    //Otros
    private function generateSlug(){
        $num = 0;
        do{
            $slug = $this->slugify($this->nombre.(++$num == 1 ? '' : $num));
        }while(Juego::where("slug", $slug)->count() > 0);
        return $slug;
    }

    private function slugify($text){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) 
            return 'n-a';
        return $text;
    }

    //Añade todos los comentarios con sus sub comentarios al juego y los 
    //datos del usuario quien ha escrito el comentario.
    public function addComentarios(){
        $this->addSubComentario(@$this->comentarios);
        return $this;
    }

    //Metodo recursivo para obtener todos los sub comentarios
    private function addSubComentario($comentarios){
        if(!is_null($comentarios)){
            foreach ($comentarios as $comentario){
                $comentario->user;
                $this->addSubComentario(@$comentario->subComentarios);
            }
        }
    }
    
    private function generateHash(){
        do{
            $hash = md5(uniqid());
        }while(Juego::where("hash", $hash)->count() > 0);
        return $hash;
    }
}
