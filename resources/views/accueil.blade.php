@section('title', 'accueil')
@section('active-1', 'active')
@include('layouts.head-links')

<body onload="stopLoading()">
  <header class="header-bg-1">
    <nav class="navbar navbar-expand-lg f1-head-nav fixed-top navbar-transparent">
      <div class="container">
        <button class="navbar-toggler btn-tg-white" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#"><img class="transparent-nav-logo" src="{{asset('img/logo-web-white.png')}}"
            alt="logo desky"></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
          
            <li class="nav-item">
              <a class="nav-link active effect-line" aria-current="page" href="{{asset('/')}}">Accueil</a>
            </li>

            <li class="nav-item">
              <a class="nav-link effect-line" href="{{asset('chercheurs-de-marché')}}">Chercheurs de marché</a>
            </li>

            <li class="nav-item">
              <a class="nav-link effect-line" href="{{asset('les-appel-doffre')}}">les appel d’offre</a>
            </li>

            <li class="nav-item">
              <a class="nav-link effect-line" href="#">les tarif</a>
            </li>

            <li class="nav-item">
              <a class="nav-link effect-line" href="{{asset('qui-sommes-nous')}}">Qui sommes-nous</a>
            </li>
            <li class="nav-item dropdown change-lang">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">FR</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item text-dark" href="#">AR</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">

            <button type="button" class="btn btn-link">se connecter</button>
            <button type="button" class="btn btn-primary">s'inscrire</button>

          </form>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row text-center mx-auto mt-5 row-cols-1 row-cols-sm-1 row-cols-md-2">
        <div class="col  mt-5">
          <div class="header-text text-start mt-5">
            <h1 class="text-light">
              Plateforme d'appel d'offres pour le Maroc
            </h1>
            <p class="text-light">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en
              page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500
            </p>
            <div class="mt-5">
              <button type="button" class="btn btn-primary">s'inscrire</button>

              <button type="button" class="btn btn-link">se connecter</button>
            </div>
          </div>
        </div>
        <div class="col">

        </div>
      </div>
    </div>
  </header>
  <h1 class="page-title text-center">Nos Partenaires</h1>
  <div class="container mt-5">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 justify-content-md-center mx-auto text-center">
      <div class="col mb-4  mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/partners/logo-1.png')}}" alt="tamwilcom ccg">
      </div>
      <div class="col mb-4 mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/partners/logo-2.png')}}" alt="dar al moukawil">
      </div>
      <div class="col mb-4  mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/partners/logo-3.png')}}" alt="technopark">
      </div>
      <div class="col mb-4 mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/partners/logo-4.png')}}" alt="technopark">
      </div>
    </div>
  </div>

  <div class="bg-orange-brand">
    <div class="container">
      <div class="row h-700 text-center mx-auto mt-5 row-cols-1 row-cols-sm-1 row-cols-md-2 align-items-center">
        <div class="col align-self-center ">
          <div class=" text-start">
            <h1 class="text-light">
              Plateforme d'appel d'offres pour le Maroc
            </h1>
            <p class="text-light">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en
              page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500
            </p>
            <div class="mt-5">

              <button type="button" class="btn btn-outline-primary">s'inscrire</button>
              <button type="button" class="btn btn-link text-light">se connecter</button>

            </div>
          </div>
        </div>
        <div class="col align-self-center">
          <div class="video-thumb position-relative">
            <div class="video-shadow">
              <div class="video-button position-absolute top-50 start-50 translate-middle">
                <i class="fas fa-play"></i>
              </div>
            </div>

            <img src="{{asset('img/vid-3.jpg')}}" alt="">
            <div class="video-thumb-background"></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="rows-container">
    <h1 class="page-title text-center mt-5">Comment ça marche</h1>

    <div class="container">
      <div class="row h-700 text-center mx-auto  row-cols-1 row-cols-sm-1 row-cols-md-2 align-items-center">

        <div class="col align-self-center">
          <div class="video-thumb position-relative">

            <img src="{{asset('img/assets/1.jpg')}}" alt="">
          </div>
        </div>
        <div class="col align-self-center ">
          <div class=" text-start">
            <h1 class="">
              Publier l'appel d'offre
            </h1>
            <p class="">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
              impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500</p>
            <div class="mt-5">
              <button type="button" class="btn btn-outline-primary">s'inscrire</button>

              <button type="button" class="btn btn-link">se connecter</button>
            </div>
          </div>
        </div>
      </div>
      <div dir="rtl" class="row h-700 text-center mx-auto  row-cols-1 row-cols-sm-1 row-cols-md-2 align-items-center">
        <div class="col align-self-center">
          <div class="video-thumb position-relative">

            <img src="{{asset('img/assets/2.jpg')}}" alt="">
          </div>
        </div>
        <div class="col align-self-center ">
          <div class=" text-start">
            <h1 class="">
              Recevoir des offres
            </h1>
            <p class="">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
              impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500</p>
            <div class="mt-5" dir="ltr">
              <button type="button" class="btn btn-outline-primary">s'inscrire</button>

              <button type="button" class="btn btn-link">se connecter</button>
            </div>
          </div>
        </div>


      </div>
      <div class="row h-700 text-center mx-auto  row-cols-1 row-cols-sm-1 row-cols-md-2 align-items-center">

        <div class="col align-self-center">
          <div class="video-thumb position-relative">

            <img src="{{asset('img/assets/3.jpg')}}" alt="">
          </div>
        </div>
        <div class="col align-self-center ">
          <div class=" text-start">
            <h1 class="">
              Choisissez la bonne offre
            </h1>
            <p class="">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
              impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500</p>
            <div class="mt-5">
              <button type="button" class="btn btn-outline-primary">s'inscrire</button>

              <button type="button" class="btn btn-link">se connecter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <h1 class="page-title text-center mt-5">Pourquoi nous</h1>
    <div>
      <div class="container mt-5">
        <div class="row justify-content-md-center text-center mt-5 mb-5 row-cols-1 row-cols-sm-2 row-cols-md-3">
          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description ">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>

          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description ">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>

          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description ">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>



          <div class="col mb-4">
            <div class="card-white">
              <div class="card-icon">
                <i class="fas fa-sitemap"></i>
              </div>

              <h1 class="card-title-h1 mb-4"> exmple titre</h1>

              <p class="card-description ">
                Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <h1 class="page-title text-center">Nos clients</h1>
  <div class="container mt-5">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 justify-content-md-center mx-auto text-center">
      <div class="col mb-4  mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/clieants/amendis.png')}}" alt="tamwilcom ccg">
      </div>
      <div class="col mb-4 mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/clieants/attijari.png')}}" alt="attijariwafa bank">
      </div>
      <div class="col mb-4  mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/clieants/dam-logo.png')}}" alt="technopark">
      </div>
      <div class="col mb-4 mx-auto text-center">
        <img class="brand-logo-slid" src="{{asset('img/clieants/tanger-med.png')}}" alt="technopark">
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <h1 class="page-title text-center mb-5">Questions fréquentes</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
            aria-controls="panelsStayOpen-collapseOne">
            Le Lorem Ipsum est simplement du faux texte employé dans la composition
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
          aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin
            adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseTwo">
            Accordion Item #2
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
          aria-labelledby="panelsStayOpen-headingTwo">
          <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse
            plugin adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
            aria-controls="panelsStayOpen-collapseThree">
            Accordion Item #3
          </button>
        </h2>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
          aria-labelledby="panelsStayOpen-headingThree">
          <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
            adds the appropriate classes that we use to style each element. These classes control the overall
            appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom
            CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the
            <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="banner-orange mt-5">
<div class="container">
  <div class="row align-items-center justify-content-md-center text-center">
    <div class="col-md-auto">
      <h1 class="banner-title text-light">Avez-vous d'autres questions ?</h1>
    </div>
    <div class="col-md-auto"><button type="button" class="btn btn-outline-primary">Contactez nos conseillers</button></div>
  </div>
</div>
</div>
  <footer class=" footer-black-main">
    <div class="container">
      <div class="footer-body pt-5 pb-5 ">
        <div class="row align-items-center row-cols-1 row-cols-sm-2 row-cols-md-4">
          <div class="col">
            <div class="footer-description">
              <div class="footer-logo">
                <img src="{{asset('img/logo-web-white.png')}}" alt="desky logo white">
              </div>
              <p class="text-light">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise
                en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années
                1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen
                de polices de texte.</p>
            </div>
            <div class="footer-icons-links mb-5">
              <div class="icons-list">
             <a href="#"><button class="icon-round-button"><i class="fab fa-facebook-f"></i></button></a>
                <a href="#"><button class="icon-round-button"><i class="fab fa-instagram"></i></button></a>
                <a href="#"> <button class="icon-round-button"><i class="fab fa-linkedin"></i></button></a>
                <a href="#"> <button class="icon-round-button"><i class="fab fa-twitter"></i></button></a>
              </div>
            </div>
          </div>
          <div class="col"></div>
          <div class="col">
            <ul class="footer-link-ul list-unstyled">
              <li class="list-title">À propos de la plateforme</li>
              <li><a href="#" class="effect-line">are unaffected</a></li>
              <li><a href="#" class="effect-line">will still</a></li>
              <li><a href="#" class="effect-line">and have</a></li>
            </ul>
            <ul class="footer-link-ul list-unstyled">
              <li class="list-title">Ressources</li>

              <li><a href="#" class="effect-line">are unaffected</a></li>
              <li><a href="#" class="effect-line">will still</a></li>
              <li><a href="#" class="effect-line">and have</a></li>
            </ul>
          </div>
          <div class="col">
            <ul class="footer-link-ul list-unstyled">
              <li class="list-title">Solution</li>

              <li><a href="#" class="effect-line">are unaffected</a></li>
              <li><a href="#" class="effect-line">will still</a></li>
              <li><a href="#" class="effect-line">and have</a></li>
            </ul>
            <ul class="footer-link-ul list-unstyled">
              <li class="list-title">Ressources</li>

              <li><a href="#" class="effect-line">are unaffected</a></li>
              <li><a href="#" class="effect-line">will still</a></li>
              <li><a href="#" class="effect-line">and have</a></li>
            </ul>
          </div>
        </div>
    

      </div>
      <hr>
      <div class="footer-copyright-text m-0 p-0">
        <p class="text-center">Tous droits réservés © 2022 NERYOU S.A.R.L</p>
      </div>
    </div>
    
    @include('layouts.footer')