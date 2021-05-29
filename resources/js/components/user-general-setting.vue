<template>
  <div>
    <div dir="rtl" class="uk-grid-small uk-text-right" uk-grid>
      <div class="uk-width-1-2@s">
        <input class="uk-input" v-model="fname" type="text" />
        <div class="uk-text-danger" v-if="errors.errors.fname">
          {{ errors.get("fname") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <input class="uk-input" v-model="lname" type="text" value="" />
        <div class="uk-text-danger" v-if="errors.errors.lname">
          {{ errors.get("lname") }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <input class="uk-input" v-model="email" type="text" disabled />
      </div>
      <div class="uk-width-1-2@s">
        <input class="uk-input" v-model="phonenumb" type="text" value="" />
        <div class="uk-text-danger" v-if="errors.errors.phonenumb">
          {{ errors.get("phonenumb") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <input class="uk-input" v-model="company" type="text" />
        <div class="uk-text-danger" v-if="errors.errors.company">
          {{ errors.get("company") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <select class="uk-select" id="form-stacked-select" v-model="country">
              <optgroup label="المغرب">
                <option value="MA"> المغرب </option>
              </optgroup>
          <option
            v-for="(countrie, index) in countries"
            :key="index"
            v-bind:value="countrie.code"
            :selected="countrie.code == user.country"
          >
            {{ countrie.name }}
          </option>
        </select>
        <div class="uk-text-danger" v-if="errors.errors.country">
          {{ errors.get("country") }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <input class="uk-input" type="text" v-model="city" value="" />
        <div class="uk-text-danger" v-if="errors.errors.city">
          {{ errors.get("city") }}
        </div>
      </div>

      <div class="uk-width-1-1@s uk-text-right">
        <button @click="submitform" class="uk-button uk-button-primary">حفظ</button>
      </div>
    </div>
  </div>
</template>
<script>
import json from "../../../database/data.json";
class Errors {
  constructor() {
    this.errors = {};
  }
  get(filed) {
    if (this.errors[filed]) {
      return this.errors[filed][0];
    }
  }
  record(errors) {
    this.errors = errors.errors;
  }
}
export default {
  props: ["user"],
  data() {
    return {
      errors: new Errors(),

      countries: json.countries,
      fname: this.user.fname,
      lname: this.user.lname,
      email: this.user.email,
      company: this.user.company,
      phonenumb: this.user.phonenumb,
      city: this.user.city,
      country: this.user.country,
      apiKey: "fgfg160151f2g2fdgfgfdg",
      url_api: "http://" + window.location.hostname,
      response: ""
    };
  },
  methods:{
    submitform: function(){
       $("#form-loading").css("display", "block");
         //   $("#form-loading").css("display", "block");
            let data = new FormData();
            data.append("fname", this.fname);
            data.append("lname", this.lname);
            data.append("company", this.company);
            data.append("phonenumb", this.phonenumb);
            data.append("city", this.city);
            data.append("country", this.country);


        axios.post(this.url_api + "/api/user/update", data).then((response) => {
           $("#form-loading").css("display", "none");
          UIkit.notification({
            message: "تم حفظ البيانات",
            status: "success",
            pos: "top-center",
            timeout: 5000,
          });
            
      }).catch((error) => {
                  $("#form-loading").css("display", "none");

          this.errors.record(error.response.data);
          UIkit.notification({
            message:
              "يرجى التحقق من المدخلات <span uk-icon='icon: warning'></span>",
            status: "danger",
            pos: "top-center",
            timeout: 5000,
          });
        })
        .finally(() => {
          $("#form-loading").css("display", "none");
        });

    }
  }
};
</script>