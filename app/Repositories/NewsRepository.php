<?php

namespace App\Repositories;

use App\Models\Inventaris;
use App\Models\News;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsRepository implements RepositoryInterface
{

    private $model;

    public function __construct(Inventaris $news)
    {
        $this->model = $news;
    }

    public function get()
    {
        $data = $this->model->orderBy("id", "DESC")->get();
        return $data;
    }
    public function getLastActive($howMany)
    {
        $data = $this->model::where("status", "=", "1")->orderBy("id", "DESC")->limit($howMany)->get();
        return $data;
    }
    
    public function getByCategory($category_id)
    {
        $data = $this->model::where("category_id", "LIKE", "%$category_id%")->orderBy("id", "DESC")->get();
        return $data;
    }
    
    public function getPaginate($howMany)
    {
        $data = $this->model::paginate($howMany);
        return $data;
    }

    public function getBySlug($slug)
    {
        $data = $this->model::where("jenis_koleksi", "LIKE", $slug)->orderBy("id", "DESC")->limit(1)->first();
        return $data;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }
    public function store($request)
    {
        try {
            // Validate
            $validator = Validator::make($request->all(), [
                "picture" => "required",
                "jenis_koleksi" => "required",
                "nama_benda" => "required",
                "deskripsi" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            // Getting picture name after uploaded
            $pictureName = $this->uploadPictureHelper($request);

            try {
                $this->model::create([
                    "jenis_koleksi" => $request->jenis_koleksi,
                    "nama_benda" => $request->nama_benda,
                    "no_inv_lama" => $request->no_inv_lama,
                    "no_inv_baru" => $request->no_inv_baru,
                    "no_reg_lama" => $request->no_reg_lama,
                    "no_reg_baru" => $request->no_reg_baru,
                    "tempat_penyimpanan" => $request->tempat_penyimpanan,                    
                    "ukuran" => $request->ukuran,                    
                    "bahan" => $request->bahan,                    
                    "teknik_pembuatan" => $request->teknik_pembuatan,                    
                    "tempat_asal" => $request->tempat_asal,                    
                    "negara" => $request->negara,                    
                    "prov" => $request->prov,                    
                    "kab" => $request->kab,                    
                    "temp_pembuatan" => $request->temp_pembuatan,                    
                    "temp_temuan" => $request->temp_temuan,                    
                    "tahun_pembuatan" => $request->tahun_pembuatan,                    
                    "guna_fungsi" => $request->guna_fungsi,                    
                    "tgl_perolehan" => $request->tgl_perolehan,                    
                    "cara_perolehan" => $request->cara_perolehan,                    
                    "tempat_perolehan" => $request->tempat_perolehan,                    
                    "kondisi" => $request->kondisi,                    
                    "deskripsi" => $request->deskripsi,                    
                    "keterangan" => $request->keterangan,                    
                    "no_foto" => $request->no_foto,                    
                    "no_neg_film" => $request->no_neg_film,                    
                    "no_slide" => $request->no_slide,                    
                    "picture" => $pictureName,
                    "user_id" => Auth::user()->id
                ]);
                return ["status"=>"success", "message"=>"Data stored succesfully."];
                
            } catch (\Throwable $th) {
                return ["status"=>"error", "message"=>$th->getMessage()];
            }
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }

    public function search($keyword)
    {
        $data = $this->model::where("title", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "jenis_koleksi" => "required",
                "nama_benda" => "required",
                "deskripsi" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            // Update with picture
            if ($request->hasFile('picture')) {
                // Getting picture name after uploaded
                $pictureName = $this->uploadPictureHelper($request);
                $news = $this->model::find($id);
                $oldPictureName = $news->picture;
                $news->update([
                    "jenis_koleksi" => $request->jenis_koleksi,
                    "nama_benda" => $request->nama_benda,
                    "no_inv_lama" => $request->no_inv_lama,
                    "no_inv_baru" => $request->no_inv_baru,
                    "no_reg_lama" => $request->no_reg_lama,
                    "no_reg_baru" => $request->no_reg_baru,
                    "tempat_penyimpanan" => $request->tempat_penyimpanan,                    
                    "ukuran" => $request->ukuran,                    
                    "bahan" => $request->bahan,                    
                    "teknik_pembuatan" => $request->teknik_pembuatan,                    
                    "tempat_asal" => $request->tempat_asal,                    
                    "negara" => $request->negara,                    
                    "prov" => $request->prov,                    
                    "kab" => $request->kab,                    
                    "temp_pembuatan" => $request->temp_pembuatan,                    
                    "temp_temuan" => $request->temp_temuan,                    
                    "tahun_pembuatan" => $request->tahun_pembuatan,                    
                    "guna_fungsi" => $request->guna_fungsi,                    
                    "tgl_perolehan" => $request->tgl_perolehan,                    
                    "cara_perolehan" => $request->cara_perolehan,                    
                    "tempat_perolehan" => $request->tempat_perolehan,                    
                    "kondisi" => $request->kondisi,                    
                    "deskripsi" => $request->deskripsi,                    
                    "keterangan" => $request->keterangan,                    
                    "no_foto" => $request->no_foto,                    
                    "no_neg_film" => $request->no_neg_film,                    
                    "no_slide" => $request->no_slide,                    
                    "picture" => $pictureName,
                    "user_id" => Auth::user()->id
                ]);
                $this->deleteLocalPictureHelper($oldPictureName);

                return ["status"=>"success", "message"=>"Data updated succesfully."];

            }
            // update without picture
            else {
                $news = $this->model::find($id);
                $news->update([
                    "jenis_koleksi" => $request->jenis_koleksi,
                    "nama_benda" => $request->nama_benda,
                    "no_inv_lama" => $request->no_inv_lama,
                    "no_inv_baru" => $request->no_inv_baru,
                    "no_reg_lama" => $request->no_reg_lama,
                    "no_reg_baru" => $request->no_reg_baru,
                    "tempat_penyimpanan" => $request->tempat_penyimpanan,                    
                    "ukuran" => $request->ukuran,                    
                    "bahan" => $request->bahan,                    
                    "teknik_pembuatan" => $request->teknik_pembuatan,                    
                    "tempat_asal" => $request->tempat_asal,                    
                    "negara" => $request->negara,                    
                    "prov" => $request->prov,                    
                    "kab" => $request->kab,                    
                    "temp_pembuatan" => $request->temp_pembuatan,                    
                    "temp_temuan" => $request->temp_temuan,                    
                    "tahun_pembuatan" => $request->tahun_pembuatan,                    
                    "guna_fungsi" => $request->guna_fungsi,                    
                    "tgl_perolehan" => $request->tgl_perolehan,                    
                    "cara_perolehan" => $request->cara_perolehan,                    
                    "tempat_perolehan" => $request->tempat_perolehan,                    
                    "kondisi" => $request->kondisi,                    
                    "deskripsi" => $request->deskripsi,                    
                    "keterangan" => $request->keterangan,                    
                    "no_foto" => $request->no_foto,                    
                    "no_neg_film" => $request->no_neg_film,                    
                    "no_slide" => $request->no_slide, 
                    "user_id" => Auth::user()->id
                ]);

                return ["status"=>"success", "message"=>"Data updated succesfully."];
            }
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    public function destroy($id)
    {
        try {
            $data = $this->model::find($id);
            $data->delete();
            $oldPictureName = $data->picture;
            $this->deleteLocalPictureHelper($oldPictureName);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function parseKeyword($keywords){

    }
    public function parseCategoryIds($category_ids){
        if($category_ids != null){
            return join(",",$category_ids);
        }
        return "";
    }
    private function deleteLocalPictureHelper($fileName)
    {
        try {
            if($fileName != ""){
                Storage::disk('local')->delete('public/image_uploaded/' . $fileName);
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function uploadPictureHelper($request)
    {
        try {
            $picture = $request->file('picture');
            $pictureName = $picture->hashName();
            $picture->storeAs("public/image_uploaded", $pictureName);
            return $pictureName;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
