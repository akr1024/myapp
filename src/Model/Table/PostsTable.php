<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostsTable extends Table {
  public function initialize(array $config) {
    $this->addBehavior('Timestamp');
    $this->hasMany('Comments',['dependent'=>true]);
  }
  
  public function validationDefault(Validator $validator){
    $validator
       ->notEmpty('title')
      ->requirePresence('title')
      ->add('title',['length'=>['rule'=>['maxLength',30],'message'=>'タイトルは３０文字以内です']])
      
      ->notEmpty('body')
      ->requirePresence('body')
      ->add('body',['length'=>['rule'=>['minLength',10],'message'=>'本文は１０文字以上必要です']]);
    return $validator;
  }
  
  
}