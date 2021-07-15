<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'folder_models';
	protected $primaryKey           = 'folder_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['created_by', 'parent_id', 'folder', 'location', 'password', 'name', 'permission', 'slug'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];



	/*
	 * Use-case methods
	 */

    public function getAllFolders(){
        return FolderModel::findAll();
    }

    public function getFolderContentById($id){
        $builder = $this->db->table('folder_models');
        $builder->where('parent_id', $id);
        return $builder->get()->getResultArray();
    }
}