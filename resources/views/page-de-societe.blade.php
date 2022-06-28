@section('title', 'les appel d’offre')
@section('active-3', 'active')
@include('layouts.head-links')
<body onload="stopLoading()">
  @include('layouts.navbar-stantard')
  <div class="profile-banner">
      <img src="{{asset('img/background/bg-2.jpg')}}" alt="">
  </div>
<div class="container">
<div class="row mb-3">
    <div class="col-auto">
        <div class="avatar-cadre">
            <img src="{{asset('img/users/1.jpg')}}" alt="">
        </div>
    </div>
    <div class="col">

        <h1 class="user-name">
            INWI SA <span class="check-badge"  data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right"><i class="fas fa-badge-check"></i></span>
        </h1>
        <div class="order-infos">
            <span>IT Services and IT Consulting tanger</span>
            <span>450 abonnés</span>
        </div>

        <button class="btn btn-primary mt-3"><i class="fas fa-plus"></i> suivre</button>

    </div>
    <div class="col-auto">
        <div class="dropdown">
            <button class="btn-icon" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div>
    </div>
</div>


<div class="row  row-cols-1 mb-3 mt-5">
    <div class="col col-sm-8">
        <div class="card p-3 mb-4">
            <h1 class="card-title ">
                À propos
            </h1>
            <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</p>
        </div>

        <div class="card p-3 mb-4">
            <h1 class="card-title ">
                Dernières actualités
            </h1>
            <div class="post-preview mt-3 ">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                    <div class="col  mb-3">

                        <div class="card p-3">
                        <div class="row ">
                            <div class="col-auto  mt-3">
                                <div class="post-avatar">
                                    <img src="{{asset("img/users/1.jpg")}}" alt="">
                                </div>
                            </div>
                            <div class="col-auto mt-3">
                                <h1 class="post-username">NERYOU SARL</h1>
                                <span class="post-info">450 abonnés</span>
                                <br>
                                <span class="post-date">1  mois</span>
                            </div>
                        </div>
                        <br>
                        <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</p>
                        <hr class="sample-hr">
                        <div class="row">
                            <div class="col-auto text-center"><button class="post-icon"><i class="fas fa-thumbs-up"></i></button><br><span class="post-icon-text">j’aime</span></div>
                            <div class="col-auto text-center"><button class="post-icon"><i class="fas fa-comment"></i></button><br><span class="post-icon-text">comment</span></div>
                        </div>


                    </div>
                    </div>
                    <div class="col  mb-3">
                        <div class="card p-3">



                        <div class="row">
                            <div class="col-auto mt-3">
                                <div class="post-avatar">
                                    <img src="{{asset("img/users/1.jpg")}}" alt="">
                                </div>
                            </div>
                            <div class="col-auto mt-3">
                                <h1 class="post-username">NERYOU SARL</h1>
                                <span class="post-info">450 abonnés</span>
                                <br>
                                <span class="post-date">1  mois</span>
                            </div>
                        </div>
                        <br>

                        <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</p>
                        <hr class="sample-hr">
                        <div class="row">
                            <div class="col-auto text-center"><button class="post-icon"><i class="fas fa-thumbs-up"></i></button><br><span class="post-icon-text">j’aime</span></div>
                            <div class="col-auto text-center"><button class="post-icon"><i class="fas fa-comment"></i></button><br><span class="post-icon-text">comment</span></div>
                        </div>


                    </div>
                    </div>
                </div>




            </div>

            <div class="card-plus-button text-center">
                <span>voir plus</span>
            </div>

        </div>
    </div>
    <div class="col col-sm-4">
        <div class="card p-4 mb-3">
            <h3 class="card-title mb-4 ">
                Carte information
            </h3>
            <div class="row row-cols-2 card-infos">

                <div class="col"><span class="info-icon"><i class="fas fa-filter"></i></span> Type:</div>
                <div class="col">Tout</div>

                <div class="col"><span class="info-icon"><i class="fas fa-th"></i></span> Secteur, Activité : </div>
                <div class="col">commerce, vente en ligne</div>

                <div class="col"><span class="info-icon"><i class="fas fa-clock"></i></span> date:</div>
                <div class="col">15/05/2022</div>

                <div class="col"><span class="info-icon"><i class="fas fa-map-pin"></i></span> offres:</div>
                <div class="col">30</div>

                <div class="col"><span class="info-icon"><i class="fas fa-bell"></i></span> appel d'offre :</div>
                <div class="col">10</div>

                <div class="col"><span class="info-icon"><i class="fas fa-map-marker-alt"></i></span> lieu:</div>
                <div class="col">Maroc, Tanger</div>

                <div class="col"><span class="info-icon"><i class="fas fa-star"></i></span> Évaluation:</div>
                <div class="col"> <span class="star-yell"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>  <span class="star-grey"><i class="fas fa-star"></i></span></div>
            </div>
        </div>

    </div>
</div>

</div>
  @include('layouts.footer')