<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = "inventaris";
   
    protected $fillable = [
        "jenis_koleksi",
        "nama_benda",
        "no_inv_lama",
        "no_inv_baru",
        "no_reg_lama",
        "no_reg_baru",
        "tempat_penyimpanan",                    
        "ukuran",                    
        "bahan",                    
        "teknik_pembuatan",                    
        "tempat_asal",                    
        "negara",                    
        "prov",                    
        "kab",                    
        "temp_pembuatan",                    
        "temp_temuan",                    
        "tahun_pembuatan",                    
        "guna_fungsi",                    
        "tgl_perolehan",                    
        "cara_perolehan",                    
        "tempat_perolehan",                    
        "kondisi",                    
        "deskripsi",                    
        "keterangan",                    
        "no_foto",                    
        "no_neg_film",                    
        "no_slide",                    
        "picture",
        "user_id" 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
