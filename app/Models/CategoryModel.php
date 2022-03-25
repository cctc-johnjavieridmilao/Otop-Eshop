<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model {

    protected $table = 'tbl_category';

    protected $primaryKey = 'CategoryID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'CategoryCode',
        'Name',
        'IsActive',
        'Created_at',
        'Created_by'
    ];
    
}

?>