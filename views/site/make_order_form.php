<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<?php if(isset($new_order)): ?>
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
<?php endif ?>

<?php if(isset($edit_order)): ?>
    <h2 class="h1 my-2 font-weight-light">Edit order</h2>

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Available quantity</th>
            <th scope="col">amount</th>
        </tr>
        </thead>

        <tbody>
        <?= $form->field($Order, 'id')->hiddenInput(['value' => $order_id]); ?>
        <?php foreach ($positions['positions'] as $id => $position): ?>
            <tr>
                <td scope="row"><?= Html::encode($id) ?></td>
                <td><?= Html::encode($position['name']) ?></td>
                <td><?= Html::encode($position['price']) ?></td>
                <td> <?= Html::encode($position['available_quantity']) ?></td>
                <td class="col-2" >
                    <?php echo $form->field($Position_model, $id)->textInput([ 'type' => 'number','value' => $position['quantity'],'min'=>0,'max' => $position['available_quantity'] ])->label(false) ?>
                </td>
            </tr>
        <?php endforeach ?>
        <?php if(isset($products['products'])): ?>
            <?php foreach ($products['products'] as $id => $product): ?>
                <tr>
                    <td scope="row"><?= Html::encode($id) ?></td>
                    <td><?= Html::encode($product['name']) ?></td>
                    <td><?= Html::encode($product['price']) ?></td>
                    <td> <?= Html::encode($product['available_quantity']) ?></td>
                    <td class="col-2" >
                        <?php echo $form->field($Product_model, $id)->textInput([ 'type' => 'number','value' => $product['quantity'],'min'=>0,'max' => $product['available_quantity'] ])->label(false) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>

    </table>
    <div class="form-group">
        <?= Html::submitButton('Edit order', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php endif ?>


