<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationDesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create ('sections', function (Blueprint $table){
            $table->increments('idsections');
            $table->string('lib',70);
            $table->string('abbr',70);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';/*a etudier*/
        });

        Schema::create ('promotions', function (Blueprint $table){
            $table->increments('idpromotions');
            $table->string('lib',70);
            $table->string('abbr',70);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';/*a etudier*/
        });
        Schema::create ('facultes', function (Blueprint $table){
            $table->increments('idfacultes');
            $table->string('lib',70);
            $table->string('abbr',70);
            $table->unsignedInteger('idsections');
            
            $table->foreign('idsections')
                  ->references('idsections')->on('sections');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });
        Schema::create ('auditoires', function (Blueprint $table){
            $table->increments('idauditoires');
            $table->string('lib',70);
            $table->string('abbr',70);
            $table->unsignedInteger('idsections');
            $table->unsignedInteger('idpromotions');
            $table->unsignedInteger('idfacultes');

            $table->foreign('idsections')
                  ->references('idsections')->on('sections');

            $table->foreign('idpromotions')
                  ->references('idpromotions')->on('promotions');

            $table->foreign('idfacultes')
                  ->references('idfacultes')->on('facultes');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });
        Schema::create ('etudiants', function (Blueprint $table){
            $table->increments('idetudiants');
            $table->string('matricule',70);
            $table->string('nom',70);
            $table->string('postnom',70)->nullable();
            $table->string('prenom',70)->nullable();
            $table->unsignedInteger('idauditoires');
            $table->enum('statut'[0,1])->default(1);
            
            $table->foreign('idauditoires')
                  ->references('idauditoires')->on('auditoires');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });
        Schema::create ('grades', function (Blueprint $table){
            $table->increments('idgrades');
            $table->string('lib',70);
            $table->string('abbr',70);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        // Schema::create ('roles', function (Blueprint $table){
        //     $table->increments('idroles');
        //     $table->string('lib',70);
        //     $table->string('abbr',70);
        //     $table->string('niveau',70);

        //     $table->engine = 'InnoDB';
        //     $table->charset = 'utf8';
        //     $table->collation= 'utf8_unicode_ci';/*a etudier*/
        // });

        Schema::create ('titulaires', function (Blueprint $table){
            $table->increments('idtitulaires');
            $table->string('matricule',70);
            $table->string('nom',70);
            $table->string('postnom',70)->nullable();
            $table->string('prenom',70)->nullable();
            $table->string('pseudo',70);
            $table->string('password',255);
            $table->unsignedInteger('idgrades');
            // $table->unsignedInteger('idroles');

            $table->foreign('idgrades')
                 ->references('idgrades')->on('grades');

            // $table->foreign('idroles')
                  // ->references('idroles')->on('roles');


            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        // Schema::create('users_roles', function (Blueprint $table) {
        //     $table->increments('idusers_roles');
        //     $table->string('lib',65);
        //     $table->unsignedInteger('level');

        //     $table->engine = 'InnoDB';
        //     $table->charset = 'utf8';
        //     $table->collation = 'utf8_unicode_ci';
        // });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('idusers');
            $table->string('username',45)->unique();
            $table->string('name',65);
            $table->string('first_name',65);
            $table->string('email',65)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('users_roles');
            $table->unsignedInteger('idsections')->nullable();
            $table->boolean('statut')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idsections')
                  ->references('idsections')->on('sections')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        // Schema::create ('users', function (Blueprint $table){
        //     $table->increments('idusers');
        //     $table->string('nom',70);
        //     $table->string('postnom',70);
        //     $table->string('prenom',70);
        //     $table->string('pseudo',70);
        //     $table->string('e_mail',70);
        //     $table->string('password',70);
        //     $table->unsignedInteger('idroles');
        //     $table->unsignedInteger('idsections');
            
                  

        //     $table->foreign('idroles')
        //           ->references('idroles')->on('roles');

        //      $table->foreign('idsections')
        //           ->references('idsections')->on('sections');

        //     $table->engine = 'InnoDB';
        //     $table->charset = 'utf8';
        //     $table->collation= 'utf8_unicode_ci';

        // });

        Schema::create ('cours', function (Blueprint $table){
            $table->increments('idcours');
            $table->string('lib',50);
            $table->smallInteger('ponderation');
            $table->unsignedInteger('idtitulaires')->nullable();
            $table->unsignedInteger('idauditoires');

            $table->foreign('idtitulaires')
                  ->references('idtitulaires')->on('titulaires');

            $table->foreign('idauditoires')
                  ->references('idauditoires')->on('auditoires');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        Schema::create ('type_cotes', function (Blueprint $table){
            $table->increments('idtype_cotes');
            $table->string('lib',70);
            $table->string('abbr',70);

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        Schema::create ('cotes', function (Blueprint $table){
            $table->increments('idcotes');
            $table->unsignedInteger('idetudiants');
            $table->unsignedInteger('idcours');
            $table->unsignedInteger('idtype_cotes');
            $table->smallInteger('cote');

            $table->foreign('idetudiants')
                  ->references('idetudiants')->on('etudiants');

            $table->foreign('idcours')
                  ->references('idcours')->on('cours');


           $table->foreign('idtype_cotes')
                  ->references('idtype_cotes')->on('type_cotes');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        Schema::create ('fiches_envoyes', function (Blueprint $table){
            $table->increments('idfiches_envoyes');
            $table->unsignedInteger('idcours');
            $table->unsignedInteger('idtype_cotes');
            $table->timestamps();

            $table->foreign('idcours')
                  ->references('idcours')->on('cours');


           $table->foreign('idtype_cotes')
                  ->references('idtype_cotes')->on('type_cotes');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation= 'utf8_unicode_ci';
        });

        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists ('cotes');
        Schema::dropIfExists ('type_cotes');
        Schema::dropIfExists ('cours');
        Schema::dropIfExists ('users');
        Schema::dropIfExists ('users_roles');
        Schema::dropIfExists ('titulaires');
        Schema::dropIfExists ('grades');
        Schema::dropIfExists ('etudiants');
        Schema::dropIfExists ('auditoires');
        Schema::dropIfExists ('facultes');
        Schema::dropIfExists ('promotions');
        Schema::dropIfExists ('sections');
    }
}
