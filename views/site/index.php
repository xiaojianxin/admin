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


  <div class="modal fade" id="delete" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal" aria-hidden="true">
                      &times;
                </button>
             </div>
             <div class="modal-body">
                确定要删除该素材吗？
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                   data-dismiss="modal">关闭
                </button>

                <a class="btn btn-danger ConfirmDelete" id="">删除</a></td>
             </div>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
<div id="section-1">
  <table class="table">
     <caption>不可变色素材管理</caption>
      <button class="btn btn-primary" style="float:right;margin-top:20px;" data-toggle="modal" data-target="#upload">上传图片</button>
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
              <a class="btn btn-danger delete" id="<?=$picture['name']?>" data-toggle="modal" data-target="#delete">删除</a></td>
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


  $.extend({       
  urlGet:function()
  {

      var aQuery = window.location.href.split("?");  //取得Get参数
      var aGET = new Array();
      if(aQuery.length > 1)
      {
          var aBuf = aQuery[1].split("&");
          for(var i=0, iLoop = aBuf.length; i<iLoop; i++)
          {
              var aTmp = aBuf[i].split("=");  //分离key与Value
              aGET[0] = aTmp[1];
          }
       }
       return aGET;
   }
  });

  var id = $.urlGet();

  $('.chooseli').removeClass('chooseli');
  $('#'+id).addClass('chooseli');

  $('.check').click(function(){
      var value = $(this).attr('id');

      var url = 'http://www.ontee.cn/'+value;

      $('#showpic').attr('src',url);


  })
  $('.delete').click(function(){
      var value = $(this).attr('id');

      $('.ConfirmDelete').attr('id',value);
  });
  $('.ConfirmDelete').click(function(){
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