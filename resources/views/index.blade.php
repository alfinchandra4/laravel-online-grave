<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pemakaman</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{asset('theme/img/favicon.png')}}" rel="icon">
  <link href="{{asset('theme/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="{{asset('theme/https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i')}}" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('theme/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('theme/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('theme/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('theme/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('theme/lib/magnific-popup/magnific-popup.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">

  @if (session()->has('msg'))
      <script>
        alert(" {{session()->get('msg')}} ");
      </script>
  @endif

  <!-- =======================================================
    Theme Name: Avilon
    Theme URL: https://bootstrapmade.com/avilon-bootstrap-landing-page-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">Pemakaman</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#about">Sejarah</a></li>
          <li><a href="#features">Cara pesan</a></li>
          <li><a href="#pricing">Paket</a></li>
          <li><a href="#gallery">Galeri</a></li>
          <li><a href="#" data-toggle="modal" data-target="#modalLogin">Login</a></li>
          <li><a href="#" data-toggle="modal" data-target="#modalRegister">Register</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <!-- Modal -->
      <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Login form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/login" method="post" id="loginFrm">
                @csrf
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" form="loginFrm">Login</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Register form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/register" method="post" id="register">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" form="register">Register</button>
            </div>
          </div>
        </div>
      </div>

    <div class="intro-text" style="margin-top: 120px;">
      <h2 style="font-size: 25pt;">Selamat datang di Makam Wakaf Bungur</h2>
      <p>
        <i>Ingin pesan makam praktis tanpa ribet?</i>
        </p>
      <a href="#about" class="btn-get-started scrollto">Mari mulai</a>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about" class="section-bg" style="min-height:600px">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Sejarah</h3>
          <span class="section-divider"></span>
          <p class="offset-md-2 col-md-8" style="text-align:justify">
            <b>Pemakaman Wakaf Bungur </b>adalah sebuah Pemakaman Wakaf di Jakarta Selatan tepatnya berada di jalan Ciputat Raya, Kebaoran Lama. pemakaman wakaf yang terletak dekat dengan mall gandaria city ini di khususkan kepada masyrakat yang tinggal di kelurahan kebayoran lama utara saja. Jam operasional makam wakaf bungur ini dari pukul 6 pagi sampai 6 malam. Pemakaman ini dalam proses pemesanannya masih manual. Proses pemesanan secara manual belum dapat memenuhi kebutuhan masyarakat karena dinilai merepotkan. Masyarakat membutuhkan lebih banyak waktu apabila harus datang langsung ke Pemakaman untuk melakukan pemesanan, khususnya bagi masyarakat yang bertempat tinggal jauh dari lokasi Pemakaman tersebut.
          </p>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Product Featuress Section
    ============================-->
    <section id="features">
      <div class="container">

        <div class="row p-5">

          <div class="offset-lg-3 col-lg-6">
            <div class="section-header wow fadeIn" data-wow-duration="1s">
              <h3 class="section-title">Pesan makam mudah?</h3>
              <span class="section-divider"></span>
            </div>
          </div>

          {{-- <div class="col-lg-4 col-md-5 features-img">
            <img src="{{asset('theme/img/product-features.png')}}" alt="" class="wow fadeInLeft">
          </div> --}}
          {{-- <div class="col-lg-8 col-md-7 "> --}}
          <div class="col-md-12">


            <div class="row">

              <div class="col-lg-6 col-md-6 box wow fadeInRight">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
                <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident clarida perendo.</p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.1s">
                <div class="icon"><i class="ion-ios-flask-outline"></i></div>
                <h4 class="title"><a href="">Dolor Sitema</a></h4>
                <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata noble dynala mark.</p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.2s">
                <div class="icon"><i class="ion-social-buffer-outline"></i></div>
                <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur teleca starter sinode park ledo.</p>
              </div>
              <div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.3s">
                <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
                <h4 class="title"><a href="">Magni Dolores</a></h4>
                <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum dinoun trade capsule.</p>
              </div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- #features -->


    <!--==========================
      Pricing Section
    ============================-->
    <section id="pricing" class="section-bg">
      <div class="container">

        <div class="section-header">
          <h3 class="section-title">Pilihan paket</h3>
          <span class="section-divider"></span>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row">
          @php
              $packages = App\Package::where('active', 1)->get();
          @endphp
            @foreach ($packages as $pkg)
              <div class="col-lg-4 col-md-6">
                <div class="box wow fadeInLeft" style="min-height:450px">
                  <h3>{{$pkg->name}}</h3>
                  <h4><sup>Rp.</sup>{{number_format($pkg->price)}}</h4>
                  <ul>
                    @foreach ($pkg->package_detail as $detail)
                      <li><i class="ion-android-checkmark-circle"></i>{{$detail->value}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endforeach
        </div>
      </div>
    </section><!-- #pricing -->

    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Galeri</h3>
          <span class="section-divider"></span>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row no-gutters">

          @php
              $galleries = App\Gallery::all();
          @endphp
          @foreach ($galleries as $pict)
            <div class="col-lg-4 col-md-6">
              <div class="gallery-item wow fadeInUp">
                <a href="{{asset('gallery/'.$pict->pathname)}}" class="gallery-popup" >
                  <img src="{{asset('gallery/'.$pict->pathname)}}" alt="" width="200px" height="300px">
                </a>
              </div>
            </div>
          @endforeach

        </div>

      </div>
    </section><!-- #gallery -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container">
        <div class="row wow fadeInUp">

          <div class="col-lg-4 col-md-4">
            <div class="contact-about">
              <h4>Sistem Informasi Pemakaman</h4>
              <p>Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <i class="ion-ios-location-outline"></i>
                <p>
                  Jl. Ciputat Raya, RT.7/RW.8, Kby. Lama Utara, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta
                </p>
                {{-- <p>A108 Adam Street<br>New York, NY 535022</p> --}}
              </div>

              <div>
                <i class="ion-ios-email-outline"></i>
                <p>pesanmakam@gmail.com</p>
              </div>

              <div>
                <i class="ion-ios-telephone-outline"></i>
                <p>+62812 8919 0918</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.508451551896!2d106.7790355!3d-6.2469755!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa06d2d729bcb63e0!2sMakam%20Wakaf%20Bungur!5e0!3m2!1sid!2sid!4v1578826837072!5m2!1sid!2sid" width="430" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>Sistem Informasi Pemakaman</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Avilon
            -->
            Designed by <a href="https://bootstrapmade.com/">
              <i class="fa fa-heart" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <!-- <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">Sejarah</a> -->
            <!-- <a href="#contact">Hubungi kami</a> -->
            <!-- <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a> -->
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{asset('theme/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('theme/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('theme/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('theme/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('theme/lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{asset('theme/lib/superfish/superfish.min.js')}}"></script>
  <script src="{{asset('theme/lib/magnific-popup/magnific-popup.min.js')}}"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="{{asset('theme/js/main.js')}}"></script>

</body>
</html>
