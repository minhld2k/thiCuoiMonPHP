
<form action="{{route("save")}}" method="post">
    @csrf
    <input type="hidden" name="id" value="<?= $user->id??""?>">
    <input type="text" name="name" value="<?= $user->name??""?>"></br>

    <select name="chucdanh" id="chucdanh">
    <?php foreach($chucdanh as $key => $value){ ?>
        <option value="<?= $key??""?>" {{$key == $user->chucdanhid ? "selected" : ""}}><?= $value??""?></option>
    <?php }  ?>
    </select></br>

    <select name="phongban" id="phongban">
    <?php foreach($phongban as $key => $value){ ?>
        <option value="<?= $key??""?>" {{$key == $user->phongbanid ? "selected" : ""}}><?= $value??""?></option>
    <?php } ?>
    </select></br>
        
    <input type="submit" value="save">
</form>