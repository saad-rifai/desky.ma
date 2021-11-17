<template>
  <div>
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
      v-for="(item, index) in listData"
      :key="index"
      class="box-article pb-3 mb-3"
    >
      <div v-if="OrderCreator" class="offer-infos-box">
        <div class="row">
          <div class="col-sm">
            <div class="offer-info-item">
              <span class="offer-info-icon"
                ><i class="fas fa-dollar-sign"></i
              ></span>
              <h1>التكلفة</h1>
              <h2>{{ item.price }} MAD</h2>
            </div>
          </div>
          <div class="col-sm">
            <div class="offer-info-item">
              <span class="offer-info-icon"
                ><i class="fas fa-stopwatch"></i
              ></span>

              <h1>مدة التنفيذ</h1>
              <h2>{{ item.time }}</h2>
            </div>
          </div>
          <div class="col-sm">
            <div class="offer-info-item">
              <span class="offer-info-icon"
                ><i class="fas fa-briefcase"></i
              ></span>

              <h1>معرض الأعمال</h1>
              <h2>{{ item.time }}</h2>
            </div>
          </div>
        </div>
      </div>
      <a :href="'/@' + item.user.username">
        <div class="head-box-article">
          <div class="row text-center">
            <div class="col">
              <div class="row">
                <div class="col-auto">
                  <div class="avatar-large-box-article">
                    <img
                      v-if="item.user.avatar != '' && item.user.avatar != null"
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
                          class="verified-icon verified-2 mt-2 text-icon"
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
                        class="verified-icon verified-1 mt-2 text-icon"
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
                  <li><a class="dropdown-item" href="#">التبليغ</a></li>
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
      <div class="mr-65">
        <p
          class="box-article-description"
          style="line-height: 2; white-space: pre-line !important"
        >
          {{ item.description }}
        </p>
      </div>
      <div v-if="OrderCreator" class="order-act-section">
        <div class="row">
          <div class="col-auto">
            <button type="button" class="btn btn-primary mobile-btn-sm">
              <i class="fas fa-check"></i> قبول العرض
            </button>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-outline-primary mobile-btn-sm">
              <i class="fas fa-envelope"></i> مراسلة
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["oid"],
  data() {
    return {
      stopLazyLoading: false,
      allresponse: [],
      OrderCreator: false,
      listData: [],
    };
  },
  methods: {
    getData() {
      let data = new FormData();
      data.append("OID", this.oid);
      axios
        .post("/ajax/orders/offers/all", data)
        .then((response) => {
          this.allresponse = response.data;
          this.listData = this.allresponse.data.data;
          this.OrderCreator = this.allresponse.OrderCreator;
          this.stopLazyLoading = true;
        })
        .catch((error) => {
          console.log(error);
          this.stopLazyLoading = true;
        });
    },
  },
  created() {
    this.getData();
  },
};
</script>