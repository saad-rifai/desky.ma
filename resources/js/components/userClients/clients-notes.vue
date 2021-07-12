<template>
  <div uk-grid dir="rtl">

    <div dir="rtl" class="uk-width-1-2@s uk-text-right">
      <div class="uk-margin uk-form-controls">
      <textarea  v-bind:class="{'uk-form-danger': total > max}" v-model="notes" @input="CountNotes"  class="uk-textarea uk-text-right"  rows="5"></textarea>
  <span class="label-input">الملاحظات</span>
      <small v-bind:class="{'uk-text-danger': total > max}">{{max}}-{{total}}</small>

      </div>
    </div>
        <div dir="rtl" class="uk-text-right uk-width-1-1@s">

    <button class="uk-button uk-button-primary " @click="SaveNotes">حفظ</button>
  </div>
  </div>
</template>
<script>
export default {
    props:['cid'],
    data(){
        return{
            notes:'',
         max: 1500,
            total: 0
        }
    },
    methods:{
              CountNotes: function(){
       this.total = this.notes.length;

      },
        SaveNotes: function(){
              $("#form-loading").css("display", "block");

        let data = new FormData();
        data.append('token',  $("meta[name=csrf-token]").attr("content"));
        data.append('CID', this.cid);
        data.append('notes', this.notes);
        axios.post('/api/v1/UpdateClientsNotes', data)
        .then((response) => {
                $("#form-loading").css("display", "none");

                UIkit.notification({
        message: response.data.success,
        status: "success",
        pos: "top-center",
        timeout: 5000,
      });
        }).catch((error) => {
                $("#form-loading").css("display", "none");


                          UIkit.notification({
        message: error.response.data.error,
        status: "danger",
        pos: "top-center",
        timeout: 5000,
      });
        })
        },
        getnotes: function(){
            let data = new FormData();
            data.append('CID', this.cid)
            axios.post('/api/v1/getClientsNotes', data).then((response) => {
                if(response.data[0].notes != null){
                this.notes = response.data[0].notes;

                }
            }).catch((error) =>{
                console.log(error.response);
            });
    }
    },
    created(){
        this.getnotes();
    }

}
</script>
