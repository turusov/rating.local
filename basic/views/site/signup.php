<h1>
    Регистрация
</h1>

<?php
    use yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin(['class'=>'form-horizontal']);
?>

<?= $form -> field($model, 'username') -> textInput(['autofocus'=>true]) ?>
<?= $form -> field($model, 'password') -> passwordInput()?>

<label class ="control-label" for="signup-username">Repeat password</label>
<input type = 'password' name='password_repeat' class='form-control'><br>

<?php
    if($err == -1)
    {
        echo "<b style='color:red'>Пароли не совпадают</b>";
    }
?>
<input type='hidden' name='user_status_id' value="<?=3?>"> 

<div>
    <button type = "submit" class = "btn btn-primary"> Submit </button>
</div>

<?php
    \yii\widgets\ActiveForm::end();
?>