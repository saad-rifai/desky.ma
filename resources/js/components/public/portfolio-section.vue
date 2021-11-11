<template>
  <div id="div-with-loading-3">
    <div v-if="loaddata" class="d-flex justify-content-center mt-5 mb-5">
      <div class="spinner-grow c-b-p" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div v-if="nodata == true" class="no-data-message text-center mt-5">
      لاتوجد اعمال لعرضها
    </div>
    <div class="portfolio-show-section">
      <div class="row row-cols-sm-3 mx-auto">
        <div
          v-for="(item, index) in listData"
          :key="index"
          class="col-sm"
          type="button"
          data-bs-toggle="modal"
          :data-bs-target="'#work' + index"
        >
          <a :href="'/portfolio/' + item.id">
            <div class="box-portfolio card shadow-sm">
              <div class="box-portfolio-thumbnile">
                <img :src="getThumbnail(item.files)" :alt="item.title" />
              </div>
              <div class="box-portfolio-title">
                <a href="#">{{ item.title }}</a>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="show-more-section text-center mt-5">
        <button
          v-if="allResponse.next_page_url != null"
          style="margin-right: 0 !important"
          type="button"
          class="btn btn-primary text-center"
          @click="ShowMore"
        >
          مشاهدة المزيد
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["account_number"],
  data() {
    return {
      allResponse: "",
      listData: [],
      typeget: "all",
      nodata: false,
      loaddata: true,
      files: [],
    };
  },
  methods: {
    ImagesToArray: function (files) {
      let data = JSON.parse(files);
      return data;
    },
    getThumbnail: function (files) {
      let data = JSON.parse(files);
      return data[0];
    },
    openLoadingInDiv: function () {
      this.$vs.loading({
        container: "#div-with-loading-3",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      this.$vs.loading.close("#div-with-loading-3 > .con-vs-loading");
    },
    getData() {
      axios
        .get(
          "ajax/user/request/user/portfolio?account_number=" +
            this.account_number
        )
        .then((response) => {
          this.allResponse = response.data;
          this.listData = this.allResponse.data;
          //    this.files = JSON.parse(this.listData[0].files)
          if (
            this.listData == undefined ||
            this.listData == null ||
            this.listData == ""
          ) {
            this.nodata = true;
          } else {
            this.nodata = false;
          }
          this.loaddata = false;
        });
    },
    ShowMore() {
      if (this.allResponse.next_page_url != null) {
        this.openLoadingInDiv();

        axios
          .get(
            "/ajax/user/request/user/portfolio?account_number=" +
              this.account_number +
              "&page=" +
              (parseInt(this.allResponse.current_page) + 1)
          )
          .then((response) => {
            this.allResponse = response.data;

            const entries = Object.values(this.allResponse.data);
            for (var i = 0; entries.length > i; i++) {
              this.listData.push(entries[i]);
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