
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Ontee admin';
?>
<div id="section-1">
  <table class="table">
     <caption>账户管理</caption>
     <thead>
        <tr>
           <th>账户名</th>
           <th>手机号</th>
           <th>邮箱</th>
           <th>操作</th>
        </tr>
     </thead>
     <tbody id="itemContainer">

      <?php foreach ($users as $key => $user) {?>
        <tr>
           <td><?php echo $user['username']?></td>
           <td><?php echo $user['telephone']?></td>
           <td><?php echo $user['email']?></td>
           <td> 
              <a class="btn btn-primary check" href="<?=Url::to(['site/order','type'=>$user['userid']])?>">查看订单</a>
        </tr>
      <?php } ?>
      
     </tbody>


  </table>

      <div class="holder" style="margin-left: 100px;">
          <a class="jp-previous jp-disabled">← previous</a>
          <a class="jp-current">1</a>
          <span class="jp-hidden">...</span>
          <a>2</a>
          <a>3</a>
          <a>4</a>
          <a>5</a>
          <a class="jp-hidden">6</a>
          <a class="jp-hidden">7</a>
          <a class="jp-hidden">8</a>
          <a class="jp-hidden">9</a>
          <span>...</span>
          <a>10</a>
          <a class="jp-next">next →</a>
      </div>

  </div>
<?php $this->beginBlock("jpages")?>

$(function(){


    $("div .holder").jPages({
        containerID : "itemContainer",
        previous : "←",
        next : "→",
        perPage : 10,
    });
});

<?php $this->endBlock()?>

<?php $this->registerJs($this->blocks['jpages'],\yii\web\View::POS_END)?>