<template>
  <div id="div-with-loading-2">
    <div v-if="loaddata" class="d-flex justify-content-center mt-5 mb-5">
      <div class="spinner-grow c-b-p" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div v-if="nodata == true" class="no-data-message text-center mt-4 mb-4">
     لاتوجد اعمال لعرضها
    </div>
    <div class="portfolio-show-section">
        <!--div
      class="modal fade"
      :id="'work'+index"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" dir="rtl">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
             {{item.title}}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
       
            <div class="row">
        <div class="col-md-12">
            <div :id="'custCarousel-'+index" class="carousel  carousel-dark  slide" data-ride="carousel" align="center">
              
                <div class="carousel-inner">
                    <div class="carousel-item " v-bind:class="{'active': key == 0}" v-for="(image, key) in ImagesToArray(item.files)" :key="key"> <img :src="image" :alt="item.title"> </div>
                </div>  <a class="carousel-control-prev" :href="'#custCarousel-'+index" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" :href="'#custCarousel-'+index" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> 
                <ol class="carousel-indicators list-inline">
                    <li class="list-inline-item"  v-bind:class="{'active': key == 0}"  v-for="(image, key) in ImagesToArray(item.files)" :key="key"> <a :id="'carousel-selector-'+index+''+key" class="selected" :data-slide-to="index+''+key" :data-target="'#custCarousel-'+index" > <img :src="image" class="img-fluid" :alt="item.title"> </a> </li>
                </ol>
            </div>
        </div>
    </div>
       
       
            <div class="p-2 position-relative">
              <h1 class="card-title mb-4 mt-2" style="font-size: 16px">
                وصف العمل
              </h1>
              <div
                class="footer-social-media mb-3 position-absolute top-0 end-0"
              >
                <ul class="list-social-media bg-border">
                  <li>
                    <a
                      target="_blank"
                      href="https://www.facebook.com/Youcandotshop"
                    >
                      <i class="fab fa-facebook-square"></i>
                    </a>
                  </li>
                  <li>
                    <a target="_blank" href="https://twitter.com/Youcandotshop">
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a
                      target="_blank"
                      href="https://www.linkedin.com/company/youcandotshop/"
                    >
                      <i class="fab fa-linkedin"></i>
                    </a>
                  </li>

                  <li>
                    <a
                      target="_blank"
                      href="https://www.youtube.com/c/Youcandotshop"
                    >
                      <i class="fas fa-share-alt"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="body-card-text">
                <p>
                    {{item.description}}
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
            >
              اغلاق
            </button>
          </div>
        </div>
      </div>
    </div-->
      <div class="row row-cols-sm-3 mx-auto">
        <div
        v-for="(item, index) in listData" :key="index" 
          class="col-sm"
          type="button"
          data-bs-toggle="modal"
          :data-bs-target="'#work'+index"
        >
          <div class="box-portfolio card shadow-sm">
            <div class="box-portfolio-thumbnile">

              <img :src="getThumbnail(item.files)" :alt="item.title" />
            </div>
            <div class="box-portfolio-title">
              <a href="#">{{item.title}}</a>
            </div>
          </div>
        </div>
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
      files: []
    };
  },
  methods: {
      ImagesToArray: function(files){
        let data = JSON.parse(files);
        return data;
      },
      getThumbnail: function(files){
        let data = JSON.parse(files);
        return data[0];
      },
    openLoadingInDiv: function () {
      this.$vs.loading({
        container: "#div-with-loading-2",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      this.$vs.loading.close("#div-with-loading-2 > .con-vs-loading");
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