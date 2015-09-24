<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Ontee admin';
?>
<table class="table">
   <caption>素材管理</caption>
    <button class="btn btn-primary" style="float:right;margin-top:20px;" data-toggle="modal" data-target="#upload">上传图片</button>

    
    <!-- 模态框（Modal） -->
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
                   上传素材
                </h4>
             </div>
             <div class="modal-body">
                 <form action="<?=Url::to(['site/upload'])?>" method="post" enctype="multipart/form-data">
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
    </div><!-- /.modal -->


        <!-- 模态框（Modal） -->
    <div class="modal fade" id="check" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal" aria-hidden="true">
                      &times;
                </button>
             </div>
             <div class="modal-body">
                <img id="showpic" style="width:100%;" src="" >
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                   data-dismiss="modal">关闭
                </button>
             </div>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->


  
   <div class="holder"></div>
   <thead>
      <tr>
         <th>名称</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody id="itemContainer">

    <?php foreach ($pictures as $key => $picture) {?>
      <tr>
         <td><?php echo $picture['name']?></td>
         <td> 
            <a class="btn btn-primary check" id="<?=$picture['url']?>" data-toggle="modal" data-target="#check">查看</a>
            <a class="btn btn-danger delete" id="<?=$picture['name']?>">删除</a></td>
      </tr>
    <?php } ?>
    
   </tbody>
</table>


<?php $this->beginBlock("showpic")?>

$('.check').click(function(){
    var value = $(this).attr('id');

    var url = 'http://www.ontee.cn/'+value;

    $('#showpic').attr('src',url);


})
$('.delete').click(function(){
    var value = $(this).attr('id');

    $.ajax({
        type:"POST",
        url:"index.php?r=upload/delete",
        dataType:"Json",
        data:{name:value},
        success:function(data){
            if(data == "0"){
             alert('删除成功');
              window.location.href = window.location.href;
            }else{
            alert('删除失败');
          }
            
        },
        error:function(){

        }
    })
})
 
$("div.holder").jPages({  
      containerID : "",  
      previous : "←",  
      next : "→",  
      perPage : 10,  
      delay : 100  
});  

<?php $this->endBlock()?>
<?php $this->registerJs($this->blocks['showpic'],\yii\web\View::POS_END)?>