<!--show界面的具体实现 -->
<?php $title = $post['Car_logo']?>
<?php ob_start() ?>
  <h1><?= $post['Car_logo']?></h1>
  <div class = "date"><?=$post['Car_date']?></div>
  <div class = "body">
     <?=$post['Car_num']?>
  </div>
<?php $content = ob_get_clean()?>
<?php include 'layout.php' ?>