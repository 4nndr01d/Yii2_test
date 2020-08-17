<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>


<a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/make-order"])?>">Add new order</a >
<?php $form = ActiveForm::begin(); ?>
<br/>
<?php ActiveForm::end(); ?>
<table class='table filtered-table' data-toggle="table" data-pagination="true" data-search="true" data-page-size="25">
    <thead>
    <tr>
        <th data-sortable="true" data-field="id" scope="col">id</th>
        <th data-sortable="true" data-field="date" scope="col">Created at</th>
        <th scope="col">Positions</th>
        <th  data-sortable="true" data-field="total_price" scope="col">Total price &#8381;</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($order_list as $id=>$order): ?>
        <tr>
            <td><?= Html::encode($id) ?></td>
            <td scope="row"><?= Html::encode($order['created']) ?></td>
            <td>
                <ul class="list-group">
                    <?php foreach ($order['positions'] as $position): ?>
                        <li class="list-group-item"><?= Html::encode($position['name']) .' '. Html::encode($position['quantity']); ?></li>
                    <?php endforeach ?>
                </ul>
            </td>
            <td scope="row"><?= Html::encode($order['total_price']) ?></td>
            <td>
                <a class="btn btn-danger" href="<?=Yii::$app->urlManager->createUrl(["site/delete-order"])?>&id=<?=$id?>"><i class="glyphicon glyphicon-trash"></i></a>
                <a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/edit-order"])?>&id=<?=$id?>"><i class="glyphicon glyphicon-pencil"></i></a>

            </td>
        </tr>
    <?php endforeach ?>


    </tbody>
</table>
