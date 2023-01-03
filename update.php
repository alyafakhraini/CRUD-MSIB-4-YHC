<!DOCTYPE html>
<html>
<head>
    <title>Alya Fakhraini</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_project
    if (isset($_GET['id_project'])) {
        $id_project=input($_GET["id_project"]);

        $sql="SELECT * FROM project WHERE id_project=$id_project";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_project=htmlspecialchars($_POST["id_project"]);
        $nama_project=input($_POST["nama_project"]);
        $client=input($_POST["client"]);
        $leader=input($_POST["leader"]);
        $tgl_awal=input($_POST["tgl_awal"]);
        $tgl_akhir=input($_POST["tgl_akhir"]);

        //Query update data pada tabel project
        $sql="UPDATE project SET
			nama_project='$nama_project',
			client='$client',
			leader='$leader',
			tgl_awal='$tgl_awal',
			tgl_akhir='$tgl_akhir'
			WHERE id_project=$id_project";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Project Name:</label>
            <input type="text" name="nama_project" class="form-control" placeholder="Input project name" required />

        </div>
        <div class="form-group">
            <label>Client:</label>
            <input type="text" name="client" class="form-control" placeholder="Input client name" required/>
        </div>
        <div class="form-group">
            <label>Project Leader :</label>
            <input type="text" name="leader" class="form-control" placeholder="Input project leader" required/>
        </div>
        <div class="form-group">
            <label>Start Date:</label>
            <input type="date" name="tgl_awal" class="form-control" required/>
        </div>
        <div class="form-group">
            <label>End Date:</label>
            <input type="date" name="tgl_akhir" class="form-control" required/>
        </div>

        <input type="hidden" name="id_project" value="<?php echo $data['id_project']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>