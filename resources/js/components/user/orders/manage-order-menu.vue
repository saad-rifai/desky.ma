<template>
    <div>
        <div class="dropdown">
            <button
                class="btn btn-primary btn-sm dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-expanded="false"
            >
                ادارة الطلب <i class="fas fa-caret-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">ايقاف تلقي العروض</a>
                <a class="dropdown-item" href="#">الابلاغ عن مشكلة</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  props:['oid'],
  data(){
    return{
      status: "",
    }
  },
  methods:{
    getOrderStatus(){

      axios.get('/ajax/order/status/get/'+this.oid).then((response) => {
        this.data = response.data.status;
      }).catch((error) => {
        console.log(error);
      });
    }
  },
  created(){
    this.getOrderStatus();
  }
}
</script>