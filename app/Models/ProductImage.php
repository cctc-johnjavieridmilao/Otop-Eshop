<?php namespace App\Models;

use CodeIgniter\Model;

class ProductImage extends Model {

    protected $table = 'tbl_product_image';

    protected $primaryKey = 'ImageID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'ProductID',
        'FileName',
        'Created_at',
        'Created_by'
    ];
    
}

?>