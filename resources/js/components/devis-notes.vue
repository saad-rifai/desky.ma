<template>
  <div uk-grid dir="rtl">

    <div dir="rtl" class="uk-width-1-2@s uk-text-right">
      <label for="">الملاحظات</label>
      <div class="uk-margin">
      <textarea  v-bind:class="{'uk-form-danger': total > max}" v-model="notes" @input="CountNotes"  class="uk-textarea uk-text-right"  rows="5"></textarea>
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
    props:["oid"],
    data(){
        return{
            notes: "",
            max: 1500,
            total: 0
        }
    },
    methods:{
      CountNotes: function(){
       this.total = this.notes.length;
       
      },
      getNotes: function(){
        axios.get('/api/v1/getOfDocument/notes?OID='+this.oid+'&d=d&t='+$("meta[name=csrf-token]").attr("content"))
        .then((response) => {
          this.notes = response.data[0].notes;
        }).catch((error) => {
                UIkit.notification({
        message: error,
        status: "danger",
        pos: "top-center",
        timeout: 5000,
      });
      this.getNotes();
      //window.location.reload();
        });
      },
      SaveNotes: function(){
              $("#form-loading").css("display", "block");

        let data = new FormData();
        data.append('token',  $("meta[name=csrf-token]").attr("content"));
        data.append('d', 'd');
        data.append('oid', this.oid);
        data.append('notes', this.notes);
        axios.post('/api/v1/UpdateOfDocument/notes', data)
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
      }
    },
     created(){
       setTimeout(() =>{
       this.getNotes();
    
       }, 1000);
     }
}
</script>
