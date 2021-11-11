<template>
  <span id="loadform">
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
        <li @click="deletePortfolio">
          <a class="dropdown-item" href="#">حذف</a>
        </li>
      </ul>
    </span>
  </span>
</template>
<script>
export default {
  props: ["portfolio_id", "username"],
  data() {
    return {};
  },
  methods: {
    openLoadingInDiv: function () {
      this.$vs.loading({
        container: "#loadform",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      this.$vs.loading.close("#loadform > .con-vs-loading");
    },
    deletePortfolio() {
      this.openLoadingInDiv();
      axios
        .post("/ajax/user/portfolio/delete/" + this.portfolio_id)
        .then((response) => {
          this.HideLoadingInDiv();
          this.$vs.notify({
            text: " تم حذف العمل بنجاح !",
            color: "success",
            position: "top-right",
            icon: "check",
          });
          window.location.replace("/@" + this.username+"#portfolio");
        })
        .catch((error) => {
          this.HideLoadingInDiv();

          this.$vs.notify({
            text: " حصل خطأ ما أثناء محاولة حذف العمل يرجى اعادة المحاولة *",
            color: "danger",
            position: "top-right",
            icon: "error",
          });
        });
    },
  },
};
</script>