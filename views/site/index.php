<?php
/* @var $this yii\web\View */
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
                 <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" class="btn btn-default" name="pic"/>
                    
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                   data-dismiss="modal">关闭
                </button>
                <input type="submit" class="btn btn-success" value="提交"/>
            </form>
             </div>
          </div><!-- /.modal-content -->
    </div><!-- /.modal -->


  
   
   <thead>
      <tr>
         <th>名称</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td>Tanmay</td>
         <td> 
            <a class="btn btn-primary">查看</a>
            <a class="btn btn-danger">删除</a></td>
      </tr>
      <tr>
         <td>
 
         </td>
         <td>Mumbai</td>
      </tr>
   </tbody>
</table>
