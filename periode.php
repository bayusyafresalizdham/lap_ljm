
 <h2>
	Setting Periode
 </h2>
 <form class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="edPeriode">Periode Aktif : </label>
    <div class="col-sm-2">
		<!-- nilai default berisi periode yang ada saat ini -->
		<!-- table yang dilihat adalah periode_ljm -->
    <?php
    include_once 'lib/Database.php';
    $db = new Database();
    $res= $db->select("SELECT * FROM periode_ljm");
            while($row = $res->fetch_assoc()) {
   ?>
		<input type="text" class="form-control" id="edPeriode" name="edPeriode" placeholder="" value=<?=$row['periode_kode'];}?>>

    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value ="simpan" id="btn-simpan"></input>
	  <?php
			if(isset($_POST['btn-update'])){
				$_edPeriode = $_POST['edPeriode'];
				//sql query
				$sql_query = "update periode_ljm SET periode_kode = '$edPeriode'";
				$hasil = mysql_query($sql_query,$dbConnSTTS);
				$row2= mysql_fetch_assoc($hasil);
				if(!$hasil){
					?>
					<script type="text/javascript">
					  alert('Data Are Updated Successfully');
					 // window.location.href='index.php';
					  </script>
					  <?php
				}
				else
				{
				?>
				<script type ="text/javascript">
				alert('data are not update');
				</script>
				<?php
				}

			}
	  ?>
    </div>
  </div>
</form>
