
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Ontee admin';
?>
<div id="section-1">
  <table class="table">
     <caption>订单管理</caption>
      <button class="btn btn-primary" style="float:right;margin-top:20px;" data-toggle="modal" data-target="#upload">上传图片</button>
     <thead>
        <tr>
           <th>订单号</th>
           <th>地址</th>
        </tr>
     </thead>
     <tbody id="itemContainer">

      <?php foreach ($orders as $key => $order) {?>
        <tr>
           <td><?php echo $order['id']?></td>
           <td></td>
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