<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/style/style1.css">
</head>
<body>
    
    <div class="container">
        <!-- -----------------------BATAS SUCI----------------------- -->


        <!-- start main content here..-->
        <div class="container main_bgr_dash">
            <div class="row">
                <div class="col-md-12"> 
                    <h4>Hasil Evaluasi</h4>
                </div>
            </div>

        <form action="" method="">
            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-3">
                    <input class="form-control" type="text" placeholder="Default input">
                </div>
                <div>
                    <button class="btn btn-info" type="submit">search</button>
                </div>
                <div class="col-md-7" style="text-align: right; margin-left: 60px;">
                    <button class="btn btn-success">+ New</button>
                </div>
            </div>
        </form>
            
            <div class="row">
                <div class="col-md-12"> 
                    
                    <div class="table-responsive" style="background-color: white;">
                        
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Hasil Evaluasi</th>
                                <th scope="col">Absensi</th>
                                <th scope="col">Hasil Evaluasi Penilaian</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- start php loop here.. -->
                            <tr>
                                <td>Mark</td>
                                <td>18001191</td>
                                <td>80%</td>
                                <td>75%</td>
                                <td>-</td>
                                <td> <button class="btn btn-info"> Detail </button> </td>
                                <td> <button class="btn btn-primary"> + Nilai </button> </td>
                            </tr>
                            <tr>
                                <td>Jacob</td>
                                <td>18002291</td>
                                <td>90%</td>
                                <td>-</td>
                                <td>-</td>
                                <td> <button class="btn btn-info"> Detail </button> </td>
                                <td> <button class="btn btn-primary"> + Nilai </button> </td>
                            </tr>
                            <tr>
                                <td>Harry</td>
                                <td>18003393</td>
                                <td>85%</td>
                                <td>75%</td>
                                <td>95%</td>
                                <td> <button class="btn btn-info"> Detail </button> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Jacob</td>
                                <td>18002291</td>
                                <td>90%</td>
                                <td>-</td>
                                <td>-</td>
                                <td> <button class="btn btn-info"> Detail </button> </td>
                                <td> <button class="btn btn-primary"> + Nilai </button> </td>
                            </tr>
                            <tr>
                                <td>Harry</td>
                                <td>18003393</td>
                                <td>85%</td>
                                <td>75%</td>
                                <td>95%</td>
                                <td> <button class="btn btn-info"> Detail </button> </td>
                                <td></td>
                            </tr>
                            <!-- end php loop here.. -->
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <!-- end main content -->


    
    <script src="<?= base_url()?>assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= base_url()?>assets/js/popper.min.js"></script>
    <script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
</body>
</html>