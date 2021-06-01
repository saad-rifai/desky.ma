<template>
  <div>



    <div class="uk-flex uk-flex-wrap uk-flex-wrap-around btn-grids uk-padding-small" dir="rtl">
      <div>
        <button class="uk-dropdown-menu-orange" type="button" dir="rtl">
           <span uk-icon="icon: more-vertical"></span>
        </button>
        <div uk-dropdown="mode: click; pos: bottom-right">
          <ul class="uk-nav uk-dropdown-nav">
            <li class="uk-active">
              <a :href="'/clients/'+cid+'/'+uid+'/edit'"><span uk-icon="icon: file-edit"></span> تعديل</a>
            </li>

          </ul>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
import json from "../../../database/data.json";

export default {
  props: ["cid", "uid"],
  data() {
    return {
      status: json.devis_status,
      infos: "",
    };
  },
  methods: {



  }

};
</script>
