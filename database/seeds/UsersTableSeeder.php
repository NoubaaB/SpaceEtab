<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,27)->create();
        // factory(\App\Formateur::class,15)->create();
        App\Admin::create(["user_id"=>27]);
        App\Formateur::create([
            "nom_module"=> "Langage de programmation structurée",
            "user_id"=>1
        ]);
        factory(\App\Stagiaire::class,25)->create();
        //factory(\App\Filiere::class)->create();
        factory(\App\Passage::class,25)->create();
        factory(\App\Finformation::class,25)->create();
        App\Filiere::create([
            "nom"=>"Techniques de Développement Informatique",
            "groupe"=>"1ere Année"
        ]);
        App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Commerce",
            "groupe"=>"1ere Année"
        ]);
        App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Gestion des Entreprises",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Secrétariat de Direction",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Techniques de Secrétariat de Direction",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Hygiène et Qualité",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Meunerie",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"TS de Maintenance en Industrie Agroalimentaire",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"TS en Emballage et Conditionnement",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"TS en Fabrication Industrie Agroalimentaire",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Infographie",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Audio visuel Option : Image",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Audio visuel Option : Son",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Audio visuel Option : Montage",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Décors et Accessoires",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Effets Spéciaux",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé Conducteur de Travaux : TP",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé Géomètre Topographe",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé Gros œuvres",
            "groupe"=>"1ere Année"
        ]);App\Filiere::create([
            "nom"=>"Technicien Spécialisé Patrimoine Design",
            "groupe"=>"1ere Année"
        ]);
        App\Filiere::create([
            "nom"=>"Technicien Spécialisé en Modélisme Industriel",
            "groupe"=>"1ere Année"
        ]);
        // factory(\App\Module::class)->create();
        factory(\App\Module::class,25)->create(['nom'=>'Arabe','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Anglais Technique','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Communication Ecrite Et Orale','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Métier et formation','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'L’entreprise et son environnement','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Notions de mathématiques appliquées','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Veille technologique','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Production de documents','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Communication interpersonnelle','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Logiciels d’application','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Techniques de programmation structurée','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Langage de programmation structurée','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Programmation événementielle','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Programmation orientée objet','filiere_id'=>1]);
        factory(\App\Module::class,25)->create(['nom'=>'Installation d’un poste informatique','filiere_id'=>1]);
        
        // App\Module::create([
        //     "nom"=>"Arabe",
        //     "coefficient"=>2,
        //     "formateur_id"=>1,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Anglais Technique",
        //     "coefficient"=>2,
        //     "formateur_id"=>2,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Communication Ecrite Et Orale",
        //     "coefficient"=>2,
        //     "formateur_id"=>3,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Métier et formation",
        //     "coefficient"=>2,
        //     "formateur_id"=>4,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"L’entreprise et son environnement",
        //     "coefficient"=>2,
        //     "formateur_id"=>5,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Notions de mathématiques appliquées",
        //     "coefficient"=>2,
        //     "formateur_id"=>6,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Veille technologique",
        //     "coefficient"=>2,
        //     "formateur_id"=>7,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Production de documents",
        //     "coefficient"=>2,
        //     "formateur_id"=>8,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Communication interpersonnelle",
        //     "coefficient"=>2,
        //     "formateur_id"=>9,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Logiciels d’application",
        //     "coefficient"=>2,
        //     "formateur_id"=>10,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Techniques de programmation structurée",
        //     "coefficient"=>2,
        //     "formateur_id"=>11,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Langage de programmation structurée",
        //     "coefficient"=>2,
        //     "formateur_id"=>12,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Programmation événementielle",
        //     "coefficient"=>2,
        //     "formateur_id"=>13,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Programmation orientée objet",
        //     "coefficient"=>2,
        //     "formateur_id"=>14,
        //     "filiere_id"=>1,
        // ]);
        // App\Module::create([
        //     "nom"=>"Installation d’un poste informatique",
        //     "coefficient"=>2,
        //     "formateur_id"=>15,
        //     "filiere_id"=>1,
        // ]);

        factory(\App\Message::class, 100)->create();
        
    }
}
