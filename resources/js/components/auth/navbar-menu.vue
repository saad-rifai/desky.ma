<template>
  <div>
    <b-dropdown
      size="lg"
      variant="link"
      toggle-class="icon-dropdown"
      no-caret
    >
      <template #button-content>
        <div
          class="user-info-box-article-avatar dropdown-toggle"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            v-if="user.avatar != '' && user.avatar != null"
            :src="'/'+user.avatar"
            :alt="user.username"
          />
          <img src="/img/icons/avatar.png" :alt="user.username" />
        </div>
      </template>
      <div>
        <ul
          class="menulinks-nav"
          style="left: 0; top: 60px; display: block !important"
        >
          <li>
            <a class="dropdown-item item-w-icn" href="/"
              ><span class="bg-icn"><i class="fas fa-tachometer-alt"></i></span>
              لوحة التحكم</a
            >
          </li>
                    <li>
            <a
              class="dropdown-item item-w-icn"
              :href="'/@'+user.username"
              ><span class="bg-icn"><i class="fas fa-at"></i></span> حسابي</a
            >
          </li>
                    <li>
            <a class="dropdown-item item-w-icn" href="/myorders"
              ><span class="bg-icn"><i class="fas fa-folder"></i></span>
              طلباتي</a
            >
          </li>
                              <li>
            <a class="dropdown-item item-w-icn" href="/myoffers"
              ><span class="bg-icn"><i class="fas fa-ticket-alt"></i></span>
              عروضي</a
            >
          </li>

          <li >
            <a
              class="dropdown-item item-w-icn"
              href="/account/settings"
              ><span class="bg-icn"><i class="fas fa-cog"></i></span> اعدادات</a
            >
          </li>
          <li>
            <a class="dropdown-item item-w-icn" href="/logout"
              ><span class="bg-icn"><i class="fas fa-sign-out-alt"></i></span>
              تسجيل الخروج</a
            >
          </li>
        </ul>
      </div>
    </b-dropdown>
  </div>
</template>
<script>
export default {
    props:['user'],
}
</script>