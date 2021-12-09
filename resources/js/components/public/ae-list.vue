<template>
  <div>
<report-popup about="0" :to="ReportTo" :from_url="from_url"></report-popup>
    <!-- Mobile Filter Search -->
    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="filter-search"
      aria-labelledby="filter-search-label"
    >
      <div class="offcanvas-header" align="right" dir="rtl">
        <h5 class="offcanvas-title" id="filter-search-label">فلتر البحث</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body" align="right" dir="rtl">
        <form @submit.prevent align="right">
          <div class="mb-4">
            <label for="searchbox" class="form-label">كلمات مفتاحية</label>

            <input
              id="searchbox"
              type="text"
              class="form-control"
              v-model="query"
              @change="Search"
            />
          </div>
          <div class="mb-4">
            <label for="sector" class="form-label"> القطاع</label>

            <select
              id="sector"
              v-model="sector"
              class="form-select"
              @change="SectorChange"
            >
              <option value="">جميع القطاعات</option>
              <option value="1">الخدمات</option>
              <option value="2">التجارة</option>
              <option value="3">الصناعة</option>
              <option value="4">الحرفية</option>
            </select>
          </div>
          <div v-if="sector != '' && sector != null" class="mb-4">
            <label for="activite" class="form-label"> النشاط</label>

            <vs-select
              @change="Search"
              width="100%"
              autocomplete
              id="activite"
              v-model="activite"
            >
              <vs-select-item text="جميع النشاطات" />

              <vs-select-item
                :key="index"
                :value="index"
                :text="item"
                v-for="(item, index) in Activites"
              />
            </vs-select>
          </div>

          <div class="mb-4">
            <label for="country" class="form-label"> الدولة</label>

            <select disabled class="form-select" id="country">
              <option value="">المغرب</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label"> المدينة</label>

            <vs-select
              @change="Search"
              width="100%"
              autocomplete
              id="city"
              v-model="city"
            >
              <vs-select-item value="" text="جميع المدن" />
              <vs-select-item
                :key="index"
                :value="item.id"
                :text="item.ville"
                v-for="(item, index) in citiesJson"
              />
            </vs-select>
          </div>

          <div class="d-grid gap-2 mt-5">
            <button
              data-bs-dismiss="offcanvas"
              aria-label="Close"
              @click="Search"
              class="btn btn-primary"
              type="button"
            >
              البحث
            </button>

            <button
              data-bs-dismiss="offcanvas"
              aria-label="Close"
              @click="reset"
              class="btn btn-outline-primary"
              type="button"
            >
              اعادة التعيين
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- Mobile Filter Search -->

    <div class="container mb-5 mt-2">
      <div class="filter-mobile-toggle">
        <button
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#filter-search"
          aria-controls="filter-search"
          class="filter-mobile-toggle-btn"
        >
          <i class="fas fa-sliders-h"></i>
        </button>
      </div>
      <div class="row justify-content-md-center" dir="rtl">
        <div class="col-sm col-lg-3 filter-search-web">
          <form @submit.prevent align="right">
            <div class="mb-4">
              <label for="searchbox" class="form-label">كلمات مفتاحية</label>

              <input
                id="searchbox"
                type="text"
                class="form-control"
                v-model="query"
                @change="Search"
              />
            </div>
            <div class="mb-4">
              <label for="sector" class="form-label"> القطاع</label>

              <select
                id="sector"
                v-model="sector"
                class="form-select"
                @change="SectorChange"
              >
                <option value="">جميع القطاعات</option>
                <option value="1">الخدمات</option>
                <option value="2">التجارة</option>
                <option value="3">الصناعة</option>
                <option value="4">الحرفية</option>
              </select>
            </div>
            <div v-if="sector != '' && sector != null" class="mb-4">
              <label for="activite" class="form-label"> النشاط</label>

              <vs-select
                @change="Search"
                width="100%"
                autocomplete
                id="activite"
                v-model="activite"
              >
                <vs-select-item text="جميع النشاطات" />

                <vs-select-item
                  :key="index"
                  :value="index"
                  :text="item"
                  v-for="(item, index) in Activites"
                />
              </vs-select>
            </div>

            <div class="mb-4">
              <label for="country" class="form-label"> الدولة</label>

              <select disabled class="form-select" id="country">
                <option value="">المغرب</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="city" class="form-label"> المدينة</label>

              <vs-select
                @change="Search"
                width="100%"
                autocomplete
                id="city"
                v-model="city"
              >
                <vs-select-item value="" text="جميع المدن" />
                <vs-select-item
                  :key="index"
                  :value="item.id"
                  :text="item.ville"
                  v-for="(item, index) in citiesJson"
                />
              </vs-select>
            </div>

            <div class="d-grid gap-2 mt-5">
              <button @click="Search" class="btn btn-primary" type="button">
                البحث
              </button>

              <button
                @click="reset"
                class="btn btn-outline-primary"
                type="button"
              >
                اعادة التعيين
              </button>
            </div>
          </form>
        </div>
        <div class="col-sm">
          <div
            id="div-with-loading"
            class="box-left card p-4 vs-con-loading__container"
          >
            <div
              v-if="nodata == true"
              class="no-data-message text-center mt-4 mb-4"
            >
              لاتوجد بيانات لعرضها
            </div>
            <div v-if="stopLazyLoading != true" class="lazy-load-box">
              <div
                v-for="index in 5"
                :key="index"
                class="lazy-load-ae-content"
              >
                <div class="row">
                  <div class="col-auto lazy-load-ae load-avatar"></div>
                  <div class="col">
                    <div class="lazy-load-ae load-name"></div>
                    <div class="lazy-load-ae down-name"></div>
                  </div>
                </div>
                <div class="lazy-load-ae load-description"></div>
              </div>
            </div>
            <div
              
              v-for="(item, index) in listdata"
              :key="index"
              class="box-article pb-3 mb-3"
            >
              <a :href="'/@' + item.username">
                <div class="head-box-article">
                  <div class="row text-center">
                    <div class="col">
                      <div class="row">
                        <div class="col-auto position-relative">
                          <span
                            v-if="item.isOnline"
                            class="
                              position-absolute
                              bottom-0
                              start-100
                              translate-middle
                              p-2
                              bg-success
                              online-status
                              Search-status-user
                              border border-light
                              rounded-circle
                            "
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="متصل"
                          >
                            <span class="visually-hidden">Online</span>
                          </span>

                          <div class="avatar-large-box-article">
                            <img
                              v-if="item.avatar != '' && item.avatar != null"
                              :src="item.avatar"
                              :alt="item.username"
                            />
                            <img
                              src="/img/icons/avatar.png"
                              :alt="item.username"
                            />
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="user-name-box-article">
                            <div class="centerx">
                              <vs-tooltip text="حساب مقاول ذاتي تم التحقق منه">
                                <h4 class="">
                                  {{
                                    item.frist_name[0].toUpperCase() +
                                    item.frist_name.substring(1)
                                  }}
                                  {{
                                    item.last_name[0].toUpperCase() +
                                    item.last_name.substring(1)
                                  }}
                                  <span
                                    style="margin-right: 0px !important"
                                    class="
                                      verified-icon verified-2
                                      mt-2
                                      text-icon
                                    "
                                    dir="rtl"
                                  ></span>
                                </h4>
                              </vs-tooltip>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-if="item.Account_number != myaccountnumber" class="col-auto mobile-hidden-1">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-envelope"></i></button>
                    <span class="dropdown">
                        <button class="btn btn-outline-primary btn-sm" id="menu_user" data-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="menu_user">
                            <li><a class="dropdown-item" href="#">مراسلة</a></li>
                            <li @click="ReportTo = item.Account_number"><a class="dropdown-item" href="#reportModal" type="button" data-toggle="modal" data-target="#reportModal">التبليغ</a></li>
                        </ul>
                    </span>


                    </div>
                  </div>
                  <div class="row mr-65 mmt-35">
                    <div class="col-auto">
                      <div class="user-info-box-article">
                        <div class="row">
                          <div class="col-auto">
                            <div class="user-info-box-article">
                              <vs-tooltip
                                v-bind:text="
                                  parseFloat(item.rating).toFixed(1) >= 0
                                    ? parseFloat(item.rating).toFixed(1)
                                    : '0'
                                "
                              >
                                <span
                                  id="rating-section"
                                  class="user-rating-stars"
                                  dir="rtl"
                                >
                                  <i
                                    v-for="n in 5"
                                    :key="n"
                                    :class="
                                      n <= parseInt(item.rating)
                                        ? 'fas fa-star'
                                        : 'far fa-star'
                                    "
                                  ></i>
                                </span>
                              </vs-tooltip>
                            </div>
                          </div>
                          <div class="col-auto">
                            <div class="user-info-box-article">
                              <i class="fas fa-briefcase"></i>
                              {{ item.job_title }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="user-info-box-article">
                        <i class="fas fa-map-marker-alt"></i> المغرب,
                        {{ citiesJson[item.city].ville }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="body-box-article mr-65">
                  <p
                    class="box-article-description font-Naskh"
                    v-if="item.description != '' && item.description != null"
                  >
                    {{ item.description }}
                  </p>
                  <p class="box-article-description" v-else>
                    لم يكتب نبذة شخصية
                  </p>
                </div>
              </a>
            </div>
          </div>

          <div class="show-more-section text-center mt-5">
            <button
              v-if="Allresponse.next_page_url != null"
              style="margin-right: 0 !important"
              type="button"
              class="btn btn-primary text-center"
              @click="ShowMore"
            >
              مشاهدة المزيد
            </button>
            <button
              v-else
              style="margin-right: 0 !important"
              type="button"
              class="btn btn-primary text-center"
              disabled
            >
              نهائة النتائج
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ListCities from "../../../../public/data/json/list-moroccan-cities.json";
import Activites1 from "../../../../public/data/json/activite-ae-1.json";
import Activites2 from "../../../../public/data/json/activite-ae-2.json";
export default {
  props:['from_url', 'myaccountnumber'],
  data() {
    return {
      citiesJson: ListCities,
      Allresponse: "",
      listdata: [],
      Activites: [],
      citiesJson: ListCities,
      nodata: false,
      query: "",
      sector: "",
      activite: null,
      city: "",
      ReportTo: null,
      typeget: "all",
      stopLazyLoading: false
    };
  },

  methods: {
    reset() {
      this.activite = null;
      this.query = "";
      this.city = "";
      this.sector = "";
      this.getData();
    },
    SectorChange: function () {
      this.activite = null;
      if (this.sector == 1) {
        this.Activites = Activites2;
      } else if (this.sector == 2 || this.sector == 3 || this.sector == 4) {
        this.Activites = Activites1;
      } else {
        this.Activites = [];
        this.activite_selected = [];
      }
      this.Search();
    },
    openLoadingInDiv() {
      this.$vs.loading({
        container: "#div-with-loading",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv() {
      this.$vs.loading.close("#div-with-loading > .con-vs-loading");
    },
    getData() {
      this.typeget = "all";
      axios
        .post("/ajax/public/request/aelist/all")
        .then((response) => {
          this.Allresponse = response.data;
          this.listdata = response.data.data;
          if (
            this.listdata == undefined ||
            this.listdata == null ||
            this.listdata == ""
          ) {
            this.nodata = true;
          } else {
            this.nodata = false;
          }
          this.stopLazyLoading = true;
        })
        .catch((error) => {
          this.getData();
        });
    },
    Search() {
      this.typeget = "search";
      this.openLoadingInDiv();
      let data = new FormData();
      if (this.query != null) {
        data.append("q", this.query);
      } else {
        data.append("q", "");
      }

      if (this.sector != null) {
        data.append("s", this.sector);
      } else {
        data.append("s", "");
      }

      if (this.activite != null) {
        data.append("a", this.activite);
      } else {
        data.append("a", "");
      }

      if (this.city != null) {
        data.append("c", this.city);
      } else {
        data.append("c", "");
      }

      axios
        .post("/ajax/public/request/aelist/search", data)
        .then((response) => {
          this.Allresponse = response.data;
          this.listdata = response.data.data;
          if (
            this.listdata == undefined ||
            this.listdata == null ||
            this.listdata == ""
          ) {
            this.nodata = true;
          } else {
            this.nodata = false;
          }
          this.HideLoadingInDiv();
        });
    },
    ShowMore() {
      this.openLoadingInDiv();

      if (this.Allresponse.next_page_url != null) {
        axios
          .post(
            "/ajax/public/request/aelist/" +
              this.typeget +
              "?page=" +
              (parseInt(this.Allresponse.current_page) + 1)
          )
          .then((response) => {
            this.Allresponse = response.data;
            const entries = Object.values(this.Allresponse.data);

            for (var i = 0; entries.length > i; i++) {
              this.listdata.push(entries[i]);
            }
            this.HideLoadingInDiv();
          });
      } else {
        console.log(null);
      }
    },
  },
  created() {
    this.getData();
  },
};
</script>