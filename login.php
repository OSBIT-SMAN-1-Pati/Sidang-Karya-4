
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GARUDA 21</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.d774756d.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!-- Font Awesome / icon-->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- Style css custom-->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div id="topbar">
        <div class="container">
          <div class="col-md-9">
            <ul class="top-contact">
              <li><a href=""><i class="fas fa-phone"></i> 0287-8336-1208-9</a></li>
              <li><a href=""><i class="fas fa-envelope"></i> sman1pati@sch.id</a></li>
            </ul>
          </div>
        </div>
       </div>
      </section>

      <header>
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="brand">
                <img src="assets/img/logo-red.9d2d8844.png" alt="">
                <div class="brand-name">
                  <h1>SMA Negeri 1 Pati</h1>
                  <h3>CASTRA JAYECWARA</h3>
                </div>
              </div>
            </div>
            <div class="col-md-4 pembungkus-searchbox">
              <div class="searchbox">
                <form method="get">
                  <div class="input-group">
                    <input class="form-control" type="text" name="cari" placeholder="Cari sesuatu..."
                    aria-label="Tombol Cari"
                    aria-describedby="tombol-cari">
                    <div class="input-group-append">
                      <button class="btn btn-utama" id="my-addon">Cari</button>
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- .col-md-8 -->
          </div><!-- .row -->
        </div><!-- .container -->
      </header>

      <!-- Section Menu -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-merah">
        <div class="container">
          <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse"
          aria-controls="my-nav" 
           aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
               <a class="nav-link" href="index.html">Beranda <span class="sr-only">
               (current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" 
                data-toggle="dropdown" aria-haspopup="true" 
                 aria-expanded="false" role="button">Jadwal</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="index2.html">XE-9</a>
                  <a class="dropdown-item" href="index22.html">XE-11</a>
                </div>
              <li class="nav-item">
                <a class="nav-link active" href="index3.html">Ujian</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index4.html">Tugas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index5.html">Jurnal Literasi</a>
              </li>
            </ul>
          </div>
        </div> <!-- .container -->
      </nav>

      <?php
session_start();
$error = '';
if (!empty($_POST)) {
    $pdo = require 'koneksi.php';
    $query = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $query->execute(array('email' => $_POST['email']));
    $user = $query->fetch();
    if (!$user) {
        $error = 'Email atau password salah';
    } elseif (sha1($_POST['password']) == $user['password']) {
        $_SESSION['user'] = array(
            'id' => $user['id'],
            'nama' => $user['name']
        );
        header("Location: index.php");
        exit;
    } else {
        $error = 'Email atau password salah';
    }
}
?>


    <div class="login">
        <?php
        if ($error) {
            echo '<p styles="color:red">'.$error.'</p>';
        }
        ?>
        <form action="" method="POST">
        <div class="box">
        <div class="form">
            <h2>Sign in</h2>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="Links">
                <a href="#">Forgot Password</a>
                <a href="daftar.php">Signup</a>
            </div>
            <button class="btn btn-utama" type="submit">Log In</button>
         </form>
        </div>
    </div>
    </div>

    <div class="copyright">
        <footer style="text-align: center;">
          <p>Copyright &copy; 2023 M. Enno Ramadhan A.F, Noufal Ibnu Ghifary.</p>
        </footer>
      </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/owl.carousel.min.js"></script>
      <script src="assets/js/main.js"></script>
    
</body>
</html>