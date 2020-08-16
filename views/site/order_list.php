<?php
    use yii\helpers\Html;

?>

<a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/make-order"])?>">Add new order</a >
<br/>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Created at</th>
        <th scope="col">Positions</th>
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
            <td><a class="btn btn-danger" href="<?=Yii::$app->urlManager->createUrl(["site/delete-order"])?>&id=<?=$id?>"><i class="glyphicon glyphicon-trash"></i></a></td>
        </tr>
    <?php endforeach ?>


    </tbody>
</table>
