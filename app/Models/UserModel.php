<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'login_details';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_name', 'password', 'name'];
    protected $returnType = 'array';
}