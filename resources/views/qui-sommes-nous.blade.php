@section('title', 'Qui sommes-nous')
@section('active-5', 'active')
@include('layouts.head-links')

<body onload="stopLoading()">
    @include('layouts.navbar-stantard')
    <header class="header mb-5">
        <div class="container mb-5">
            <div class="row text-center mx-auto  row-cols-1 row-cols-sm-1 row-cols-md-2 mb-5">
                <div class="col">
                    <div class="header-text text-start ">
                        <h1 class="text-orange display-2 fw-bold">
                            Plateforme d'appel d'offres pour le Maroc
                        </h1>
                    </div>
                </div>
                <div class="col">
                    <div class="header-text text-start ">
                        <p class=" fs-5">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la
                            mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie
                            depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte
                            pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq
                            siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en
                            soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset
                            contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des
                            applications de mise en page de texte, comme Aldus PageMaker.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="bg-orange-brand mt-5 pt-3 pb-3" style="
    max-width: 1500px;
    margin-right: auto;
    margin-left: auto;
">
        <div class="container">
            <div class="row h-700 text-center mx-auto mt-5 row-cols-1 row-cols-sm-1 row-cols-md-2 align-items-center">
                <div class="col align-self-center ">
                    <div class=" text-start">
                        <h1 class="text-light">Où travaillons-nous ?</h1>
                        <p class="text-light">Le Lorem Ipsum est simplement du faux texte employé dans la composition et
                            la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie
                            depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte
                            pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq
                            siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en
                            soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset
                            contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des
                            applications de mise en page de texte, comme Aldus PageMaker.
                        </p>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="video-thumb position-relative">
                        <div class="video-shadow">
                        </div>
                        <img src="{{asset('img/maroc-flag.jpg')}}" alt="">
                        <div class="video-thumb-background"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rows-container">
        <h1 class="page-title text-center mt-5">administration</h1>
        <div class="container mt-5 mb-5">
            <div class="row mx-auto text-center justify-content-md-center justify-content-center">
                <div class="col-md-auto mx-auto mt-3">
                    <div class="avatar-large">
                        <img src="{{asset('img/administration-board/adil-miftah.jpg')}}" alt="" style="width: 300%;
                        object-fit: cover;
                        object-position: -145px -10px;">
                    </div>
                    <h1 class="fs-3 mt-2">ADIL MIFTAH</h1>
                    <p class="fs-6 fw-light mt-2">chief executive officer</p>
                    <div class="icons-list">
                        <a href="#"><button class="icon-round-button"><i class="fab fa-facebook-f"></i></button></a>
                        <a href="#"><button class="icon-round-button"><i class="fab fa-instagram"></i></button></a>
                        <a href="#"> <button class="icon-round-button"><i class="fab fa-linkedin"></i></button></a>
                        <a href="#"> <button class="icon-round-button"><i class="fab fa-twitter"></i></button></a>
                    </div>
                </div>
                <div class="col-md-auto mx-auto mt-3">
                    <div class="avatar-large">
                        <img src="{{asset('img/administration-board/saad-rifai.jpeg')}}" alt="" style="    width: 250%;
                        object-fit: cover;
                        object-position: -120px -100px;">
                    </div>
                    <h1 class="fs-3 mt-2">SAAD RIFAI</h1>
                    <p class="fs-6 fw-light mt-2">chief operating officer</p>
                    <div class="icons-list">
                        <a href="#"><button class="icon-round-button"><i class="fab fa-facebook-f"></i></button></a>
                        <a href="#"><button class="icon-round-button"><i class="fab fa-instagram"></i></button></a>
                        <a href="#"> <button class="icon-round-button"><i class="fab fa-linkedin"></i></button></a>
                        <a href="#"> <button class="icon-round-button"><i class="fab fa-twitter"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 class="page-title text-center">Nos Partenaires</h1>
    <div class="container mt-5 mb-5">
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
    <h1 class="page-title text-center">ils ont dit de nous</h1>
    <div class="container mt-5 mb-5">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 justify-content-md-center mx-auto text-center">
            <div class="col mb-4  mx-auto text-center">
                <img class="brand-logo-slid" src="{{asset('img/media/ÉCO.ma_.png')}}" alt="ÉCO.ma">
            </div>
            <div class="col mb-4 mx-auto text-center">
                <img class="brand-logo-slid" src="{{asset('img/media/leconomiste.png')}}" alt="leconomiste">
            </div>
            <div class="col mb-4  mx-auto text-center">
                <img class="brand-logo-slid" src="{{asset('img/media/aujourdhui-le-maroc.jpg')}}" alt="aujourdhui-le-maroc">
            </div>
            <div class="col mb-4 mx-auto text-center">
                <img class="brand-logo-slid" src="{{asset('img/media/industrie-de-maroc-magazine.png')}}" alt="industrie-de-maroc-magazine">
            </div>
        </div>
    </div>

    <div class="bg-orange-brand">
        <div class="container">
            <h1 class="page-title text-center text-light pt-5">Contactez nous</h1>
            <div class="row pb-5  mx-auto mt-5 row-cols-1 row-cols-sm-1 row-cols-md-2 ">
                <div class="col align-self-center ">
                    <div class=" text-start">
                        <form  class="w-100">
                            <div class="row w-100 row-cols-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Prénom">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="email">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Tel">
                                      </div>
                                </div>
                                <div class="col w-100">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="subject">
                                      </div>
                                </div>
                                <div class="col w-100">
                                    <div class="mb-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="col w-100 ">
                                    <div class="mb-3 ">
                                    <button class="btn btn-outline-primary">envoyer</button>    
                                    </div>
                                </div>
                            </div>
                          </form>
      
                    </div>
                </div>
                <div class="col text-left">
                  <ul class="list-contact">
                        <li class="mb-3"><button class="icon-round-button text-light"><i class="fas fa-map-marker-alt"></i></button> Technopark Etg 2 N°202 Tanger </li>
                        <li class="mb-3"><button class="icon-round-button text-light"><i class="fas fa-at"></i></button> contact@neryou.ma </li>
                        <li class="mb-3"><button class="icon-round-button text-light"><i class="fas fa-headphones"></i></button> 0531-975115  </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')