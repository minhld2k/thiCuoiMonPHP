<table class="border">
    <tr>
        <td>email</td>
        <td>name</td>
        <td>chuc danh</td>
        <td>phong ban</td>
        <td>ACTION</td>
    </tr>
    <?php foreach ($user as $resultItem) {?>
        <tr>
            <td><?= $resultItem->email ?></td>
            <td><?= $resultItem->name ?></td>
            <td><?= $chucdanh[$resultItem->chucdanhid] ?? "" ?></td>
            <td><?= $phongban[$resultItem->phongbanid] ?? "" ?></td>
            <td>
                <a href="{{route("edituser",['id'=>$resultItem->id])}}" class="btn btn-info">edit</a>
            </td>
        </tr> 
    <?php } ?>
</table>