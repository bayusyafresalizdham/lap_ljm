<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>STTS - LJM</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/custom.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Administrator - LJM
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('buatsurat.php')"><span class="fa fa-pencil-square-o"></span> Rapor Dosen</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('lap_dosen.php')"><span class="fa fa-file-o"></span> Laporan Dosen</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('lap_dosen_by_name.php')"><span class="fa fa-file-o"></span> Laporan Dosen By Name</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('lap_biro.php')"><span class="fa fa-file-o"></span> Laporan Biro</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('sarankritikdosen.php')"><span class="fa fa-tag"></span> Saran & Kritik Dosen</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('sarankritikbiro.php')"><span class="fa fa-tags"></span> Saran & Kritik Biro</a>
                </li>
                <li>
                    <a href="#" onclick="loadPage('periode.php')"><span class="fa fa-cog"></span> Setting Periode</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" id="content">
						 <h1>Selamat datang, Administrator LJM</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

	function loadPage(url)
	{
		$.post(url, function( data ) {
			$( "#content" ).html( data );
		});
	}
    </script>

</body>

</html>
