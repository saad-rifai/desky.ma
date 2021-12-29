<template>

    <div >
        <review-request-aeaccount-modal v-if="modalOpen" :orderinfos="OrderSelected"></review-request-aeaccount-modal>
        <h5 class="card-title">Join Applications ({{RequestNumber}}) <span class="icon-btn" @click="refresh"><i class="fas fa-sync"></i></span></h5>
        <table class="mb-0 table">
            <thead>
            <tr>
                <th>#</th>
                <th>Order Owner</th>
                <th>sector, activity</th>
                <th>Country, City</th>

                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in OrdersData" :key="index">
                <th scope="row">{{item.OID}}</th>
                <td>
               
                    <div class="row row-cols-2 align-items-center">
                        <div class="col col-lg-3">
                            <div class="sm-avatar">
                                <img v-if="item.user.avatar && item.user.avatar != null" :src="item.user.avatar">
                                <img v-else src="/img/icons/avatar.png">
                            </div>
                        </div>
                        <div class="col-auto">
                            <a :href="'/@'+item.user.username" target="_blank" data-placement="top" data-toggle="tooltip" title="User account preview">
                            <p class="fs-5 fw-normal pb-0 mb-0">{{item.user_fullname}}</p>
                            <p class="fs-6 text-muted pb-0 mb-0">@{{item.user.username}}</p>
                            </a>
                        </div>
                    </div>
               
                </td>
                <td align="center"  dir="auto" class="max-w-200"><strong>{{item.sector_name}}</strong>, {{item.activite_name}} </td>
                <td><span v-if=" item.place && item.place != 'remotely'">Morocco, {{citiesJson[item.place].ville}}</span><span v-else>Remotely</span></td>

                <td>{{item.date}}</td>
                <td>
                    <button @click="OrderSelected = item; modalOpen = true" class=" btn btn-primary" type="button" id="btn_review" data-target="#review_aeaccount_modal" data-toggle="modal">review
                    </button>
                    <a :href="'/@'+item.user.username" target="_blank">
                    <button class=" btn btn-outline-primary"><i class="fa fa-link"></i> preview
                    </button>
                    </a>
                </td>
            </tr>
       
    
            </tbody>
        </table>
        <div class="pagination_desky mx-auto mt-5">
            <nav class="" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-if="current_page > 1" class="page-item" @click="NextPage(current_page-1)"><a href="javascript:void(0);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                    <li v-for="(item,index) in Pages" :key="index" v-bind:class="{'active': current_page == index+1}" class="page-item" @click="NextPage(index+1)"><a href="javascript:void(0);" class="page-link">{{index+1}}</a></li>
                    <!--li class="page-item active"><a href="javascript:void(0);" class="page-link">2</a></li-->
                 
                    <li v-if="current_page < Pages" class="page-item" @click="NextPage(current_page+1)"><a href="javascript:void(0);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
import ListCities from "/public/data/json/list-moroccan-cities.json";

export default {
    data() {
        return {
            citiesJson: ListCities,
            serverResponse: [],
            OrdersData: [],
            Pages: 0,
            current_page: 1,
            OrdersNumber: 0,
            OrderSelected: [],
            modalOpen: false,
            RequestNumber: "",
            
        }
    },
    methods:{
    openLoadingInDiv: function () {

      this.$vs.loading({
        container: "#card_load",
        scale: 0.6,
        color: "#f96a0c",
      });
    },
    HideLoadingInDiv: function () {
      this.$vs.loading.close("#card_load > .con-vs-loading");
    },
    NextPage(page){
        this.openLoadingInDiv();
        this.current_page = page;
        this.getData();
    },
    refresh(){
        this.openLoadingInDiv();
        this.getData();  
    },
    getData(){
            //this.openLoadingInDiv();
            axios.get('/admin/ajax/aeaccount/pending/get/json?page='+this.current_page).then((response) => {
                this.serverResponse = response.data.data
                this.RequestNumber = response.data.AeAccountCount
                this.OrdersData = response.data.data.data;
                this.Pages = this.serverResponse.last_page;
                this.HideLoadingInDiv();
         $("[data-toggle=tooltip]").tooltip();

            }).catch((error) => {
                this.HideLoadingInDiv();
            this.$vs.notify({
              title: "Failed to fetch data",
              text: "Reload the page or contact the technical department",
              color: "danger",
              fixed: true,
              icon: "warning",
            });
            });
        }
    },
    created(){
        this.getData();

    },
    mounted() {
        this.$root.$on('refresh_tabel', () => {
            this.refresh()
        })
        this.$vs.loading({
        container: "#card_load",
        scale: 0.6,
        color: "#f96a0c",
      });

    },

}

</script>