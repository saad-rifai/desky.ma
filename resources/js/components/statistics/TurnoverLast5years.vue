<template>
    <div style="position:relative">
                        <div v-if="NotAllowdFunction" @click="NotAllowdFunction_not" class="disabled-feature uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">
                                    باقتك لاتسمح لك باستعمال الميزة

                        </div>
                <div id="TabelLastFiveLoad" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div>
<div  class="uk-overflow-auto">
              <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>السنة</th>
                                    <th>عدد المبيعات</th>
                                    <th>رقم المعاملات (TTC)</th>
                                    <th>الضرائب ({{infos.tva}})</th>
                                    <th>الربح الصافي (HT)</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(item, index) in infos[0]" :key="index">
                                    <td>{{index}}</td>
                                    <td>{{item.ventes}}</td>
                                    <td>{{item.Chiffre_Daffire.toLocaleString('en-US', {
                                        style: 'currency',
                                        currency: 'MAD',
                                        })
                                        }}</td>
                                        <td>{{item.tva.toLocaleString('en-US', {
                                        style: 'currency',
                                        currency: 'MAD',
                                        })
                                        }}</td>
                                        <td>{{item.revenu_ht.toLocaleString('en-US', {
                                        style: 'currency',
                                        currency: 'MAD',
                                        })
                                        }}</td>
                                </tr>
                            </tbody>
                        </table>
</div>

</div>
</template>
<script>
export default {
    data(){
        return{
            infos: [],
              NotAllowdFunction: false

        }
    },
    methods:{
        GetData: function(){
         $('#TabelLastFiveLoad').css('display', 'flex')
         axios.post('/api/v1/Statistiques/TurnoverLast5years/json/02d1e4z631w4ze895df47e').then((response) => {
             this.infos = response.data;
             $('#TabelLastFiveLoad').css('display', 'none')

         }).catch((error) => {
              if(error.response.status == 402){
              this.NotAllowdFunction = true;
             $('#TabelLastFiveLoad').css('display', 'none')

          }else{
          this.GetData()

          }
         });


        },
        NotAllowdFunction_not: function () {
      UIkit.notification({
        message:
          "باقتك لاتسمح لك باستعمال هذه الميزة يمكنك مشاهدة <a href='/tarifs?NotAllowdNotification'>الباقات</a> ",
        status: 'danger',
        pos: 'top-center',
        timeout: 5000,
      })
    },
    },
    created(){
        this.GetData();
    }
}
</script>
