<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->string('gender')->comment('male=>1;female=>2;transgender=>3;')->after('profile_picture')->nullable();
             $table->string('ethinicity')->comment('white=>1, black=>2, Asia=>3, Amerindian/Alaska native=>5, native Hawaiian/Pacific Islander=>6, mixed ethnicit=>7')->after('gender')->nullable();
             $table->string('dob')->after('ethinicity')->nullable();
             $table->string('preferred_lang')->after('dob')->comment('English=>english;Spanish=>spanish;Chinease=>chinease;Portguese=>portguese;Arabic=>arabic;hindi=>arabic')->after('dob')->nullable();
             $table->string('height')->after('preferred_lang')->nullable();
             $table->string('skin_color')->after('height')->comment('Extremely fair skin=>extremely_fair_skin;Fair Skin=>fair_skin;Medium Skin=>medium_skin;Olive Skin=>olive_skin;Brown Skin=>brown_skin;Black Skin=>black_skin')->nullable();
             $table->string('body_type')->after('skin_color')->comment('Endomorph=>endomorph;Mesomorph=>mesomorph;Ectomorph=>ectomorph;')->nullable();
             $table->string('bio')->after('body_type')->comment('short description about the person')->nullable();


      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ethinicity');
        });
    }
}
