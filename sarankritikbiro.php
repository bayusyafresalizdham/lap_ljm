
 <h2>
	Kritik & Saran Biro
 </h2>
 <script src="jquery.js"></script>
 <script>
		//$.get("ajx_search.php",{ judul: $("#book_name").val(),isinya: $("#textbx_chat").val()},function(data)
		$(document).ready(function(){
			$("#srch").click(function(){
				//alert("ha");
				$.post("ajax/ajax_ks_biro.php",{ valuz: $("#edPeriode").val()},function(data){
					$("#tralala").html(data);
				});
			});
		});
	</script>
 <form class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="edPeriode">Periode Aktif : </label>
    <div class="col-sm-2">
		<!-- nilai default berisi periode yang ada saat ini -->
		<!-- table yang dipakai adalah VIEW mv_rekap_quesioner_dosen -->
		<!-- di group berdasarkan nama dosen -->
		<!-- jadi nama dosen, bawahnya baru table -->

    <?php
    include_once 'lib/Database.php';
    $db = new Database();
    $res= $db->select("SELECT * FROM periode_ljm");
            while($row = $res->fetch_assoc()) {
   ?>
		<input type="text" class="form-control" id="edPeriode" name="edPeriode" placeholder="" value = <?=$row['periode_kode'];}?>>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10" style="margin-bottom:40px;">
     <input type="button"  name="srch" id="srch" value="tampilkan" class="btn btn-default"/>
    </div>
	<div id="tralala" style="width:950px; margin:0 auto; font-family:Century Gothic;"></div>
  </div>
</form>
