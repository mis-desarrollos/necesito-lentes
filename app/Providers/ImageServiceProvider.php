<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Imageintervention;

use App\Models\Image;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *Metodo para subir imagenes
     *
     *@param $image -> imagen enviada en la peticion
     *@param $disk -> Disco en el que sera guardado
     *
     *@return id de la imagen guardada en la base de datos
     *
     */
    public static function save($image,$disk='public')
    {
        //creamos un nombre para la imagen
        $nombreImagen = uniqid() . '.jpg';

        //hacemos la imagen con la libreria
        $imagenIntervencion = Imageintervention::make($image);
        // Comprime la imagen
        $imagenIntervencion->encode('jpg', 60); // 60 es la calidad de compresión (0-100)
        //guardamos en storage
        $img_name = Storage::disk($disk)->put('photos/'.$nombreImagen, $imagenIntervencion);
        //guardamos en base de datos
        $image = new Image(array(
            "path" => 'photos/'.$nombreImagen,
            "disk" => $disk,
            "key"  => uniqid(),
        ));

        $image->save();

        return $image->id;
    }

    /**
     *Metodo para eliminar una imagen
     *
     *@param $image_id -> id de la imagen guardada en la base de datos
     *
     *@return verdadero o falso
     *
     */
    public static function delete($image_id)
    {
        //Obtenemos la imagen
        $old_image = Image::find($image_id);
        if($old_image){
            //Verificamos que no sea un archivo default
            if(strpos($old_image->key, 'default')!==false){
                return false;
            }
            //Lo borramos del servidor
            Storage::disk($old_image->disk)->delete($old_image->path);
            //Lo borramos de la base de datos
            if ($old_image->delete()) {
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    /**
     *Metodo para obtener una imagen
     *
     *@param $image_id -> id de la imagen guardada en la base de datos
     *
     *@return Datos de la imagen
     *
     */
    public static function get($image_id)
    {
        $image = Image::find($image_id);
        return $image;
    }

    /**
     *Metodo para obtener la ruta real de una imagen
     *
     *@param $key -> Llave de la imagen en la base de datos
     *
     *@return url real de la imagen
     *
     */
    public static function getPath($key)
    {
        $image = Image::where("key", $key)->first();
        if($image){
            $url = Storage::disk($image->disk)->getDriver()->getAdapter()->applyPathPrefix($image->path);
            return $url;
        }
        return null;
    }

    /**
     *Metodo para url publica de una imagen
     *
     *@param $image_id -> id de la imagen guardada en la base de datos
     *
     *@return url publica de la imagen (visitable)
     *
     */
    public static function getUrl($image_id)
    {
        $image = Image::find($image_id);
        if($image){
            return url("/img/".$image->key);
        }
        return null;
    }

    /**
     *Metodo para obtener etiqueta html de una imagen
     *
     *@param $image_id -> id de la imagen guardada en la base de datos
     *
     *@return etiqueta html con la imagen
     *
     */
    public static function getImg($image_id)
    {
        $url = self::getUrl($image_id);
        if($url){
            $img = "<img src='".$url."' width='50px'>";
            return $img;
        }

        return null;
    }
}
