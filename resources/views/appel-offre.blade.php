@section('title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.')
@section('active-3', 'active')
@include('layouts.head-links')


<body onload="stopLoading()">
    @include('layouts.navbar-stantard')
    <!-- Modal -->
<div class="modal fade" id="postulerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
          <div class="credit-info">

              <span class="info-icon-orange"><i class="fas fa-map-pin"></i></span> Solde 15

          </div>
        <div class="modal-body">
            <div class="mb-3">
                <textarea class="form-control" placeholder="Décrivez votre offre" rows="3"></textarea>
              </div>

              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Coût total TTC">
              </div>

              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput1">Télécharger le devis</label>

                <input type="file" class="form-control" id="exampleFormControlInput1">
              </div>

              <div class="mb-3">
                <label class="form-label" for="exampleFormControlInput2">Télécharger d'autres fichiers <span class="textOption"></span></label>

                <input type="file" class="form-control" id="exampleFormControlInput2">
              </div>
              <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label small-check-text" for="flexCheckDefault">
                        J'ai lu, lu et j'accepte les <a href="#" class="orange-text">conditions d'utilisation</a>
                    </label>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

    <div class="page-title-holder mb-5">
        <div class="container">
            <h1 class="page-title-h">
                <div class="row">
                    <div class="col-md-auto col-3 me-2 ">
                        <div class="order-logo">
                            <img src="{{asset('img/users/1.jpg')}}" alt="AVATAR">
                        </div>
                    </div>
                    <div class="col-md-auto col-8">
                        <div class="order-title">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="order-infos">
                            <span><i class="fas fa-user-circle"></i> ATTIJARI WAFA BANK SA</span>
                            <span><i class="fas fa-map-marker-alt"></i> Tanger - Maroc</span>
                            <span><i class="fas fa-map-pin"></i> 8 offre</span>
                        </div>
                    </div>
                </div>
            </h1>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row row-cols-1 ">
            <div class="col-sm-8">
                <div class="large-section">
                    <div class="card p-4 mb-3">
                        <div class="row row-cols-2 justify-content-md-center text-center">
                            <div class="col-md-auto mt-2">
                                <h3 class="title-left-simple">
                                    Ajoutez votre offre
                                </h3>
                            </div>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#postulerModal"><i class="fas fa-map-pin"></i> postuler</button>
                            </div>
                        </div>

                    </div>
                    <div class="card p-4 mb-3">
                        <h3 class="card-title mb-4 ">
                            Description de l'appel d'offres
                        </h3>
                        <span class="card-badge"><span class="badge  text-bg-success">ouvert</span> </span>
                        <p class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.

                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.
                        </p>
                    </div>
                    <div class="card p-4 mb-3">
                        <h3 class="card-title mb-4 ">
                            fichiers joints
                        </h3>
                        <ul>
                            <li class="file-link"><a href="#"><i class="fas fa-arrow-to-bottom"></i> cahier de charge
                                </a><span class="file-size-info">3Mb</span></li>
                            <li class="file-link"><a href="#"><i class="fas fa-arrow-to-bottom"></i> cahier de charge
                                </a><span class="file-size-info">3Mb</span></li>
                            <li class="file-link"><a href="#"><i class="fas fa-arrow-to-bottom"></i> cahier de charge
                                </a><span class="file-size-info">3Mb</span></li>
                            <li class="file-link"><a href="#"><i class="fas fa-arrow-to-bottom"></i> cahier de charge
                                </a><span class="file-size-info">3Mb</span></li>
                        </ul>
                    </div>
                </div>

                
            </div>
            <div class="col-sm-4">
                <div class="card p-4 mb-3">
                    <h3 class="card-title mb-4 ">
                        Carte de appel d'offre
                    </h3>
                    <div class="row row-cols-2 card-infos">
                        <div class="col"><span class="info-icon"><i class="fas fa-clock"></i></span> date:</div>
                        <div class="col">15/05/2022</div>

                        <div class="col"><span class="info-icon"><i class="fas fa-th"></i></span> Secteur, Activité :
                        </div>
                        <div class="col">commerce, vente en ligne</div>

                        <div class="col"><span class="info-icon"><i class="fas fa-dollar-sign"></i></span> budget:</div>
                        <div class="col">10,000 Dhs - 100,000 Dhs</div>

                        <div class="col"><span class="info-icon"><i class="fas fa-hourglass-end"></i></span> Temps
                            d'exécution:</div>
                        <div class="col">30 Jours</div>


                        <div class="col"><span class="info-icon"><i class="fas fa-ticket-alt"></i></span> Nombre
                            d'offres :</div>
                        <div class="col">10</div>

                        <div class="col"><span class="info-icon"><i class="fas fa-map-marker-alt"></i></span> lieu:
                        </div>
                        <div class="col">Maroc, Tanger</div>

                        <div class="col"><span class="info-icon"><i class="fas fa-filter"></i></span> Type:</div>
                        <div class="col">Tout</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')