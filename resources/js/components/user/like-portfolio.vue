<template>
  <div>
    <div v-if="show" class="btn-act-like">
      <vs-tooltip text="أعجبني هذا العمل">
        <button @click="liked_portfolio" class="like-btn" v-bind:class="{ 'active': liked}" type="button">
          <i class="far fa-thumbs-up"></i> أعجبني
        </button>
      </vs-tooltip>
    </div>
  </div>
</template>
<script>
export default {
  props: ["portfolio_id"],
  data() {
    return {
      liked: false,
      show: false,
    };
  },
  methods: {
    getData() {
      axios
        .get("/ajax/user/check/portfolio/liked/" + this.portfolio_id)
        .then((response) => {
          if (response.data.show_like == true) {
            if (response.data.already_liked == false) {
              this.liked = false;
              this.show = true;
            } else {
              this.liked = true;
              this.show = true;
            }
          } else {
            this.show = false;
          }
        });
    },
    liked_portfolio(){
      if(this.liked){
      var liked_status = 0;
this.liked = false;
      }else{
      var liked_status = 1;
this.liked = true;

      }
      let data = new FormData();
      data.append('like', liked_status);

      axios.post('/ajax/user/request/portfolio/like/'+this.portfolio_id, data);
    }
  },
  created(){

      this.getData();
  }
};
</script>