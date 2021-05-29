<template>
  <form id="formcontact" method="POST" @submit.prevent="SubmitDemande($data)">
    <div class="uk-grid-small uk-text-right" uk-grid>
      <div class="uk-width-1-2@s">
        <input
          class="uk-input"
          v-model="fullname"
          v-bind:class="{ 'uk-form-danger': errors.errors.fullname }"
          id="fullname"
          name="fullname"
          type="text"
          placeholder="الاسم الكامل"
        />
        <div class="uk-text-danger" v-if="errors.errors.fullname">
          {{ errors.errors.fullname[0] }}
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <input
          class="uk-input"
          v-model="phonenumb"
          id="phonenumb"
          neme="phonenumb"
          type="text"
          v-bind:class="{ 'uk-form-danger': errors.errors.phonenumb }"
          placeholder="رقم الهاتف"
        />
        <div class="uk-text-danger" v-if="errors.errors.phonenumb">
          {{ errors.errors.phonenumb[0] }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <input
          class="uk-input"
          v-model="email"
          id="email"
          type="text"
          name="email"
          v-bind:class="{ 'uk-form-danger': errors.errors.email }"
          placeholder="البريد الالكتروني"
        />
        <div class="uk-text-danger" v-if="errors.errors.email">
          {{ errors.errors.email[0] }}
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <input
          class="uk-input"
          v-model="subject"
          id="subject"
          name="subject"
          type="text"
          placeholder="الموضوع"
          v-bind:class="{ 'uk-form-danger': errors.errors.subject }"
        />
        <div class="uk-text-danger" v-if="errors.errors.subject">
          {{ errors.errors.subject[0] }}
        </div>
      </div>

      <div class="uk-width-1-1@s">
        <textarea
          class="uk-textarea"
          v-model="message"
          id="message"
          name="message"
          rows="5"
          placeholder="الرسالة"
          v-bind:class="{ 'uk-form-danger': errors.errors.message }"
        ></textarea>
        <div class="uk-text-danger" v-if="errors.errors.message">
          {{ errors.errors.message[0] }}
        </div>
      </div>

      <div class="uk-width-1-1@s"></div>
      <div class="uk-width-1-1@s">
        <button type="submit" id="formbtn" class="uk-button uk-button-primary">
          ارسال
        </button>
      </div>
    </div>
  </form>
</template>
<script>
var n = 0;
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
  data() {
    return {
      errors: new Errors(),
      fullname: "",
      phonenumb: "",
      email: "",
      subject: "",
      message: "",
      file: "",
    };
  },
  methods: {
    SubmitDemande() {
      document.getElementById("formbtn").disabled = true;
      let data = new FormData();
      data.append("fullname", this.fullname);
      data.append("phonenumb", this.phonenumb);
      data.append("email", this.email);
      data.append("subject", this.subject);
      data.append("message", this.message);

      /* if (document.getElementById("idimage").files[0]) {
        data.append("idimage", document.getElementById("idimage").files[0]);
      }*/

      //document.getElementById('devis').value=[];
      //this.devis = [];
      this.errors.errors = false;
      axios
        .post("./contact/store", data)
        .then(function () {
          /*UIkit.notification({
            message: "تم ارسال طلبك بنجاح",
            pos: "top-right",
            status: "success",
          });*/
          window.location = "/successmessage?hr=ar&oid";
        })
        .catch((error) => this.errors.record(error.response.data))
        .finally(() => {
          document.getElementById("formbtn").disabled = false;
        });

      /*axios.post("./../api/demandes_etudes/", data).then(response => this.form = response.data);*/
    },
  },
};
</script>