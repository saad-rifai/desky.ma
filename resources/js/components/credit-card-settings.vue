<template>
  <div>
    <!-- This is the modal -->
    <div id="add-card" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-text-right">
        <h3 class="uk-modal-title">اضافة بطاقة بنكية</h3>
        <hr />
        <div
          dir="rtl"
          class="uk-grid-small uk-text-right uk-width-1-1@m"
          uk-grid
        >
          <div class="uk-width-1-1@s">
            <div class="uk-margin">
              <label for="">اسم صاحب البطاقة</label>
              <br />
              <div class="uk-inline uk-width-1-1">
                <span
                  class="uk-form-icon uk-form-icon-flip"
                  uk-icon="icon: user"
                ></span>

                <input
                  class="uk-input uk-width-1-1"
                  placeholder="Ex: Said Mesrar"
                />
              </div>
            </div>
          </div>
          <div class="uk-width-1-1@s">
            <div class="uk-margin">
              <label for="">رقم البطاقة</label>
              <br />
              <div class="uk-inline uk-width-1-1">
                <span
                  class="uk-form-icon uk-form-icon-flip"
                  uk-icon="icon: credit-card "
                ></span>

                <input class="uk-input" placeholder="Ex: 4000000000000002" />
              </div>
            </div>
          </div>
          <div class="uk-width-1-3@s">
            <label for="">رقم السري (CVV/CVC)</label>
            <input class="uk-input" placeholder="" />
          </div>
          <div class="uk-width-1-3@s">
            <label for="">تاريخ انتهاء الصلاحية</label>
            <div class="uk-inline uk-flex">
              <input
                type="text"
                class="uk-input"
                data-paylib="expmonth"
                placeholder="MM"
                size="2"
              />
              <input
                type="text"
                class="uk-input"
                data-paylib="expyear"
                placeholder="YYYY"
                size="4"
              />
            </div>
          </div>
          <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-primary">حفظ</button>
            <button class="uk-button uk-button-default uk-modal-close">
              الغاء
            </button>
          </div>
          <div class="uk-width-1-1@s">
            <div class="uk-alert-success" uk-alert>
              <i class="fas fa-lock"></i>
              ادفع بأمان، اتصالك مشفر، يتم تشفير حميع البيانات
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- This is the modal -->
    <div id="delet-card" uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-text-right">
        <h3 class="uk-modal-title">حذف البطاقة البنكية</h3>
        <hr />
        <div
          dir="rtl"
          class="uk-grid-small uk-text-right uk-width-1-1@m"
          uk-grid
        >
          <p>هل انت متأكد بأنك تود حذف البطاقة البنكية ؟</p>
          <div class="uk-width-1-1@s">
            <button class="uk-button uk-button-danger">حذف</button>
            <button class="uk-button uk-button-default uk-modal-close">
              الغاء
            </button>
          </div>
        </div>
      </div>
    </div>

    <div dir="rtl" class="uk-grid-small" uk-grid>
      <label for="">
        الدفع التلقائي:
        <span
          uk-icon="icon:info"
          uk-tooltip="بتفعيلك الدفع التلقائي يتم تجديد اشتراكك تلقائياََ "
        ></span>
        <label
          style="vertical-align: middle; margin-right: 10px;"
          class="switch"
        >
          <input
            @change="autopay"
            v-model="autopay"
            type="checkbox"
            id="ch_auto_pay"
            value="true"
          />
          <span class="slider round"></span>
        </label>
      </label>
    </div>
    <br />
    <div class="uk-text-right">
      <label for="">البطاقات البنكية</label>
    </div>
    <br />
    <div>
      <div
        dir="rtl"
        class="uk-grid-small uk-child-width-1-2@s uk-text-right"
        uk-grid
      >
        <div v-for="(info, index) in infos" :key="index">
          <div class="uk-grid-small credit_card_border" uk-grid>
            <div class="uk-width-1-1@s">
              <label for="">
                الاسم على البطاقة: {{ info.card_holder_name }}
              </label>
            </div>
            <div class="uk-width-1-1@s">
              <label for="" dir="rtl">
                رقم البطاقة:
                <span dir="ltr">{{ info.card_number }}</span>
              </label>
            </div>
            <div class="uk-width-1-2@s">
              <label for="">
                رقم السري (CVV/CVC):
                <span dir="ltr">###</span>
              </label>
            </div>
            <div class="uk-width-1-2@s">
              <label for="">
                تاريخ انتهاء الصلاحية:
                <span dir="ltr">
                  {{ info.card_end_year }}/{{ info.card_end_month }}
                </span>
              </label>
            </div>
            <div class="uk-width-1-1@s">
              <a
                href="#delet-card"
                uk-toggle="target: #delet-card"
                class="uk-text-danger"
              >
                <span uk-icon="icon:trash"></span>
                حذف
              </a>
            </div>
          </div>
        </div>
        <div class="">
          <div class="credit_card_border">
            <!-- Place any content, like an image, here -->

            <div class="uk-position-center">
              <a
                href="#add-card"
                uk-toggle="target: #add-card"
                class="uk-link uk-text-primary"
              >
                <span uk-icon="plus"></span>
                اضافة بطاقة
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      infos: [],
      autopay: false,
    }
  },
  methods: {
    getdata: function () {
      axios
        .post('../../api/user/credit_card')
        .then((Response) => {
          this.infos = Response.data[0]
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
          UIkit.notification({
            message: 'حصل خطأ ما يرجى اعادة تحميل الصفحة',
            status: 'danger',
          })
          location.reload()
        })
    },
    autopay: function () {
      let data = new FormData()
      data.append('autopay', this.autopay)
      axios
        .post('../../api/user/autopay', data)
        .then((Response) => {
          this.infos = Response.data[0]
          $('#form-loading').css('display', 'none')
        })
        .catch((error) => {
                    $('#form-loading').css('display', 'none')

          UIkit.notification({
            message: 'حصل خطأ ما يرجى اعادة تحميل الصفحة',
            status: 'danger',
          })
          location.reload()
        }).finaly(() => {
                    $('#form-loading').css('display', 'none')

        });
    },
  },
  mounted() {
    this.getdata()
  },
}
</script>
