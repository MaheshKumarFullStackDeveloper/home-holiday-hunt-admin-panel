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
           
           $table->enum('gender', ['1','2','3'])->default('1')->comment("1:male,2:female,3:transgender")->after('profile_picture')->nullable();
            
           $table->enum('sexual_orientation', ['1','2','3','4'])->default('1')->comment("1:Straight,2:Gay,3:Lesbian,4:Bisexual")->after('profile_picture')->nullable();   

            $table->enum('ethinicity', ['1','2','3','4','5','6','7'])->default('1')->comment("1:White,2:Black,3:Asia,4:Amerindian/Alaska(native),5:native Hawaiian/Pacific Islander,6:mixed ethnicit")->after('gender')->nullable();

             $table->date('dob')->after('ethinicity')->nullable();;
             
              $table->enum('preferred_lang', ['1','2','3','4','5','6'])->default('1')->comment("1:English,2:Spanish,3:Chinease,4:Portuguese,5:Arabic,6:Hindi")->after('dob')->nullable();
 
              
            $table->string('height')->comment('in cm')->after('preferred_lang')->nullable();
            $table->string('weight')->comment('in kg')->after('height')->nullable();
            
            $table->enum('skin_color', ['1','2','3','4','5','6'])->default('1')->comment("1:Extremely fair skin,2:Fair Skin,3:Medium Skin,4:Olive Skin,5:Brown Skin,6:Black Skin")->after('weight')->nullable();
            
                         $table->enum('body_type', ['1','2','3'])->default('1')->comment("1:Endomorph,2:Mesomorph,3:Ectomorph")->after('skin_color')->nullable();
 

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
            $table->dropColumn(['gender','ethinicity','dob','preferred_lang','height','skin_color','body_type','bio','weight','sexual_orientation']);
        });
    }
}
