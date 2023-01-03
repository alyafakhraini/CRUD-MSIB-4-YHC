<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
    Alya Fakhraini</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">ALYA FAKHRAINI</span>
        </div>
    </nav>
<div class="container">
    <br>
    <h4><center>PROJECT MONITORING</center></h4>
<?php

    include "koneksi.php";

    //Cek apakah ada kiriman form dari method post
    if (isset($_GET['id_project'])) {
        $id_project=htmlspecialchars($_GET["id_project"]);

        $sql="DELETE FROM project WHERE id_project='$id_project' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


     <tr class="table-danger">
            <br>
        <thead>
        <tr>
       <table class="my-3 table table-bordered">
            <tr class="table-primary">           
            <th>No</th>
            <th>Project Name</th>
            <th>Client</th>
            <th>Project Leader</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Progress</th>
            <th colspan='2'>Action</th>

        </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="SELECT * FROM project ORDER BY id_project DESC";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["nama_project"]; ?></td>
                <td><?php echo $data["client"];   ?></td>
                <td><?php echo $data["leader"];   ?></td>
                <td><?php echo $data["tgl_awal"];   ?></td>
                <td><?php echo $data["tgl_akhir"];   ?></td>
                <td><a href="" class="progress-bar" style="width:50%;height: 30px">50%</a></td>
                <td>
                    <a href="update.php?id_project=<?php echo htmlspecialchars($data['id_project']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_project=<?php echo $data['id_project']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
</body>
</html>
