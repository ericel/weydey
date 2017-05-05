<?php
namespace App\Models;

use Nova\Database\ORM\Model;
use App\Models\User;
class Comment extends Model
{
   protected $table = 'comments';
   protected $primaryKey = 'fileID';

   public function commentImage()
   { 
        return $this->hasMany('App\Models\User', 'username');
   }
}


?>