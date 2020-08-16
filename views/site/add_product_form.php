<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?php if(isset($model)): ?>
    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'available_quantity') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        </div>
<?php endif ?>

<?php if(isset($edit_product)): ?>
    <?= $form->field($edit_product, 'id')->hiddenInput(['value' => $edit_product->id]); ?>

    <?= $form->field($edit_product,'name')->textInput(['value'=>$edit_product->name]) ?>

    <?= $form->field($edit_product, 'price')->textInput(['value'=>$edit_product->price]) ?>

    <?= $form->field($edit_product, 'available_quantity')->textInput(['value'=>$edit_product->available_quantity]) ?>

    <div class="form-group">
        <?= Html::submitButton('Edit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php endif ?>

<?php ActiveForm::end(); ?>