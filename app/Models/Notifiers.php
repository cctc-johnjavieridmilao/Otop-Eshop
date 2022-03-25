<?php namespace App\Models;

use CodeIgniter\Model;

class Notifiers extends Model
{
    protected $db;
    protected $str;
    protected $KeyBindings;
    protected $DBGroup = 'default';
    protected $returnType = 'array';
    protected $email = 'array';

    public function __construct() {
         $this->db = \Config\Database::connect();
         $this->email = \Config\Services::email();
    }

    public function SendEmailNotification($to,$subject,$body) {

         $config['protocol'] = 'smtp';
         $config['SMTPHost'] = 'smtp.hostinger.com';
         $config['SMTPUser'] = 'otop_eshop@otop-eshop.online';
         $config['SMTPPass'] = 'Jhayjhay12345!';
         $config['SMTPPort'] = 465;
         $config['mailType'] = 'html';
         $this->email->initialize($config);
         $this->email->setFrom('smtp.hostinger.com', 'NO REPLAY');
         $this->email->setTo($to);
         $this->email->setSubject($subject);
         $this->email->setMessage($body);

         if ($this->email->send()) {
             return true;
         }
         return false;

    }

}
?>