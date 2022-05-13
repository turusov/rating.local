<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ArraySubmitted extends Model
{
    // public function rules()
    // {
    //     return [
    //         ['array', ['integer']],
    //     ];
    // }
    public $array = [];
    public function save()
    {
        foreach($array as $a)
        {
            $a->save();
        }
        }
}
?>