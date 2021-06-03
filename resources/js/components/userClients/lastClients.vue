<template>
  <div style="position: relative;">

        <div id="lastclientsload" class=" uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle div-load"><span uk-spinner="ratio: 1.5"></span></div>

    <table dir="rtl" class="uk-table uk-table-divider uk-text-right">
      <thead>
        <tr>
          <th></th>
          <th>اسم العميل</th>
          <th>تاريخ الاضافة</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in infos" :key="index">
          <td>
            <div class="user-image-box"><div class="symbole-image">{{item.c_name.charAt(0).toUpperCase()}}</div></div>
          </td>

          <td>{{item.c_name}}</td>
          <td>{{item.created_at.split('T')[0]}}</td>
          <td>
   <button @click="go(item.CID)" class="act-btn-radio">
              <i class="fas fa-eye"></i>
            </button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
</template>
<script>

export default {

  props: ['limit', 'uid'],
  data() {
    return {
      infos: [],
    }
  },
  methods: {
      go: function(e){
          window.location.href="/clients/"+e+'/'+this.uid;
      },
    getInfos: function () {
$('#lastclientsload').css('display', 'flex')

      let data = new FormData()
      data.append('limit', this.limit)
      axios
        .post('/api/v1/user/LastClientsList', data)
        .then((response) => {
         $('#lastclientsload').css('display', 'none')

          this.infos = response.data
        })
        .catch((error) => {
           this.getInfos();

        })
    },
  },
  created() {

    this.getInfos();
  },
}
</script>
