<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container login">
    <h1>Ontee管理员平台</h1>
    <form action="<?=Url::to(['site/login'])?>" method="post">
        <div class="row admin_login_content"> 

                <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf" />  
                <div class="col-xs-3">      
                    <span>用户名 :</span>
                </div>
                <div class="col-xs-8">
                <input type="text" name="LoginForm[username]" class="form-control"  placeholder="用户名">
                </div>
        </div>
        <div class="row admin_login_content">
            <div class="col-xs-3">
                <span>密码 :</span>
            </div>
            <div class="col-xs-8">
                <input type="password" name="LoginForm[password]" class="form-control"  placeholder="密码">
            </div>
        </div>

        <div class="row admin_login_nail">
            <input class="btn btn-default" style="margin-left:300px;" type="submit" value="登录"/>
        </div>
    </form>
</div>

</body>
</html>
<?php $this->endPage() ?>

