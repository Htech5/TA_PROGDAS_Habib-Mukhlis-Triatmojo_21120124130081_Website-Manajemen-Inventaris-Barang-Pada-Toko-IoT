<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "stockbarang");

if (isset($_POST['addnew'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotabele = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) value('$namabarang', '$deskripsi', '$stock')");
    if ($addtotabele) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

if (isset($_POST['AddStock'])) {
    $item = $_POST['item'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang ='$item'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstock = $stocksekarang + $qty;
    $addtomasuk = mysqli_query($conn, "insert into masuk(idbarang, keterangan,qty) values('$item', '$penerima','$qty')");
    $updatestock = mysqli_query($conn, "update stock set stock='$tambahkanstock' where idbarang= '$item'");
    if ($addtomasuk && $updatestock) {
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}

if (isset($_POST['OutStock'])) {
    $item = $_POST['item'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stock where idbarang ='$item'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstock = $stocksekarang - $qty;
    $addtokeluar = mysqli_query($conn, "insert into keluar(idbarang, penerima,qty) values('$item', '$penerima','$qty')");
    $updatestock = mysqli_query($conn, "update stock set stock='$tambahkanstock' where idbarang= '$item'");
    if ($addtokeluar && $updatestock) {
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
    }
}


if (isset($_POST['updatestock'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}


if (isset($_POST['deletestock'])) {
    $idb = $_POST['idb'];
    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");

    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}
