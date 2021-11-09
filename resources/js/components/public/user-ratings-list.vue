<template>
  <div id="div-with-loading">
    <div v-if="loaddata" class="d-flex justify-content-center mt-5 mb-5">
      <div class="spinner-grow c-b-p" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div v-if="nodata == true" class="no-data-message text-center mt-4 mb-4">
      لاتوجد تقييمات بعد
    </div>
    <div
      v-for="(item, index) in listdata"
      :key="index"
      class="box-article pb-3 mb-3 mt-3 position-relative"
    >
    <a :href="'@'+item.username">

      <div class="head-box-article">
        <div class="row text-center">
          <div class="col">
            <div class="row">
              <div class="col-auto">
                <div class="avatar-large-box-article">
                  <img
                    v-if="item.avatar != '' && item.avatar != null"
                    :src="item.avatar"
                    :alt="item.username"
                  />
                  <img src="/img/icons/avatar.png" :alt="item.username" />
                </div>
              </div>
              <div class="col-auto">
                <div class="user-name-box-article">
                  <h4>
                    {{
                      item.frist_name[0].toUpperCase() +
                      item.frist_name.substring(1)
                    }}
                    {{
                      item.last_name[0].toUpperCase() +
                      item.last_name.substring(1)
                    }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="user-info-box-article">
          <span
            id="rating-section"
            class="user-rating-stars position-absolute top-0 end-0"
            dir="rtl"
          >
            <i
              v-for="n in 5"
              :key="n"
              :class="
                n <= parseInt(item.rating) ? 'fas fa-star' : 'far fa-star'
              "
            ></i>
          </span>
        </div>

        <div class="row mr-65 mmt-35">
          <div class="col-auto">
            <div class="user-info-box-article">
              <div class="row">
                <div class="col-auto">
                  <div class="user-info-box-article">
                    <i class="fas fa-briefcase"></i> {{ item.job_title }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <div class="user-info-box-article">
              <i class="fas fa-map-marker-alt"></i>
              {{ citiesJson[item.city].ville }}, المغرب
            </div>
          </div>
        </div>
      </div>
      <div class="body-box-article mr-65">
        <p class="box-article-description"></p>
        <p
          class="box-article-description"
          v-if="item.text != '' && item.text != null"
        >
          {{ item.text }}
        </p>
        <p class="box-article-description" v-else>بدون تعليق</p>
      </div>
        </a>
    </div>

  </div>
</template>
<script>
import ListCities from "../../../../public/data/json/list-moroccan-cities.json";

export default {
  props: ["ac"],
  data() {
    return {
      citiesJson: ListCities,

      Allresponse: "",
      listdata: [],
      typeget: "all",
      nodata: false,
      loaddata: true,
    };
  },
  methods: {
    openLoadingInDiv: function () {
      this.$vs.loading({
        container: "#div-with-loading",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      this.$vs.loading.close("#div-with-loading > .con-vs-loading");
    },
    getData() {
      this.typeget = "all";
      axios
        .get("/ajax/public/request/ae/ratings?ac=" + this.ac)
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
          this.loaddata = false;
        });
    },
  },
  created() {
    this.getData();
  },
};
</script>