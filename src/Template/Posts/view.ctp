<?php
$this->assign('title', 'ブログ詳細');
?>

<h1>
  <?= h($post->title); ?>
    <?= $this->Html->link('戻る', ['action'=>'index'], ['class'=>'headlink']); ?>
</h1>

<p><?= nl2br(h($post->body)); ?></p>


<?php if(count($post->comments)):?>
<h2>コメント (<?= count($post->comments)?>)</h2>

<ul>
  <?php foreach($post->comments as $comment):?>
  <li>
    <?= h($comment->body); ?>
    <?=
      $this->Form->postlink('[x]',['Controller'=>'Comments','action'=>'delete',$comment->id],
                           ['confirm'=>'削除してもよろしいですか？','class'=>'delete-button']
       );
      ?>
  
  </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<h2>コメントする</h2>
<?= $this->Form->create(null,[
  'url'=>['controller'=>'Comments','action'=>'add']
]); ?>
<?= $this->Form->input('body',['label'=>'コメント', 'required' => true]); ?>
<?= $this->Form->hidden('post_id', ['value'=>$post->id]); // 記事と紐付けるIDをhiddenで渡す。?>
<?= $this->Form->button('コメント'); ?>
<?= $this->Form->end(); ?>