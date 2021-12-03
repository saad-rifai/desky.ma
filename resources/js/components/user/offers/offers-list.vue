<template>
  <div>
    <div
      class="card p-4 mb-4 position-relative vs-con-loading__container"
      id="div-with-loading12"
    >
      <vs-prompt
        @accept="AcceptOffer()"
        title="قبول العرض"
        color="warning"
        accept-text="قبول العرض"
        cancel-text="الغاء"
        :active.sync="activePromptCheck"
      >
        <p>
          هل انت متأكد من أنك تود قبول هذا العرض وتوظيف هذا المقاول الذاتي ؟
        </p>
      </vs-prompt>
      <vs-prompt
        @accept="OrderNextStatu()"
        title="تنبيه"
        color="danger"
        accept-text="لا"
        cancel-text="نعم"
        :active.sync="OrderStatusCheck"
      >
        <p>
          هل لازلت تود تلقي عروض جديدة من المقاولين الذاتيين على هذه الصفقة ؟
        </p>
      </vs-prompt>

      <!--h1 class="card-title mb-4 mt-2" style="font-size: 16px">العروض</h1-->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="home-tab"
            data-bs-toggle="tab"
            data-bs-target="#offers"
            type="button"
            role="tab"
            aria-controls="offers"
            aria-selected="true"
            @click="getNewOffer"
          >
            العروض ({{ listData.length }})
          </button>
        </li>
        <li v-if="OrderCreator" class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="profile-tab"
            data-bs-toggle="tab"
            data-bs-target="#hire"
            type="button"
            role="tab"
            aria-controls="hire"
            aria-selected="false"
            @click="getHired"
          >
            الموظفون ({{ listData2.length }})
          </button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active p-3 body-card-text"
          id="offers"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <div v-if="stopLazyLoading != true" class="lazy-load-box">
            <div v-for="index in 5" :key="index" class="lazy-load-ae-content">
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
            v-if="nodata == true"
            class="no-data-message text-center mt-4 mb-4"
          >
            لاتوجد عروض بعد
          </div>
          <div
            v-for="(item, index) in listData"
            :key="index"
            class="box-article pb-3 mb-3"
          >
            <div
              :id="item.id"
              v-bind:class="{ 'box-highlight': offerget == item.id }"
            >
              <a :href="'/@' + item.user.username">
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
                              v-if="
                                item.user.avatar != '' &&
                                item.user.avatar != null
                              "
                              :src="'/' + item.user.avatar"
                              :alt="item.user.username"
                            />
                            <img
                              src="/img/icons/avatar.png"
                              :alt="item.user.username"
                            />
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="user-name-box-article">
                            <h4>
                              {{
                                item.user.frist_name[0].toUpperCase() +
                                item.user.frist_name.substring(1)
                              }}
                              {{
                                item.user.last_name[0].toUpperCase() +
                                item.user.last_name.substring(1)
                              }}
                              <vs-tooltip
                                style="display: initial !important"
                                text="حساب مقاول ذاتي تم التحقق منه"
                              >
                                <span
                                  v-if="item.verified_account == 2"
                                  style="margin-right: 0px !important"
                                  class="
                                    verified-icon verified-2
                                    mt-2
                                    text-icon
                                  "
                                  dir="rtl"
                                ></span>
                              </vs-tooltip>
                              <vs-tooltip
                                style="display: initial !important"
                                text="حساب تم التحقق منه"
                              >
                                <span
                                  v-if="item.verified_account == 1"
                                  style="margin-right: 0px !important"
                                  class="
                                    verified-icon verified-1
                                    mt-2
                                    text-icon
                                  "
                                  dir="rtl"
                                ></span>
                              </vs-tooltip>
                            </h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto mobile-hidden-1">
                      <button class="btn btn-primary btn-sm">
                        <i class="fas fa-envelope"></i>
                      </button>
                      <span class="dropdown">
                        <button
                          class="btn btn-outline-primary btn-sm"
                          id="menu_user"
                          data-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="menu_user">
                          <li><a class="dropdown-item" href="#">مراسلة</a></li>
                          <li><a class="dropdown-item" type="button" data-toggle="modal" data-target="#reportModal">التبليغ</a></li>
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
                                  parseFloat(item.userRating).toFixed(1) >= 0
                                    ? parseFloat(item.userRating).toFixed(1)
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
                                      n <= parseInt(item.userRating)
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
                              {{ item.AeAccount.job_title }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="user-info-box-article">
                        <i class="fas fa-map-marker-alt"></i>
                        المغرب, {{ item.city }}
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <div v-if="OrderCreator" class="mr-65 p-2">
                <vs-tooltip
                  style="width: max-content"
                  text="التكلفة - مدة التنفيذ"
                >
                  <span class="text-brand cur-p" dir="rtl"
                    ><strong
                      >{{ item.price }} درهم - {{ item.time }} يوم</strong
                    ></span
                  >
                </vs-tooltip>
              </div>
              <span v-if="item.status == 1" class="badge bg-warning mr-65"
                >موظف</span
              >

              <div class="mr-65" v-if="OrderCreator" id="text-wraper-desky">
                <p
                        class="box-article-description font-Naskh text-wrap-line collapse TextCollapse"
                   :id="'TextCollapse2'+index" aria-expanded="false">
                        {{ item.description }}
                    </p>
                      <a role="button" class="collapsed" data-toggle="collapse" :href="'#TextCollapse2'+index" aria-expanded="false" :aria-controls="'TextCollapse2'+index"></a>
            </div>

              <div
                v-if="OrderCreator && item.status == 0"
                class="order-act-section"
                align="left"
                dir="ltr"
              >
                <div class="row">
                  <div class="col-auto">
                    <button
                      type="button"
                      @click="
                        activePromptCheck = true;
                        userid = item.user.Account_number;
                      "
                      class="btn btn-primary btn-sm"
                    >
                      <i class="fas fa-check"></i> قبول العرض
                    </button>
                  </div>
                  <div class="col-auto">
                    <button
                      type="button"
                      class="btn btn-outline-primary btn-sm"
                    >
                      <i class="fas fa-envelope"></i> مراسلة
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div
            v-if="listData.length > 0"
            class="show-more-section text-center mt-5 mb-4"
          >
            <button
              v-if="
                allresponse.data.next_page_url &&
                allresponse.data.next_page_url != null
              "
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
              class="text-center end-data-btn"
              disabled
            >
              نهائة النتائج
            </button>
          </div>
        </div>

        <div
          class="tab-pane fade p-3 body-card-text"
          id="hire"
          role="tabpanel"
          aria-labelledby="home-tab"
          v-if="OrderCreator"
        >
          <!-- -->
          <div v-if="stopLazyLoading2 != true" class="lazy-load-box">
            <div v-for="index in 5" :key="index" class="lazy-load-ae-content">
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
            v-if="nodata2 == true"
            class="no-data-message text-center mt-5 mb-4"
          >
            <img
              src="/img/icons/215-SEARCH-AE.jpg"
              alt="   لم تقم بتوظيف مقاول بعد في هذا المشروع"
            />
            لم تقم بتوظيف مقاول ذاتي بعد في هذا المشروع
            <p class="font-Naskh">
              أختر من بين العروض المقدمة على طلبك أفضل عرض وقم بتوظيف مقاول أو
              مجموعة من المقاولين الذاتيين
            </p>
          </div>
          <div
            v-for="(item, index) in listData2"
            :key="index"
            class="box-article pb-3 mb-3"
          >
            <div v-bind:class="{ 'box-highlight': offerget2 == item.id }">
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
                                      <a :href="'/@' + item.user.username">

                          <div class="avatar-large-box-article">
                            <img
                              v-if="
                                item.user.avatar != '' &&
                                item.user.avatar != null
                              "
                              :src="'/' + item.user.avatar"
                              :alt="item.user.username"
                            />
                            <img
                              src="/img/icons/avatar.png"
                              :alt="item.user.username"
                            />
                          </div></a>
                        </div>
                        <div class="col-auto">
                          <div class="user-name-box-article">
                                                                  <a :href="'/@' + item.user.username">

                            <h4>
                              {{
                                item.user.frist_name[0].toUpperCase() +
                                item.user.frist_name.substring(1)
                              }}
                              {{
                                item.user.last_name[0].toUpperCase() +
                                item.user.last_name.substring(1)
                              }}
                              <vs-tooltip
                                style="display: initial !important"
                                text="حساب مقاول ذاتي تم التحقق منه"
                              >
                                <span
                                  v-if="item.verified_account == 2"
                                  style="margin-right: 0px !important"
                                  class="
                                    verified-icon verified-2
                                    mt-2
                                    text-icon
                                  "
                                  dir="rtl"
                                ></span>
                              </vs-tooltip>
                              <vs-tooltip
                                style="display: initial !important"
                                text="حساب تم التحقق منه"
                              >
                                <span
                                  v-if="item.verified_account == 1"
                                  style="margin-right: 0px !important"
                                  class="
                                    verified-icon verified-1
                                    mt-2
                                    text-icon
                                  "
                                  dir="rtl"
                                ></span>
                              </vs-tooltip>
                            </h4></a>
                          </div>
                        </div>
                                   
                      </div>
                    </div>
                    <div class="col-auto mobile-hidden-1">
                      <div class="row">
                        <div class="col-auto p-1">
                          <button class="btn btn-primary btn-sm">
                            <i class="fas fa-envelope"></i>
                          </button>
                        </div>
                        <div class="col-auto p-1 " @click.stop>
                          <vs-dropdown vs-trigger-click @click.stop>
                            <vs-button
                              class="btn btn-outline-primary btn-sm"
                              type="filled"
                              icon="more_vert"
                            ></vs-button>
                            <!-- <a href="#">Hola mundo</a> -->

                            <vs-dropdown-menu>
                              <vs-dropdown-item>التبليغ</vs-dropdown-item>
                              <vs-dropdown-item> الغاء التوظيف </vs-dropdown-item>
                         
                            </vs-dropdown-menu>
                          </vs-dropdown>
                        </div>
                      </div>
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
                                  parseFloat(item.userRating).toFixed(1) >= 0
                                    ? parseFloat(item.userRating).toFixed(1)
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
                                      n <= parseInt(item.userRating)
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
                              {{ item.AeAccount.job_title }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <div class="user-info-box-article">
                        <i class="fas fa-map-marker-alt"></i>
                        المغرب, {{ item.city }}
                      </div>
                    </div>
                  </div>
                </div>
             
              <div v-if="OrderCreator" class="mr-65 p-2">
                <vs-tooltip
                  style="width: max-content"
                  text="التكلفة - مدة التنفيذ"
                >
                  <span class="text-brand cur-p" dir="rtl"
                    ><strong
                      >{{ item.price }} درهم - {{ item.time }} يوم</strong
                    ></span
                  >
                </vs-tooltip>
              </div>
              <span v-if="item.status == 1" class="badge bg-warning mr-65"
                >موظف</span
              >
              <div class="mr-65" v-if="OrderCreator" id="text-wraper-desky">
                <p
                        class="box-article-description font-Naskh text-wrap-line collapse TextCollapse"
                   :id="'TextCollapse1'+index" aria-expanded="false">
                        {{ item.description }}
                    </p>
                      <a role="button" class="collapsed" data-toggle="collapse" :href="'#TextCollapse1'+index" aria-expanded="false" :aria-controls="'TextCollapse1'+index"></a>
            </div>
            </div>
          </div>

          <div
            v-if="listData2.length > 0"
            class="show-more-section text-center mt-5 mb-4"
          >
            <button
              v-if="
                allresponse2.data.next_page_url &&
                allresponse2.data.next_page_url != null
              "
              style="margin-right: 0 !important"
              type="button"
              class="btn btn-primary text-center"
              @click="ShowMore2"
            >
              مشاهدة المزيد
            </button>
            <button
              v-else
              style="margin-right: 0 !important"
              type="button"
              class="end-data-btn text-center"
              disabled
            >
              نهائة النتائج
            </button>
          </div>
          <!-- -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["oid", "offerget", "offerget2"],
  data() {
    return {
      userid: null,
      stopLazyLoading: false,
      stopLazyLoading2: false,
      allresponse: [],
      allresponse2: [],
      OrderCreator: false,
      listData2: [],
      listData: [],
      activePromptCheck: false,
      nodata: false,
      nodata2: false,
      OrderStatusCheck: false,
    };
  },
  methods: {
    AcceptOfferCheck() {
      this.$vs.dialog({
        type: "confirm",
        color: "success",
        title: `قبول العرض`,
        text: "هل انت متأكد من أنك تود قبول هذا العرض وتوظيف هذا المقاول الذاتي ؟",
        accept_text: "قبول",
        accept: this.AcceptOffer,
      });
    },
    AcceptOffer() {
      let data = new FormData();
      data.append("OID", this.oid);
      data.append("userid", this.userid);
      axios
        .post("/ajax/order/hire/user", data)
        .then((response) => {
          $("#profile-tab").click();
          this.$vs.notify({
            title: "تمت العملية بنجاح",
            text: "لقد قمت بتوظيف مقاول ذاتي لتنفيذ طلبك.",
            color: "success",
            fixed: true,
            icon: "check",
          });
          this.OrderStatusCheck = true;
        })
        .catch((error) => {
          this.$vs.notify({
            title: "فشلة العملية",
            text: "حدث خطأ ما أثناء محاولة تنفيذ طلبك يرجى اعادة المحاولة.",
            color: "danger",
            fixed: true,
            icon: "check",
          });
        });
    },
    OrderNextStatu() {
      let data = new FormData();
      data.append("OID", this.oid);
      data.append("s", "2");
      axios
        .post("/ajax/order/status", data)
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          this.$vs.notify({
            title: "فشلة العملية",
            text: "حدث خطأ ما أثناء محاولة تنفيذ طلبك يرجى اعادة المحاولة.",
            color: "danger",
            fixed: true,
            icon: "check",
          });
        });
    },
    openLoadingInDiv() {
      this.$vs.loading({
        container: "#div-with-loading12",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv() {
      this.$vs.loading.close("#div-with-loading12 > .con-vs-loading");
    },
    getNewOffer() {
      let data = new FormData();
      data.append("OID", this.oid);
      axios
        .post("/ajax/orders/offers/new", data)
        .then((response) => {
          this.allresponse = response.data;
          this.listData = this.allresponse.data.data;
          this.OrderCreator = this.allresponse.OrderCreator;
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
          console.log(error);
          this.stopLazyLoading = true;
        });
    },
    getHired() {
      let data = new FormData();
      data.append("OID", this.oid);
      axios
        .post("/ajax/orders/offers/hired", data)
        .then((response) => {
          this.allresponse2 = response.data;
          this.listData2 = this.allresponse2.data.data;
          this.OrderCreator = this.allresponse2.OrderCreator;
          if (
            this.listData2 == undefined ||
            this.listData2 == null ||
            this.listData2 == ""
          ) {
            this.nodata2 = true;
          } else {
            this.nodata2 = false;
          }
          this.stopLazyLoading2 = true;
        })
        .catch((error) => {
          console.log(error);
          this.stopLazyLoading2 = true;
        });
    },
    ShowMore() {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("OID", this.oid);
      if (this.allresponse.data.next_page_url != null) {
        axios
          .post(
            "/ajax/orders/offers/all/?page=" +
              (parseInt(this.allresponse.data.current_page) + 1),
            data
          )
          .then((response) => {
            this.allresponse = response.data;
            const entries = Object.values(this.allresponse.data.data);

            for (var i = 0; entries.length > i; i++) {
              this.listData.push(entries[i]);
            }
            this.HideLoadingInDiv();
          });
      } else {
        console.log(null);
      }
    },
    ShowMore2() {
      this.openLoadingInDiv();
      let data = new FormData();
      data.append("OID", this.oid);
      if (this.allresponse2.data.next_page_url != null) {
        axios
          .post(
            "/ajax/orders/offers/hired/?page=" +
              (parseInt(this.allresponse2.data.current_page) + 1),
            data
          )
          .then((response) => {
            this.allresponse2 = response.data;
            const entries = Object.values(this.allresponse2.data.data);

            for (var i = 0; entries.length > i; i++) {
              this.listData2.push(entries[i]);
            }
            this.HideLoadingInDiv();
          });
      } else {
        console.log(null);
      }
    },
  },
  created() {
    this.getNewOffer();
    this.getHired();
  },
  mounted() {
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  },
};
</script>