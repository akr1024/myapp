<?php

namespace App\Controller;

class CommentsController extends AppController{
  
  public function add(){
    $comment = $this->Comments->newEntity();
    if($this->request->is('post')){
      $comment = $this->Comments->patchEntity($comment,$this->request->data);
      if($this->Comments->save($comment)){
        $this->Flash->success('コメントを書き込みました');
        
        return $this->redirect(['controller'=>'Posts','action'=>'view',$comment->post_id]);
      }else{
        
        $this->Flash->error('コメントエラー');
      }
    }
    $this->set(compact('comment'));
  }
  
  public function delete($id = null){
    $this->request->allowMethod(['post','delete']);
    $comment = $this->Comments->get($id);
    if($this->Comments->delete($comment)){
      $this->Flash->success('コメントを削除しました');
    }else{
      $this->Flash->error('削除エラー');
    }
    
    return $this->redirect(['controller'=>'Posts','action'=>'view',$comment->post_id]);
  }
  
  
  
  
  
}