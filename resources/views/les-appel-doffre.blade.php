@section('title', 'les appel d’offre')
@section('active-3', 'active')
@include('layouts.head-links')
<body onload="stopLoading()">
  @include('layouts.navbar-stantard')
  <div class="page-title-holder mb-5">
    <div class="container">
      <h1 class="page-title-h">Appels d'offres ouverts (2214)</h1>
    </div>
  </div>
  <div class="container mb-5">
    <div class="row row-cols-1 ">
      <div class="col-sm-4">
        <div class="left-side-bar search-filter mb-3">
          <div class="mb-3 mt-3 position-relative">
            <h3 class="card-title"><i class="fas fa-sliders-v"></i>&nbsp; filtre de recherche</h3><span class="filter-right-arrow mb-show"><i class="fas fa-angle-down"></i></span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Nom">
          </div>
          
          <div class="mb-3">
            <select class="form-select">
              <option value="">pay</option>
            </select>
          </div>

          <div class="mb-3">
            <select class="form-select">
              <option value="">ville</option>
              <option value="">tanger</option>
            </select>
          </div>
          <div class="mb-3">
            <select class="form-select">
              <option value="">categirie</option>
              <option value="">tanger</option>
            </select>
          </div>
          <div class="mb-3">
            <select class="form-select">
              <option value="">activité</option>
              <option value="">tanger</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="customRange1" class="form-label">Budget</label>
            <input type="range" class="form-range" id="customRange1" min="0" max="100" value="70">
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                auto-entrepreneur
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
              <label class="form-check-label" for="flexCheckChecked">
                société
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
              <label class="form-check-label" for="flexCheckChecked">
                coopérative
              </label>
            </div>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-primary w-100 mt-3">Recherche</button>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="large-section">
          @for ($i =1; $i < 7; $i++) <div class="order-card-min pt-3 pb-4 mb-3">
            <div class="container">
              <button class="btn-bid mb-hide"><i class="fas fa-map-pin"></i></button>
              <div class="row">
                <div class="col-md-auto col-3 me-2">
                  <div class="order-logo">
                    <img src="{{asset('img/users/'.$i.'.jpg')}}" alt="AVATAR">
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
                  <div class="card-tags mt-2">
                    <span class="tag-standard">programmation</span>
                    <span class="tag-standard">web developments</span>
                    <span class="tag-standard"> exmple</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        @endfor
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link"><i class="fas fa-angle-left"></i></a>
          </li>
          <li class="page-item active"><a class="page-link " href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  </div>
  @include('layouts.footer')