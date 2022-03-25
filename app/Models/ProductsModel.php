<?php namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model {

    protected $table = 'tbl_products';

    protected $primaryKey = 'ProducID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ProducCode',
        'CategoryID',
        'Name',
        'Prize',
        'Description',
        'stocks',
        'IsActive',
        'Created_at',
        'Created_by'
    ];
    
}

?>