<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string("jenis_koleksi");
            $table->string("nama_benda");
            $table->string("no_inv_lama");
            $table->string("no_inv_baru");
            $table->string("no_reg_baru");
            $table->string("no_reg_lama");
            $table->string("tempat_penyimpanan");
            $table->string("ukuran");
            $table->string("bahan");
            $table->string("teknik_pembuatan");
            $table->string("tempat_asal");
            $table->string("kab");
            $table->string("prov");
            $table->string("negara");
            $table->string("temp_pembuatan");
            $table->string("temp_temuan");
            $table->string("tahun_pembuatan");
            $table->string("guna_fungsi");
            $table->string("tgl_perolehan");
            $table->string("cara_perolehan");
            $table->string("tempat_perolehan");
            $table->string("kondisi");
            $table->string("deskripsi");
            $table->string("keterangan");
            $table->string("no_foto");
            $table->string("no_neg_film");
            $table->string("no_slide");
            $table->string("picture");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}
