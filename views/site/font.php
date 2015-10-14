<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Ontee admin';
?>

<div class="modal fade" id="upload" tabindex="-1" role="dialog" 
       aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal" aria-hidden="true">
                      &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   上传字体
                </h4>
             </div>
             <div class="modal-body">
                 <form action="<?=Url::to(['upload/uploadfont']);?>" method="post" enctype="multipart/form-data">
                    <input type="file" class="btn btn-default" name="UploadForm[file]"/>
                    
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                   data-dismiss="modal">关闭
                </button>
                <input type="submit" class="btn btn-success" value="提交"/>
            </form>
             </div>
          </div>
        </div><!-- /.modal-content -->
    </div>

<div id="section-1">

  <button class="btn btn-primary" style="float:right;margin-top:20px;" data-toggle="modal" data-target="#upload">上传字体文件</button>
  <table class="table">
     <caption>字体管理</caption>
     <thead>
        <tr>
           <th>序号</th>
           <th>字体名称</th>
        </tr>
     </thead>
     <tbody id="itemContainer">

      <?php foreach ($fonts as $key => $font) {?>
        <tr>
           <td><?php echo $font['id']?></td>
           <td><?php echo $font['name']?></td>
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