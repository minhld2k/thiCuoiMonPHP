<form action="<?=route("luudulieu")?>" method="post">
    @csrf
    <input type="hidden" name="id" value="<?= $result[0]['id']??""?>">
    <input type="text" name="ten" value="<?= $result[0]['ten']??""?>">
    <input type="submit" value="save">
</form>