<template>
  <div>
  <delete-order :oid="oid_selected"></delete-order>

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
               <form align="right">
        
            <div class="mb-3 ">
              <label class="form-label">الحالة</label>
                <vs-select @change="Search" width="100%" v-model="status">
                <vs-select-item value="" text="الكل" />
                <vs-select-item value="0" text="جديد" />
                <vs-select-item value="1" text="تم القبول " />
                <vs-select-item value="2" text="  تم الانجاز " />
                <vs-select-item value="3" text="تم الالغاء" />

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
          <form align="right">
        
            <div class="mb-3">
              <label class="form-label">الحالة</label>
                <vs-select @change="Search" width="100%" v-model="status">
                <vs-select-item value="" text="الكل" />
                <vs-select-item value="0" text="جديد" />
                <vs-select-item value="1" text="تم القبول " />
                <vs-select-item value="2" text="  تم الانجاز " />
                <vs-select-item value="3" text="تم الالغاء" />

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
              <div v-for="index in 5" :key="index" class="lazy-load-ae-content">
                <div class="row">
                  <div class="col">
                    <div class="lazy-load-ae load-name"></div>
                    <div class="lazy-load-ae down-name"></div>
                  </div>
                </div>
                <div class="lazy-load-ae load-description lazy-order"></div>
              </div>
            </div>

              <div class="box-article pb-3 mb-4" v-for="(item, index) in listData"
              :key="index">
            <a :href="'/order/' + item.OID">
                <div class="head-box-article">
                  <div class="row text-center">
                    <div class="col">
                      <h1 align="right" class="title-box-article">
                       <span v-if="item.status == 0" class="badge bg-warning badge-sm">جديد</span> 
                       <span v-if="item.status == 1" class="badge bg-success badge-sm">تم القبول</span>  
                       <span v-if="item.status == 2" class="badge bg-success badge-sm">  تم الانجاز</span>  
                       <span v-if="item.status == 3" class="badge bg-danger badge-sm">  تم الالغاء </span>  
                       {{ item.OrderInfo.title }}
                      </h1>
                    </div>
                    <div v-if="item.status > 0" class="col-3">
                        <div align="left" class="box-article-cta">
                            <a :href="'/deal/'+item.OID+'/manage'"><button class="btn btn-primary btn-sm" @click="RedirectTo('/deal/'+item.OID+'/manage')"><i class="fas fa-cog"></i> ادارة</button></a>
                            
                        </div>

                    </div>
     
                  </div>
                  <div class="row ps-2">
           
                    <div class="col-auto">
                      <div class="user-info-box-article">
                        <i class="fas fa-map-marker-alt"></i>
                        <span v-if="item.OrderInfo.place && item.OrderInfo.place != 'remotely'"
                          >{{ citiesJson[item.OrderInfo.place].ville }}, المغرب</span
                        >
                        <span v-else>عن بعد</span>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="body-box-article mb-3">
                  <p class="box-article-description font-Naskh">
                    {{ item.OrderInfo.description }}
                  </p>
                </div>
                <div></div>
                  </a>
              </div>
          
          </div>

          <div class="show-more-section text-center mt-5">
            <button
              v-if="allresponse.next_page_url != null"
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
              نهاية النتائج
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ListCities from "../../../../../public/data/json/list-moroccan-cities.json";

export default {
  data() {
    return {
      citiesJson: ListCities,
      allresponse: [],
      listData: [],
      stopLazyLoading: false,
      nodata: false,
      remotely: false,
      budget: [150, 500000],
      time: 180,
      typeget: "all",
      status: "",
      oid_selected: null
    };
  },
  methods: {
    reset() {

      this.status = "",

      this.getData();
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
    RedirectTo(to){
        window.location.href = to;
    },
    getData() {
      this.stopLazyLoading = false;
      this.typeget = "all";
      axios
        .get("/ajax/MyOffers/all")
        .then((response) => {
          this.allresponse = response.data.data;
          this.listData = this.allresponse.data;
          if (
            this.listData == undefined ||
            this.listData == null ||
            this.listData == ""
          ) {
            this.nodata = true;
          } else {
            this.nodata = false;
          }
          this.stopLazyLoading = true;
        })
        .catch((error) => {
          this.stopLazyLoading = true;

          console.error(error);
        });
    },
    ShowMore() {
      this.openLoadingInDiv();

      if (this.allresponse.next_page_url != null) {
        axios
          .get(
            "/ajax/MyOffers/" +
              this.typeget +
              "/?page=" +
              (parseInt(this.allresponse.current_page) + 1)
          )
          .then((response) => {
            this.allresponse = response.data.data;
            const entries = Object.values(this.allresponse.data);

            for (var i = 0; entries.length > i; i++) {
              this.listData.push(entries[i]);
            }
            this.HideLoadingInDiv();
          });
      } else {
        console.log(null);
      }
    },
    Search() {
      this.typeget = "search";
      this.openLoadingInDiv();
      let data = new FormData();
      if (this.status != null) {
        data.append("st", this.status);
      } else {
        data.append("st", "");
      }
    


      axios.post("/ajax/MyOffers/search", data).then((response) => {
        this.allresponse = response.data.data;
        this.listData = response.data.data.data;
        if (
          this.listData == undefined ||
          this.listData == null ||
          this.listData == ""
        ) {
          this.nodata = true;
        } else {
          this.nodata = false;
        }
        this.HideLoadingInDiv();
      });
    },
  },
  created() {
    this.getData();
  },
};
</script>