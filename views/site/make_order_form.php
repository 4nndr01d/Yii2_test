<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>


<h2 class="h1 my-2 font-weight-light">New order</h2>
<?php $form = ActiveForm::begin(); ?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Available quantity</th>
        <th scope="col">amount</th>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($product_list as $product): ?>
            <tr>
                <td scope="row"><?= Html::encode($product->id) ?></td>
                <td><?= Html::encode($product->name) ?></td>
                <td><?= Html::encode($product->price) ?></td>
                <td> <?= Html::encode($product->available_quantity) ?></td>
                <td class="col-2" >
                    <?php echo $form->field($product, $product->id)->textInput([ 'type' => 'number','value' => '0','min'=>0,'max' => $product->available_quantity ])->label(false) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
<div class="form-group">
    <?= Html::submitButton('Add order', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
