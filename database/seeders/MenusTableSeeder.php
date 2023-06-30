<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menus')->insert([
            "name"=>"Administradores",
            "description"=>"Administradores de tu sitio",
            "route"=>"/users",
            "icon"=>"fa fa-users-cog",
            "permissions_name"=>"users",
            "position"=>1
        ]);
        DB::table('menus')->insert([
            "name"=>"Clientes",
            "description"=>"Clientes de tu sitio",
            "route"=>"/customers",
            "icon"=>"fa fa-users",
            "permissions_name"=>"customers",
            "position"=>2
        ]);

        DB::table('menus')->insert([
            "name"=>"Opticas",
            "description"=>"Opticas de tu sitio",
            "route"=>"/opticians",
            "icon"=>"fa fa-store",
            "permissions_name"=>"opticians",
            "position"=>3
        ]);



        DB::table('menus')->insert([
            "name"=>"Materiales",
            "description"=>"Materiales de tu sitio",
            "route"=>"/materials",
            "icon"=>"fa fa-cubes",
            "permissions_name"=>"materials",
            "position"=>4
        ]);

        DB::table('menus')->insert([
            "name"=>"Recubrimientos",
            "description"=>"Recubrimientos de tu sitio",
            "route"=>"/coverings",
            "icon"=>"fas fa-circle-notch",
            "permissions_name"=>"coverings",
            "position"=>5
        ]);


        DB::table('menus')->insert([
            "name"=>"Paquetes",
            "description"=>"Paquetes de tu sitio",
            "route"=>"/packages",
            "icon"=>"fa fa-box",
            "permissions_name"=>"packages",
            "position"=>6
        ]);
        
        DB::table('menus')->insert([
            "name"=>"Armazones",
            "description"=>"Armazones de tu sitio",
            "route"=>"/products",
            "icon"=>"fa fa-glasses",
            "permissions_name"=>"products",
            "position"=>7
        ]);
        
        DB::table('menus')->insert([
            "name"=>"Pedidos",
            "description"=>"Pedidos de tu sitio",
            "route"=>"/orders",
            "icon"=>"fa fa-file",
            "permissions_name"=>"orders",
            "position"=>8
        ]);

        

       
        
        DB::table('menus')->insert([
            "name"=>"Examenes de la vista",
            "description"=>"Examenes de la vista de tu sitio",
            "route"=>"/exams",
            "icon"=>"fa fa-eye",
            "permissions_name"=>"exams",
            "position"=>9
        ]);


        DB::table('menus')->insert([
            "name"=>"Comunicados",
            "description"=>"Comunicados de tu sitio",
            "route"=>"/blogs",
            "icon"=>"fa fa-newspaper",
            "permissions_name"=>"blogs",
            "position"=>10
        ]);

        DB::table('menus')->insert([
            "name"=>"Banners",
            "description"=>"Banners de tu sitio",
            "route"=>"/banners",
            "icon"=>"fa fa-images",
            "permissions_name"=>"banners",
            "position"=>11
        ]);
        DB::table('menus')->insert([
            "name"=>"Newslatter",
            "description"=>"Newslatter de tu sitio",
            "route"=>"/newslatter",
            "icon"=>"fas fa-mail-bulk",
            "permissions_name"=>"newslatter",
            "position"=>12
        ]);


        
        DB::table('menus')->insert([
            "name"=>"Estado de cuenta",
            "description"=>"Estado de cuenta de tu sitio",
            "route"=>"/accountstatus",
            "icon"=>"fas fa-file-invoice-dollar",
            "permissions_name"=>"accountstatus",
            "position"=>20
        ]);




        DB::table('menus')->insert([
            "name"=>"Extras",
            "description"=>"Configuraciones extra de tu sitio",
            "route"=>"/extras",
            "icon"=>"fa fa-circle",
            "permissions_name"=>"configuration",
            "position"=>30
        ]);

        $extra=Menu::where('name','Extras')->first();
        DB::table('menus')->insert([
            "name"=>"Terminos y Condiciones",
            "description"=>"Terminos y Condiciones",
            "route"=>"/terminos-condiciones",
            "icon"=>"fa fa-hand-paper-o",
            "parent"=>$extra->id,
            "permissions_name"=>"configuration"
        ]);
        
        DB::table('menus')->insert([
            "name"=>"Aviso de privacidad",
            "description"=>"",
            "route"=>"/aviso-privacidad",
            "icon"=>"fa fa-hand-paper-o",
            "parent"=>$extra->id,
            "permissions_name"=>"configuration"
        ]);

        /*DB::table('menus')->insert([
            "name"=>"Preguntas frecuentes",
            "description"=>"",
            "route"=>"/preguntas-frecuentes",
            "icon"=>"fa fa-hand-paper-o",
            "parent"=>$extra->id,
            "permissions_name"=>"configuration"
        ]);

        DB::table('menus')->insert([
            "name"=>"Información de contacto",
            "description"=>"",
            "route"=>"/informacion",
            "icon"=>"fa fa-hand-paper-o",
            "parent"=>$extra->id,
            "permissions_name"=>"configuration"
        ]);

        DB::table('menus')->insert([
            "name"=>"Configuracion",
            "description"=>"Configuracion de tu sitio",
            "icon"=>"fa fa-cogs",
            "permissions_name"=>"configuration",
            "position"=>20
        ]);
        
        $conf=Menu::where('name','Configuracion')->first();
        DB::table('menus')->insert([
            "name"=>"Roles",
            "description"=>"Roles de tu sitio",
            "route"=>"/roles",
            "icon"=>"fa fa-hand-paper-o",
            "parent"=>$conf->id,
            "permissions_name"=>"configuration"
        ]);
        //nuevo
        DB::table('menus')->insert([
            "name"=>"Clientes",
            "description"=>"clientes",
            "route"=>"/customers",
            "icon"=>"fa fa-users",
            "permissions_name"=>"customers",
            "position"=>2
        ]);

        DB::table('menus')->insert([
            "name"=>"Pedidos",
            "description"=>"Pedidos de tu sitio",
            "route"=>"/orders",
            "icon"=>"fa fa-file",
            "permissions_name"=>"orders",
            "position"=>3
        ]);

        DB::table('menus')->insert([
            "name"=>"Productos",
            "description"=>"Productos de tu sitio",
            "route"=>"/products",
            "icon"=>"fa fa-box",
            "permissions_name"=>"products",
            "position"=>4
        ]);

        DB::table('menus')->insert([
            "name"=>"Categorias",
            "description"=>"Categorias de tu sitio",
            "route"=>"/categories",
            "icon"=>"fa fa-folder",
            "permissions_name"=>"categories",
            "position"=>5
        ]);

        DB::table('menus')->insert([
            "name"=>"Subcategorias",
            "description"=>"Subcategorias de tu sitio",
            "route"=>"/subcategories",
            "icon"=>"fa fa-folder-open",
            "permissions_name"=>"subcategories",
            "position"=>6
        ]);

        DB::table('menus')->insert([
            "name"=>"Blog",
            "description"=>"Noticias de tu sitio",
            "route"=>"/blogs",
            "icon"=>"fa fa-file",
            "permissions_name"=>"blogs",
            "position"=>8
        ]);*/
        
    }
}
