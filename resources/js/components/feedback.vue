<template>
  <div>
    <div v-if="CheckFeedBackStatus == 0">
      <div id="feedback" uk-modal>
        <div class="uk-modal-dialog uk-text-right" dir="rtl">
          <button
            class="uk-modal-close-default"
            type="button"
            uk-close
          ></button>
          <div class="uk-modal-header">
            <h2 class="uk-modal-title">رأيك يهمنا</h2>
          </div>
          <div class="uk-modal-body">
            <p>
              أخبرنا رأيك بالمنصة, مالذي كنت تتمنى لو تجده في المنصة, مالمشاكل
              التي تواجهك , اخبرنا اقترحاتك من أجل تطوير المنصة
            </p>
            <div class="uk-margin uk-text-right" dir="rtl">
              <div style="position: relative;">
                <label for="">ماهو تقييمك الحالي للمنصة ؟</label>
                <br />
                <div class="rate uk-text-right" dir="rtl">
                  <input
                    v-model="rating_count"
                    type="radio"
                    id="star5"
                    name="rate"
                    value="5"
                  />
                  <label for="star5" title="5">5 stars</label>
                  <input
                    v-model="rating_count"
                    type="radio"
                    id="star4"
                    name="rate"
                    value="4"
                  />
                  <label for="star4" title="4">4 stars</label>
                  <input
                    v-model="rating_count"
                    type="radio"
                    id="star3"
                    name="rate"
                    value="3"
                  />
                  <label for="star3" title="3">3 stars</label>
                  <input
                    v-model="rating_count"
                    type="radio"
                    id="star2"
                    name="rate"
                    value="2"
                  />
                  <label for="star2" title="2">2 stars</label>
                  <input
                    v-model="rating_count"
                    type="radio"
                    id="star1"
                    name="rate"
                    value="1"
                  />
                  <label for="star1" title="1">1 star</label>
                </div>
                <br />
                <br />
                <div class="uk-text-danger" v-if="errors.errors.rating">
                  {{ errors.get('rating') }}
                </div>
              </div>
              <div class="uk-margin uk-text-right" dir="rtl">
                <label for="">تعليقك</label>
                <br />
                <textarea
                  v-model="comment"
                  class="uk-textarea"
                  rows="5"
                  placeholder=""
                ></textarea>
                <br />
                <div class="uk-text-danger" v-if="errors.errors.feedback">
                  {{ errors.get('feedback') }}
                </div>
              </div>
            </div>
          </div>
          <div class="uk-modal-footer uk-text-right">
            <button @click="SendFeedBack" id="feedback-sbm" class="uk-button uk-button-primary">
              ارسال
            </button>

            <button
              class="uk-button uk-button-default uk-modal-close"
              type="button"
            >
              الغاء
            </button>
          </div>
        </div>
      </div>
      <div href="#feedback" uk-toggle class="feedback-border">
        <div class="feedback-icon">
          <span uk-icon="icon:star; ratio: 1.6"></span>
        </div>
        <div class="feed-back-text">اخبرنا رأيك بالمنصة</div>
      </div>
    </div>
  </div>
</template>
<script>
class Errors {
  constructor() {
    this.errors = {}
  }
  get(filed) {
    if (this.errors[filed]) {
      return this.errors[filed][0]
    }
  }
  record(errors) {
    this.errors = errors.errors
  }
}
export default {
  data() {
    return {
      errors: new Errors(),
      rating_count: 0,
      CheckFeedBackStatus: 1,
      comment: '',
    }
  },
  methods: {
    rating: function (r) {
      this.rating_count = r
      for (var i = 1; i <= r; i++) {
        $('.rating-starts span i .c' + i).css('color', '#ffc800')
      }
    },
    SendFeedBack: function () {
      $('#feedback-sbm').attr('disabled', 'disabled')
      $('#form-loading').css('display', 'block')

      let data = new FormData()
      data.append('rating', parseInt(this.rating_count))
      data.append('feedback', this.comment)
      axios
        .post('/api/v1/SendFeedBack', data)
        .then((response) => {
          $('#form-loading').css('display', 'none')
          UIkit.modal('#feedback').hide()
          UIkit.notification({
            message: 'تم ارسال تعليقك !',
            status: 'success',
            pos: 'top-center',
            timeout: 5000,
          })
          this.CheckFeedBackStatus = 1;
        })
        .catch((error) => {
          $('#form-loading').css('display', 'none')
          $('#feedback-sbm').removeAttr('disabled')
          this.errors.record(error.response.data)
          if(error.response.status == 500){
          UIkit.notification({
            message: 'حدث خطأ ما يرجى اعادة المحاولة !',
            status: 'danger',
            pos: 'top-center',
            timeout: 5000,
          })
          }else{
            UIkit.notification({
            message: 'يرجى التحقق من المدخلات !',
            status: 'danger',
            pos: 'top-center',
            timeout: 5000,
          })
          }

        })
    },
    CheckFeedBack: function () {
      axios.post('/api/v1/CheckFeedBack').then((response) => {
        if (response.data.status == 0) {
          this.CheckFeedBackStatus = 0
        } else {
          this.CheckFeedBackStatus = 1
        }
      })
    },
  },
  created() {
    this.CheckFeedBack()
  },
}
</script>
