<?php 

function uploadimg($url = null, $name = null){
    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];

// validasi file gambar yang boleh diupload
$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
$ekstensiGambar = explode('.', $namafile);
$ekstensiGambar = strtolower(end($ekstensiGambar));
if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    if($url != null){
        echo '<script>
    alert("file yang anda upload bukan gambar, Data gagal diupdate !");
    document.location.href = "' . $url .'";
    </script>';
    die();
    
} else {
    echo '<script>
    alert("file yang anda upload bukan gambar, Data gagal ditambahkan !");
    </script>';
    return false;
}
}

// validasi ukuran gambar max 1 MB
if($ukuran >1000000) {
    if($url != null){
        echo '<script>
    alert("file yang anda upload bukan gambar, Data gagal diupdate !");
    document.location.href = "' . $url .'";
    </script>';
    die();
    
} else
     echo '<script>
    alert("Ukuran gambar tidak boleh melebihi 1 MB");
    </script>';
    return false;
}

if($name != null ){
$namaFileBaru =$name . '.' . $ekstensiGambar;
} else {

$namaFileBaru = rand(10, 1000) . '-' . $namafile;
}

move_uploaded_file($tmp, '../asset/image/' . $namaFileBaru);
return $namaFileBaru;
}

function getData($sql) {
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function userLogin(){
    $userActive = $_SESSION["username"];
    $dataUser = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}

function userMenu()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $menu = $uri_segments[2];
    return $menu;
}

function menuHome(){
    if(userMenu() == 'dashboard.php') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}

function menuSetting() {
    if(userMenu() == 'user'){
        $result = 'menu-is-opening menu-open';
    } else {
        $result = null;
    }
    return $result;
}

// function menuMaster() {
//     if(userMenu() == 'supplier'){
//         $result = 'menu-is-opening menu-open';
//     } else {
//         $result = null;
//     }
//     return $result;
// }

function menuMaster() {
    if(in_array(userMenu(), ['Supplier', 'Purwakarta', 'Bekasi','Bandung', 'Bandung 2', 'Garut','Tasikmalaya', 'Cirebon', 'Tangerang','Jakarta Selatan', 'Jakarta Pusat', 'Jakarta Timur', 'Jakarta Barat'])){
        return 'menu-is-opening menu-open';
    }
    return null;
}



function menuUser(){
    if(userMenu() == 'user') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}

function menuSupplier(){
    if(userMenu() == 'supplier') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}

function menuCustomer(){
    if(userMenu() == 'customer') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}

function menuBarang(){
    if(userMenu() == 'barang') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}

function menuOperator(){
    if(userMenu() == 'Halaman Operator') {
        $result = 'active';
    } else {
        $result = null;
    }
    return $result;
}


?>