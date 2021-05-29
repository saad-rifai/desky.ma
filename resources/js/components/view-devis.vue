<template>
  <div>
    <div id="loading" class="form-loading"></div>

    <div class="uk-card uk-card-default uk-card-body">
      <div class="uk-text-right" dir="rtl">
        <button
          @click="CreerDevis"
          type="button"
          class="uk-button uk-button-primary uk-margin-top"
        >
          حفظ
        </button>

        <a href="#form-demande-branding" uk-toggle=""
          ><button
            type="button"
            class="uk-button uk-margin-top uk-button-danger btn-call"
          >
            الغاء
          </button></a
        >
      </div>
      <br />
      <div class="uk-width-1-1@m">
        <h2 class="uk-cart-title uk-text-left">N° {{ this.invid }}</h2>
        <h3 class="uk-cart-title uk-text-right">معلومات عن العميل</h3>
        <hr />
      </div>
      <div>
        <div class="form-formulaire uk-text-right" dir="rtl" uk-grid>
          <div class="uk-width-1-2@s">
            <label for="">الاسم الكامل للعميل <span class="red">*</span></label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_name"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_name">
              {{ errors.errors.c_name[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">رقم الهاتف </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_phone"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_phone">
              {{ errors.errors.c_phone[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for="">البريد الالكتروني <span class="red">*</span> </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                name="fname"
                placeholder=""
                v-model="c_email"
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_email">
              {{ errors.errors.c_email[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for=""> رقم التعريفي الموحد (ICE): </label>
            <div class="uk-form-controls">
              <input
                class="uk-input"
                type="text"
                v-model="c_ice"
                placeholder=""
                value=""
                required
              />
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_ice">
              {{ errors.errors.c_ice[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label for=""> نوع العميل </label>
            <div class="uk-form-controls">
              <select v-model="c_type" class="uk-select">
                <option value=""></option>
                <option value="1">شخص عادي</option>
                <option value="2">شركة</option>
              </select>
            </div>
            <div class="uk-text-danger" v-if="errors.errors.c_type">
              {{ errors.errors.c_type[0] }}
            </div>
          </div>
        </div>
      </div>

      <br />
      <div class="uk-width-1-1@m">
        <h3 class="uk-cart-title uk-text-right">معلومات عن الطلب</h3>
        <hr />
      </div>
      <div>
        <div id="fileds">
          <div
            class="form-formulaire uk-text-right"
            v-for="(devi, index) in devis" :key="index"
            dir="rtl"
            uk-grid
          >
            <div class="uk-width-1-1">
              <h1 class="uk-card-title uk-text-right">
                العنصر {{ index + 1 }}
              </h1>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for="">الخدمة أو المنتج (بالفرنسية)</label>
                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.article"
                  type="text"
                  name="fname"
                  placeholder=""
                  value=""
                  required
                />
              </div>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for="">السعر</label>

                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.price"
                  min="0"
                  type="number"
                  name="fname"
                  placeholder=""
                  value="0"
                  required
                />
              </div>
            </div>
            <div class="uk-width-1-5@s">
              <div class="uk-form-controls">
                <label for="">الكمية</label>
                <input
                  class="uk-input"
                  @change="changedata"
                  v-model="devi.quantity"
                  id="qty"
                  type="number"
                  min="1"
                  name="fname"
                  value="1"
                />
              </div>
            </div>
            <div class="uk-width-1-4@s">
              <div class="uk-form-controls">
                <label for=""> .</label>
                <input
                  type="button"
                  @click="deleteUser(index)"
                  class="uk-input uk-button uk-button-danger"
                  value="حذف"
                />
              </div>
            </div>

            <div class="uk-width-1-1@s">
              <hr />
            </div>
          </div>
        </div>

        <div class="uk-width-1-1@s">
          <input
            type="button"
            id="addmor"
            @click="addFind"
            class="uk-input uk-button uk-button-primary uk-margin-top"
            value="المزيد"
          />
        </div>
        <div class="uk-width-1-1@s">
          <br />
          <hr />
        </div>

        <div class="uk-margin uk-grid-small" uk-grid>
          <h2 class="uk-card-title uk-text-right uk-width-1-1@s">
            الدفع والأداء
          </h2>
          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right uk-margin" dir="rtl"
              >شروط الدفع :</label
            >
            <select class="uk-select" v-model="p_condition">
              <option value="">بدون</option>
              <option value="1">التسبيق 10% والباقي عند الاستلام</option>
              <option value="2">التسبيق 15% والباقي عند الاستلام</option>
              <option value="3">التسبيق 20% والباقي عند الاستلام</option>
              <option value="4">التسبيق 25% والباقي عند الاستلام</option>
              <option value="5">التسبيق 30% والباقي عند الاستلام</option>
              <option value="6">التسبيق 35% والباقي عند الاستلام</option>
              <option value="7">التسبيق 40% والباقي عند الاستلام</option>
              <option value="8">التسبيق 45% والباقي عند الاستلام</option>
              <option value="9">التسبيق 50% والباقي عند الاستلام</option>
              <option value="10">التسبيق 60% والباقي عند الاستلام</option>
              <option value="11">التسبيق 70% والباقي عند الاستلام</option>
              <option value="12">التسبيق 100% والباقي عند الاستلام</option>
            </select>
            <div class="uk-text-danger" v-if="errors.errors.p_condition">
              {{ errors.errors.p_condition[0] }}
            </div>
          </div>
          <div class="uk-width-1-2@s" dir="rtl">
            <label class="uk-text-right uk-margin" dir="rtl"
              >وسيلة الدفع :</label
            >
            <select v-model="p_method" class="uk-select">
              <option value="">-- تحديد --</option>
              <option value="1">الدفع نقداََ</option>
              <option value="2">تحويل بنكي</option>
              <option value="3">الدفع بواسطة شيك</option>
            </select>
            <div class="uk-text-danger" v-if="errors.errors.p_method">
              {{ errors.errors.p_method[0] }}
            </div>
          </div>
        </div>
        <div class="uk-width-1-3@s uk-text-left">
          <div class="uk-text-right content-total">
            <h3 class="text-f-bloder">
              المجموع:
              {{
                this.subtotal.toLocaleString("en-US", {
                  style: "currency",
                  currency: "MAD",
                })
              }}
            </h3>
            <hr />
            <h3 class="text-f-bloder">
              الضريبة(TVA):
              {{
                this.tva.toLocaleString("en-US", {
                  style: "currency",
                  currency: "MAD",
                })
              }}
            </h3>
            <hr />
            <div class="total-border">
              <h3 class="text-f-bolder-w">
                المجموع الكلي:
                {{
                  this.total.toLocaleString("en-US", {
                    style: "currency",
                    currency: "MAD",
                  })
                }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
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
      c_name: "",
      c_phone: "",
      c_email: "",
      c_ice: "",
      c_type: "",
      p_condition: "",
      p_method: "",
      pdfdevis: "",
      devis: [],
      subtotal: 0,
      total: 0,
      tva: 0,
      prtva: 1,
      avprice: "",
      invid: "",
      url_api: window.location.pathname,
      planinfos: [],
    };
  },
  methods: {
    notificationchek: function () {
      if (this.errors.errors.items) {
        UIkit.notification({
          message: this.errors.errors.items[0],
          status: "danger",
        });
      }
    },
    CreerDevis: function () {
      if (this.devis.length == 0) {
        this.devis.push({ article: "", price: 0, quantity: 1 });
      }
      this.loadpoints();
    },
    addInvoice: function () {
      this.invid = "0000" + Math.floor(Math.random() * 10000000 + 1);
    },
    addFind: function () {
      if (this.devis.length == 6) {
        UIkit.notification({
          message: "الحد الأفصى 6 عناصر <span uk-icon='icon: warning'></span>",
          status: "danger",
        });
      } else {
        this.devis.push({ article: "", price: 0, quantity: 1 });
      }
    },
    loadpoints() {
      let data = new FormData();

      data.append("c_name", this.c_name);
      data.append("c_phone", this.c_phone);
      data.append("c_email", this.c_email);
      data.append("c_ice", this.c_ice);
      data.append("c_type", this.c_type);
      data.append("p_condition", this.p_condition);
      data.append("p_method", this.p_method);
      data.append("items", JSON.stringify(this.devis));
      data.append("OID", this.invid);
      axios
        .post("../api/creer_devis", data)
        .then((response) => {
          this.planinfos = response.data;
          if (response.status == 220) {
            this.pdfdevis = true;
          }
        })
        .catch((error) => {
          this.errors.record(error.response.data);
          this.notificationchek();
        });
    },
    changedata: function () {
      var articels = this.devis.length;
      this.subtotal = 0;
      for (var i = 0; i < articels; i++) {
        var pricearticle = parseFloat(0 + this.devis[i].price);
        var qty = parseFloat(0 + this.devis[i].quantity);
        this.subtotal += pricearticle * qty;
      }
      this.tva = (this.subtotal * this.prtva) / 100;
      this.total = this.subtotal + this.tva;
    },

    deleteUser: function (index) {
      console.log(index);
      console.log(this.finds);
      this.devis.splice(index, 1);
      if (index === 0) this.addFind();
      this.changedata();
    },
  },
  mounted() {
    //this.loadpoints();

    this.addInvoice();
  },
};
</script>
