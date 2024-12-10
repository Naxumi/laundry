<?php

// fungsi menampilkan
function select($query)
{
    // panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// fungsi menambahkan data transaksi
function create_transaksi($post)
{
    global $db;
    $client     = $_SESSION['client_id'];
    $jenis      = (int)$_GET['jenis_id'];
    $harga = select("SELECT harga FROM jenislaundry WHERE jenis_id = $jenis");
    $harga_per_item = $harga[0]['harga'];
    $kuantitas        = (int)$post['kuantitas'];
    $total_harga      = $kuantitas * $harga_per_item;

    // query tambah data
    $query = "INSERT INTO transaksi VALUES(null, $client, null, $jenis, default, null, null, default, $kuantitas, $total_harga)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menambahkan data transaksi
function create_transaksiadmin($post)
{
    global $db;

    $client  = $post['client'];
    $petugas       = strip_tags($post['petugas']);
    $jenis     = strip_tags($post['jenis']);
    $tanggal_pemesanan = $post['tanggal_pemesanan'];
    $tanggal_pengambilan = !empty($post['tanggal_pengambilan']) ? $post['tanggal_pengambilan'] : NULL;
    $tanggal_pengantaran = !empty($post['tanggal_pengantaran']) ? $post['tanggal_pengantaran'] : NULL;
    $status = $post['status'];
    $harga = select("SELECT harga FROM jenislaundry WHERE jenis_id = $jenis");
    $harga_per_item = $harga[0]['harga'];
    $kuantitas        = (int)$post['kuantitas'];
    $total_harga      = $kuantitas * $harga_per_item;

    // query tambah data
    $query = "INSERT INTO transaksi VALUES(null, $client, $petugas, $jenis, $tanggal_pemesanan, $tanggal_pengambilan, $tanggal_pengantaran, $status, $kuantitas, $total_harga)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang  = $post['id_barang'];
    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);

    // query ubah data
    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    // query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data client
function delete_client($id_client)
{
    global $db;

    // query hapus data mahasiswa
    $query = "DELETE FROM client WHERE client_id = $id_client";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data client
function delete_jenis($id_jenis)
{
    global $db;

    // query hapus data mahasiswa
    $query = "DELETE FROM jenislaundry WHERE jenis_id = $id_jenis";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data petugas
function delete_petugas($id_petugas)
{
    global $db;

    // query hapus data mahasiswa
    $query = "DELETE FROM petugas WHERE petugas_id = $id_petugas";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menambah data mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $foto       = upload_file();

    // check upload foto
    if (!$foto) {
        return false;
    }

    // query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk', '$telepon', '$alamat', '$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data mahasiswa
function update_mahasiswa($post)
{
    global $db;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama       = strip_tags($post['nama']);
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $fotoLama   = strip_tags($post['fotoLama']);

    // check upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    // query ubah data
    $query = "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi', jk = '$jk', telepon = '$telepon', alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menerima / menolak data laundry pesanan yang masuk
function update_order($post)
{
    global $db;
    $petugas_id     = $_SESSION['petugas_id'];
    $transaksi_id = strip_tags($post['transaksi_id']);

    $status = ($post['action'] === 'terima') ? 'diterima' : 'gagal';

    $query = "UPDATE transaksi SET status = '$status', petugas_id = '$petugas_id', tanggal_pengambilan = DEFAULT 
    WHERE transaksi_id = $transaksi_id";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi cuci pesanan
function update_ordercuci($post)
{
    global $db;
    $transaksi_id = strip_tags($post['transaksi_id']);

    $status = ($post['action'] === 'terima') ? 'dicuci' : 'gagal';
    $petugas_id     = $_SESSION['petugas_id'];

    $query = "UPDATE transaksi SET status = '$status', petugas_id = '$petugas_id' 
               WHERE transaksi_id = $transaksi_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi setrika pesanan
function update_ordersetrika($post)
{
    global $db;
    $transaksi_id = strip_tags($post['transaksi_id']);

    $status = ($post['action'] === 'terima') ? 'disetrika' : 'gagal';
    $petugas_id     = $_SESSION['petugas_id'];

    $query = "UPDATE transaksi SET status = '$status', petugas_id = '$petugas_id' 
               WHERE transaksi_id = $transaksi_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi kirim pesanan
function update_orderkirim($post)
{
    global $db;
    $transaksi_id = strip_tags($post['transaksi_id']);

    $status = ($post['action'] === 'terima') ? 'dalam pengiriman' : 'gagal';
    $petugas_id     = $_SESSION['petugas_id'];

    $query = "UPDATE transaksi SET status = '$status', petugas_id = '$petugas_id', tanggal_pengantaran = DEFAULT 
               WHERE transaksi_id = $transaksi_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi dalam kiriman pesanan
// function update_orderdalamkiriman($post)
// {
//     global $db;
//     $transaksi_id = strip_tags($post['transaksi_id']);

//     $status = ($post['action'] === 'terima') ? 'disetrika' : 'gagal';

//     $query = "UPDATE transaksi SET status = '$status' WHERE transaksi_id = $transaksi_id";

//     mysqli_query($db, $query);

//     return mysqli_affected_rows($db);
// }

// fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    // check format/extensi file
    if (!in_array($extensifile, $extensifileValid)) {
        // pesan gagal
        echo "<script>
                alert('Format File Tidak Valid');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // pesan gagal
        echo "<script>
                alert('Ukuran File Max 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan ke folder local
    move_uploaded_file($tmpName, 'assets-template/img/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi menghapus data mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets-template/img/". $foto['foto']);

    // query hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah akun client
function create_akun($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $alamat      = $post['alamat'];
    $nohp      = strip_tags($post['nohp']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO client VALUES(null, '$nama', '$username', '$email', '$password', '$alamat', '$nohp', DEFAULT)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah akun petugas
function create_petugas($post)
{
    global $db;

    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $role      = $post['role'];
    $nohp      = strip_tags($post['nohp']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // query tambah data
    $query = "INSERT INTO petugas VALUES(null, '$nama', '$username', '$email', '$password', '$role', '$nohp', DEFAULT)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah jenis laundry
function create_jenis($post)
{
    global $db;

    $nama       = strip_tags($post['nama_layanan']);
    $deskripsi   = strip_tags($post['deskripsi']);
    $harga      = $post['harga'];

    // query tambah data
    $query = "INSERT INTO jenislaundry VALUES(null, '$nama', '$deskripsi', '$harga')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun
function update_akun($post)
{
    global $db;

    $client_id    = strip_tags($post['client_id']);
    $nama       = strip_tags($post['nama']);
    $email      = strip_tags($post['email']);
    $alamat      = strip_tags($post['alamat']);
    $nohp      = strip_tags($post['nohp']);

    // query ubah data
    $query = "UPDATE client SET nama = '$nama', email = '$email', alamat = '$alamat', no_hp = '$nohp' WHERE client_id = $client_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun client dari admin
function update_client($post)
{
    global $db;

    $client_id    = strip_tags($post['client_id']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = $post['password'];
    $alamat      = $post['alamat'];
    $nohp      = strip_tags($post['nohp']);

    // query ubah data
    $query = "UPDATE client SET nama = '$nama', username = '$username', email = '$email', password = '$password', alamat = '$alamat', no_hp = '$nohp' WHERE client_id = $client_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah jenis laundry dari admin
function update_jenis($post)
{
    global $db;

    $jenis_id    = strip_tags($post['jenis_id']);
    $nama_layanan       = strip_tags($post['nama_layanan']);
    $deskripsi   = strip_tags($post['deskripsi']);
    $harga      = $post['harga'];

    // query ubah data
    $query = "UPDATE jenislaundry SET nama_layanan = '$nama_layanan', deskripsi = '$deskripsi', harga = '$harga' WHERE jenis_id = $jenis_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi ubah akun client dari admin
function update_petugas($post)
{
    global $db;

    $petugas_id    = strip_tags($post['petugas_id']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = $post['password'];
    $role      = $post['role'];
    $nohp      = strip_tags($post['nohp']);

    // query ubah data
    $query = "UPDATE petugas SET nama = '$nama', username = '$username', email = '$email', password = '$password', role = '$role', no_hp = '$nohp' WHERE petugas_id = $petugas_id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data akun
function delete_akun($id_akun)
{
    global $db;

    // query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi menghapus data transaksi
function delete_transaksi($id_transaksi)
{
    global $db;

    // query hapus data transaksi
    $query = "DELETE FROM transaksi WHERE transaksi_id = $id_transaksi";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function isActive($page) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page == $page ? 'active' : '';
}

function update_pesananclient($post) 
{
    global $db;
    $transaksi_id = strip_tags($post['transaksi_id']);
    $status = ($post['action'] === 'terima') ? 'selesai' : 'gagal';

    $query = "UPDATE transaksi SET status = '$status' WHERE transaksi_id = $transaksi_id";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}