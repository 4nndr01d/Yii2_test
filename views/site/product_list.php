<?php
    use yii\helpers\Html;
?>
<a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/add-product"])?>">Add new prodact</a >
<br/>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Available quantity</th>
        <th scope="col">method</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($product_list as $product): ; ?>
        <tr>
            <td scope="row"><?= Html::encode($product->id) ?></td>
            <td><?= Html::encode($product->name) ?></td>
            <td><?= Html::encode($product->price) ?></td>
            <td> <?= Html::encode($product->available_quantity) ?></td>
            <td>
                <a class="btn btn-danger" href="<?=Yii::$app->urlManager->createUrl(["site/delete-product"])?>&id=<?=$product->id?>"><i class="glyphicon glyphicon-trash"></i></a>
                <a class="btn btn-primary" href="<?=Yii::$app->urlManager->createUrl(["site/edit-product"])?>&id=<?=$product->id?>"><i class="glyphicon glyphicon-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach ?>


    </tbody>
</table>


