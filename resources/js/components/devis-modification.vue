<template>
  <div uk-grid>
    <div dir="rtl" class="uk-width-1-2@s">
      <label for="">الحالة</label>
      <select v-model="statusSelect" name="" id="" class="uk-select">
          <option value="">-- --</option>
        <option v-for="(devi_statu, index) in devis_status" :key="index" :selected="index == status" :value="index">{{devi_statu}}</option>
      </select>
    </div>
    <div dir="rtl" class="uk-width-1-2@s">
      <label for="">الملاحظات</label>
      <textarea v-model="notes" class="uk-textarea" rows="5"></textarea>
    </div>
        <div dir="rtl" class="uk-text-right uk-width-1-1@s">

    <button class="uk-button uk-button-primary ">حفظ</button>
  </div>
  </div>
</template>
<script>
import json from "../../../database/data.json";

export default {
    props:["oid", "status"],
    data(){
        return{
            devis_status: json.devis_status,
            notes: "",
            statusSelect: this.status,
        }
    }
}
</script>
