<?php
include 'assets/data/data.php'; //Include untuk dapat mengakses file data.php agar dapat mengambil data produk
session_start(); //insialisasi session_start agar bisa menggunakan session

$id = $_GET['id']; //insiasi $id yang menyimpan data 'id' yang mengambil/menangkap dari url/parameter yang dikirimkan dari halaman index.php ke halaman transaction.php

$data = $data[$id]; //inisiasi $data yang menyimpan data produk berdasarkan $id yang sudah diiniasi sebelumnya

$username = $_SESSION['username']; //Set session username ke dalam variabel $username

//Jika session username tidak ada maka redirect ke halaman login.php
if (!isset($username)) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/style.css" rel="stylesheet">
    <title>Transaction</title>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top header-scrolled">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span style="padding-left: 0.2em;">Circle</span>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#">Home</a></li>
                    <li><a class="nav-link scrollto active">Transaction</a></li>

                    <li><a class="logout scrollto" href="logout.php">Logout</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Transaction</li>
                </ol>
                <h2>Transaction</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <section id="product-details" class="product-details">
            <div class="container">
                <div class="portfolio-info">
                    <h3>Product information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="no_transaction" class="form-label">No. Transaction</label>
                                    <input type="text" class="form-control" id="no_transaction" name="no_transaction">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="tanggal" class="form-label">Transaction Date</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="nama" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $username ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="product" class="form-label">Product</label>
                                    <input type="text" class="form-control" id="nama_product" name="product" value="<?= $data['nama'] ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" min="1" id="jumlah" name="jumlah">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <!-- inputan harga dengan value dari data produk lalu menggunakan number_format untuk menggunakan pemisah koma(,) pada angka ribuan -->
                                    <input type="text" class="form-control" id="price" name="price" value="Rp. <?= number_format($data['harga'], 0) ?>">
                                </div>
                                <div class="col-md-6 mb-3 d-flex align-items-end">
                                    <!-- button dengan attribut onclick="checkOut()" untuk mengetapkan fungsi pada javaScript yang akan dieksekusi ketika diclick -->
                                    <button type="button" class="btn btn-primary" onclick="checkOut()">Check out</button>
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Produk -->
                        <div class="col-md-6">
                            <img src="assets/img/products/values-1.png" class="w-50 pt-5" style="margin-left: 10em;" alt="">
                        </div>

                        <!-- Jumlah pembayaran -->
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <hr>
                                <div class="info-price mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Total Price</h5>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <h5 id="total-price">Rp. 0</h5>
                                            <!-- Menampilkan total harga dengan id="total-price" -->
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="info-price">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Payment</h5>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <input type="number" min="1" class="form-control mb-3" id="pembayaran" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <!-- button dengan attribut onclick="btnChange" menetapkan sebagai fungsi pada javaScript ketika diklick -->
                                            <button type="button" id="btn-change" onclick="btnChange()" class="btn btn-primary mb-3">Change!</button>
                                        </div>
                                        <hr>
                                        <div class="col-md-6">
                                            <h5>Change</h5>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <h5 id="change">Rp. 0</h5>
                                            <!-- Menampilkan kembalian dengan id="change" -->
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="button" disabled id="btn-save" class="btn btn-info mt-3 text-light" data-bs-toggle="modal" data-bs-target="#transactionModal">Save Transaction</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">No. Transaction</label>
                            <input type="text" class="form-control" id="noTransactionModal" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Transaction Date</label>
                            <input type="text" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="" class="form-label">Treatment</label>
                            <input type="text" class="form-control" value="<?= $data['nama_produk'] ?>" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Treatment Price</label>
                            <input type="text" class="form-control" value="Rp.<?= number_format($data['harga'], 0)  ?>" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="text" class="form-control" id="jumlahModal" value="" readonly>
                        </div>
                        <div class="col-md-10 mb-3">
                            <label for="" class="form-label">Total Price</label>
                            <input type="text" class="form-control" id="totalPriceModal" value="" readonly>
                        </div>
                        <hr>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Payment</label>
                            <input type="text" class="form-control" id="pembayaranModal" value="" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Change</label>
                            <input type="text" class="form-control" id="changeModal" value="" readonly>
                        </div>
                    </div> -->
                    <span class="text-success text-center fw-bold">Your transaction confirmed Success</span>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <a href="index.php" class="btn btn-success">Save Transaction</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal -->

    <!-- ======= Footer ======= -->
    <!-- include untuk mengambil bagian footer yang sudah ada -->
    <?php include 'partials/footer.php'; ?>
    <!-- End Footer -->

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let price = <?= $data['harga'] ?>; //inisiasi variabel price yang menyimpan harga produk yang diambil dari data produk yang sudah diinisiasi sebelumnya
        let jumlah = document.getElementById('jumlah'); //inisiasi variabel jumlah yang menyimpan element dengan id 'jumlah'
        let total = document.getElementById('total-price'); //inisiasi variabel total yang menyimpan element dengan id 'total-price'

        //fungsi total_harga yang akan dieksekusi ketika button check out diklik
        function total_harga() {
            //inisiasi variabel total_price yang menyimpan hasil perkalian harga produk dengan jumlah produk yang diinputkan
            let total_price = price * jumlah.value;

            return total_price; //mengembalikan nilai total_price
        }

        //fungsi checkOut yang akan dieksekusi ketika button check out diklik
        function checkOut() {
            //inisiasi variabel total_price yang menyimpan hasil dari fungsi total_harga
            let total_price = total_harga();

            total.innerText = 'Rp. ' + total_price.toLocaleString('id', 'ID');
            //mengubah text pada element total dengan hasil perkalian yang sudah diformat dengan pemisah koma(,)
        }

        let pembayaran = document.getElementById('pembayaran');
        //inisiasi variabel pembayaran yang menyimpan element dengan id 'pembayaran'

        //fungsi btnChange yang akan dieksekusi ketika button change diklik
        function btnChange() {
            //inisiasi variabel change yang menyimpan hasil dari pengurangan pembayaran dengan total harga
            let change = pembayaran.value - total_harga();

            //mengubah text pada element change dengan hasil pengurangan yang sudah diformat dengan menggunakan metode toLocaleString() dengan opsi 'id', untuk memformat angka ribuan dengan pemisah koma(,) yang akan memformat angka ke dalam format mata uang Indonesia.
            document.getElementById('change').innerText = 'Rp. ' + change.toLocaleString('id', 'ID');

            //ambil element button dengan id 'btn-save' dan mengaktifkan tombol tersebut dengan mengatur properti disabled menjadi false, sehingga tombol tersebut dapat diklik.
            document.getElementById('btn-save').disabled = false;
        }
    </script>
</body>

</html>