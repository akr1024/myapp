<?php

namespace App\Controller;

class PostsController extends AppController {
  public function index() {
     $this->viewBuilder()->layout('my_layout');
    $posts = $this->Posts->find('all');

    $this->set(compact('posts'));
  }


  public function view($id = null)
    {
      $post = $this->Posts->get($id,[
        'contain'=>'Comments'
      ]);
      $this->set(compact('post'));
    }
  
   // 登録画面
  public function add()
  {
    $post = $this->Posts->newEntity();
    if ($this->request->is('post')) {
      $post = $this->Posts->patchEntity($post, $this->request->data);
      
      if($this->Posts->save($post)){
        $this->Flash->success('登録しました');
       return $this->redirect(['action'=>'index']); 
      }else{
        //validation error
        $this->Flash->error('登録エラー');
      }
      
    }
    $this->set(compact('post'));
  }
  
  public function edit($id = null){
    $post = $this->Posts->get($id);
    if($this->request->is(['post','patch','put'])){
        $post = $this->Posts->patchEntity($post,$this->request->data);
      if($this->Posts->save($post)){
        $this->Flash->success('編集しました');
        return $this->redirect(['action'=>'index']);
      }else{
        //error
        $this->Flash->error('編集エラー');
      }
    }
    $this->set(compact('post'));
  }
  
  
  public function delete($id = null){
    $this->request->allowMethod('post');
    $post = $this->Posts->get($id);
    if($this->Posts->delete($post)){
      $this->Flash->success('削除しました');
    }else{
      $this->Flash->error('削除エラー');
    }
    return $this->redirect(['action'=>'index']);
  }

}
