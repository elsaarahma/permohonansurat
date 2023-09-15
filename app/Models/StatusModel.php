<?php 
namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'status_permohonan';
    protected $primaryKey = 'id_status';
    protected $allowedFields = ['nama_status'];

    public function permohonan()
    {
        return $this->hasMany(KtpModel::class, 'status');
    }
}

?>