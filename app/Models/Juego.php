<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\UserJugando;
use App\Models\JuegoPlataforma;
use App\Models\JuegoCategoria;
use App\Models\JuegoFileSystem;
use App\Models\Logro;
use App\Models\Tienda;
use App\Models\Reporte;
use App\Models\Comentario;

class Juego extends Model{
    protected $table = 'juegos';

    protected $hidden = [
        'id_creador',
    ];
    

    //Relaciones
    protected function desarrollador(){
        return $this->belongsTo('App\Models\User', 'id_creador', 'id');
    }

    public function categorias(){
        return $this->belongsToMany('App\Models\Categoria', 'juegos_categorias', 'id_juego', 'id_categoria');
    }

    protected function comentarios(){
        return $this->hasMany('App\Models\Comentario', 'id_juego', 'id')->orderBy("created_at", "desc");
    }

    protected function files(){
        return $this->hasMany('App\Models\JuegoFileSystem', 'id_juego', 'id');
    }

    protected function plataformas(){
        return $this->belongsToMany('App\Models\Plataforma', 'juegos_plataformas', 'id_juego', 'id_plataforma');
    }

    protected function reportes(){
        return $this->hasMany('App\Models\Reporte', 'id_juego', 'id');
    }

    public function logros(){
        return $this->hasMany('App\Models\Logro', 'id_juego', 'id');
    }

    protected function productos(){
        return $this->hasMany('App\Models\Tienda', 'id_juego', 'id');
    }

    //Eventos de modelo
    protected static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->slug = $model->generateSlug();
            $model->hash = $model->generateHash();
        });

        self::deleting(function($model){
            UserJugando::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            JuegoPlataforma::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            JuegoCategoria::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            JuegoFileSystem::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            Logro::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            Tienda::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            Reporte::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });
            Comentario::where("id_juego", $model->id)->get()->each(function($relacion){
                $relacion->delete();
            });

            if(Storage::disk('local')->exists("private/juegos/$model->slug"))
                Storage::disk('local')->deleteDirectory("private/juegos/$model->slug", true);
        });
    }

    //Otros
    public function setUrlImagePublic(){
        $this->img = route("storage.portadaJuego", ["slug" => $this->slug]);
    }
    
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

    //Añade la url al juego
    public function setUrl(){
        $this->url = route('juego', ['slug' => $this->slug]);
        return $this;
    }

    //Añade todos los comentarios con sus sub comentarios al juego y los 
    //datos del usuario quien ha escrito el comentario.
    public function getComentarios(){
        $this->getSubComentario(@$this->comentarios);
        return $this;
    }

    //Metodo recursivo para obtener todos los sub comentarios
    private function getSubComentario($comentarios){
        if(!is_null($comentarios)){
            foreach ($comentarios as $comentario){
                $comentario->user;
                $this->getSubComentario(@$comentario->subComentarios);
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
