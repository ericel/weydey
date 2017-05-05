<?php
namespace App\Models;

use Nova\Database\ORM\Model;

class Videos extends Model
{
   protected $table = 'videos';
   protected $primaryKey = 'fileID';
}
?>