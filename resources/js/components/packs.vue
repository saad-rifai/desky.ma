<template>
  <div>
    <div class="uk-text-center" style="" dir="rtl">

      <br />
      <br />
      <div class="uk-text-center">
        <div>
          <div class="swetch-btn uk-margin-bottom" >
            <button
              @click="PayTimeChange('m')"
              v-bind:class="{
                'uk-button-default': PackageDuration == 'y',
                'uk-button-primary': PackageDuration == 'm',
              }"
              class="uk-button btn-border-shadow"
            >
              شهرياََ
            </button>
            <button
              @click="PayTimeChange('y')"
              type="button"
              v-bind:class="{
                'uk-button-default': PackageDuration == 'm',
                'uk-button-primary': PackageDuration == 'y',
              }"
              class="uk-button btn-border-shadow"
            >
              سنوياََ
            </button>
          </div>
        </div>
      </div>
      <div
        class="uk-margin-large-left uk-margin-large-right uk-child-width-1-3@m uk-grid-small uk-grid-match uk-text-center"
        uk-grid
      >
        <div
          v-for="(item, index) in packInfos"
          :key="index"
          class="uk-text-center"
        >
          <div v-bind:class="{'most-pack': item.most == true, 'large-pack': item.large == true}" class="pack-pricing-bd">
            <div v-if="item.most == true" class="most-pb-label">
              الأكثر شيوعاََ
            </div>
            <div class="back-label">
              <h3 class="uk-card-title">{{ item.name }}</h3>
            </div>
            <table class="uk-table  uk-text-center">
              <tbody>
                <tr>
                  <td v-if="PackageDuration == 'm'" class="uk-text-center">
                    <h2 class="price-pack" dir="ltr">
                      {{
                        item.price.toLocaleString('en-US', {
                          style: 'decimal',
                          maximumFractionDigits: 2,
                        })
                      }}
                      Dhs
                      <small style="font-size: 19px;">/ شهر</small>
                      <br />
                      <span class="old-price-pack">
                        {{
                          (
                            item.price +
                            (item.price * item.save) / 100
                          ).toLocaleString('en-US', {
                            style: 'decimal',
                            maximumFractionDigits: 2,
                          })
                        }}
                        Dhs
                      </span>
                    </h2>
                    <h3 class="save-text">تخفيض %{{ item.save }}</h3>
                    <hr class="uk-divider-icon">

                  </td>
                  <td v-if="PackageDuration == 'y'" class="uk-text-center">
                    <h2 class="price-pack" dir="ltr">
                      {{
                        item.price_year.toLocaleString('en-US', {
                          style: 'decimal',
                          maximumFractionDigits: 2,
                        })
                      }}
                      Dhs
                      <small style="font-size: 19px;">/ سنة</small>
                      <br />
                      <span class="old-price-pack">
                        {{
                          (
                            item.price_year +
                            (item.price_year * item.save) / 100
                          ).toLocaleString('en-US', {
                            style: 'decimal',
                            maximumFractionDigits: 2,
                          })
                        }}
                        Dhs
                      </span>
                    </h2>
                    <h3 class="save-text">
                      تخفيض %{{ item.save }}
                      <br />
                      <small dir="rtl">
                        انت توفر مبلغ
                        {{
                          (
                            item.price * 12 -
                            item.price_year
                          ).toLocaleString('en-US', {
                            style: 'decimal',
                            maximumFractionDigits: 2,
                          })+' Dhs'
                        }}
                        باشتراكك في الباقة السنوية
                      </small>
                    </h3>
                    <hr class="uk-divider-icon">

                  </td>
                </tr>
                <tr v-for="(info, index) in item.content" :key="index">
                  <td>{{ info }}</td>
                </tr>

                <tr>
                  <td class="uk-text-center">
                      <hr class="uk-divider-icon">

                    <a href="javascript:void(0)" @click="AddToCart(index)">
                      <button
                        type="button"
                        class="uk-button uk-button-primary btn-call"
                      >
                        أطلب الأن
                      </button>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import json from '../../../database/data.json'

export default {
  data() {
    return {
      packInfos: json._2147845.packs,
      PackageDuration: 'm',
    }
  },
  methods: {
      AddToCart: function(e){
          window.location.href='/api/v1/user/AddToCart/2147845/'+e+'/'+$("meta[name=csrf-token]").attr("content")+'/'+this.PackageDuration
      },
    PayTimeChange: function (e) {
      if (e == 'm') {
          this.PackageDuration = 'm';
      }else{
          this.PackageDuration ='y';
      }
    },
  },
}
</script>
