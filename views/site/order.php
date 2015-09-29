
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Ontee admin';
?>

<!-- 模态框（Modal） -->
<div class="modal fade" id="order" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <img id="showpic" style="width:60%;position: absolute;left:20%;top:15%;" src="" >
                <img id="showtype" style="width:100%;" src="" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">关闭
                </button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal -->
<div id="section-1">
  <table class="table">
     <caption>订单管理</caption>
     <thead>
        <tr>
           <th>订单号</th>
           <th>地址</th>
           <th>大小</th>
           <th>数量</th>
           <th>金额</th>
           <th>设计图</th>
           <th>状态</th>
        </tr>
     </thead>
     <tbody id="itemContainer">

      <?php foreach ($orders as $key => $order) {?>
        <tr>
           <td><?php echo $order->id?></td>
           <td><?php if(!empty($order->address)){
                  echo $order->address[0]->location.$order->address[0]->address;
               }?></td>
           <td><?php echo $order->size?></td>
           <td><?php echo $order->num?></td>
           <td><?php echo $order->price?></td>
           <td><a class="btn btn-primary check" id="<?=$order->frontpic?>"
            name="<?=$order->type?>" data-toggle="modal" data-target="#order">前图</a>

           <a class="btn btn-primary check" id="<?=$order->backpic?>"
            name="<?=$order->type?>" data-toggle="modal" data-target="#order">后图</a></td>

           <td><?php if($order->status == '0'){?>
              <a class="btn btn-danger">未支付</a>
           <?php }else{?>
              <a class="btn btn-success">已支付</a>
         <?php }?></td>
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


  <?php $this->beginBlock("showpic")?>

$(function(){ 

  $('.check').click(function(){
      var value = $(this).attr('id');
      var type = $(this).attr('name');

      var url = 'http://www.ontee.cn/'+value;

      $('#showpic').attr('src',url);
      $('#showtype').attr('src',"http://www.ontee.cn/img/teebf.png ");


  });

    $("div .holder").jPages({
    containerID : "itemContainer",
    previous : "←",
    next : "→",
    perPage : 10,
    });
});  

<?php $this->endBlock()?>
<?php $this->registerJs($this->blocks['showpic'],\yii\web\View::POS_END)?>