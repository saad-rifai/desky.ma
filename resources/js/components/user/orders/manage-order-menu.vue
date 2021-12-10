<template>
    <div>
          <report-popup about="1" :from_url="from_url" ></report-popup>
  <delete-order :oid="oid"></delete-order>

        <div class="dropdown">
            <button
                class="btn btn-primary btn-sm dropdown-toggle"
                type="button"
                id="btnsend_1457"
                data-toggle="dropdown"
                aria-expanded="false"
            >
                ادارة الطلب <i class="fas fa-caret-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a
                    class="dropdown-item"
                    @click="updateStatus(2)"
                    href="#"
                    v-if="status == 1"
                    >الانتقال الى مرحلة التنفيذ</a
                >
                <a
                    class="dropdown-item"
                    @click="updateStatus(4)"
                    href="#"
                    v-if="status == 1"
                    >اغلاق نهائياََ</a
                >
                <a
                    class="dropdown-item"
                    @click="updateStatus(1)"
                    href="#"
                    v-if="status == 4"
                    >اعادة نشر الطلب</a
                >
                <a
                    class="dropdown-item"
                    type="button" 
                    data-toggle="modal" 
                    data-target="#delet_order_Modal"
                    v-if="status == 0 || status == 4 || status == 5"
                    >حذف الطلب</a
                >
                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#reportModal">الابلاغ عن مشكلة</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["oid", "from_url"],
    data() {
        return {
            status: ""
        };
    },
    methods: {
        getOrderStatus() {
            axios
                .get("/ajax/order/status/get/" + this.oid)
                .then(response => {
                    this.status = response.data.status;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        openLoadingInDiv: function() {
            $("#btnsend_1457").html(
                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> جاري التحميل...'
            );
        },
        HideLoadingInDiv: function() {
            $("#btnsend_1457").html(
                'ادارة الطلب <i class="fas fa-caret-down"></i>'
            );
        },
        updateStatus(status) {
            this.openLoadingInDiv();
            let data = new FormData();
            data.append("status", status);
            data.append("OID", this.oid);
            axios
                .post("/ajax/order/status/update", data)
                .then(response => {
                  if(status == 1){
                  $("#order_status").html('<span class="badge rounded-pill bg-success order-status">مفتوح</span>');

                  }else if(status == 2){
                  $("#order_status").html('<span class="badge rounded-pill bg-primary order-status"> مرحلة التنفيذ</span>');

                  }else if(status == 4){
                  $("#order_status").html('<span class="badge rounded-pill bg-danger order-status"> مغلق</span>');

                  }
                  this.status = status;
                    this.$vs.notify({
                        text: "تم تحديث الطلب",
                        color: "success",
                        fixed: true,
                        icon: "check"
                    });
                    this.HideLoadingInDiv();
                })
                .catch(error => {
                    console.log(error);
                    this.HideLoadingInDiv();
                });
        }
    },
    created() {
        this.getOrderStatus();
    }
};
</script>
