<?php
include('includes/autoload.php');
if(!empty($_POST["catid"])) 
{
    $id=intval($_POST['catid']);
    $SelQuery = $db->fetchsql("SELECT * FROM tbl_danhmuccon WHERE idCate=$id AND trangThai=1");
    ?>
    <option value="">Select Subcategory</option>
    <?php
    foreach($SelQuery as $values)
    {
        ?>
        <option value="<?php echo htmlentities($values['idSubCate']); ?>"><?php echo htmlentities($values['tenSubCate']); ?></option>
        <?php
    }
}
?>