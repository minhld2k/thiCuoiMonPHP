<a href="{{route("add")}}" class="btn btn-info">add</a>
<table class="border">
    <tr>
        <td>id</td>
        <td>name</td>
        <td>ACTION</td>
    </tr>
    <?php foreach ($result as $resultItem) {?>
        <tr>
            <td><?= $resultItem["id"] ?></td>
            <td><?= $resultItem["ten"] ?></td>
            <td>
                <a href="{{route("sua",['id'=>$resultItem["id"]])}}" class="btn btn-info">edit</a>|
                <a href="{{route("xoa",['id'=>$resultItem["id"]])}}" class="btn btn-danger">Delete</a>
            </td>
        </tr> 
    <?php } ?>
</table>