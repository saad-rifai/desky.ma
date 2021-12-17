<template>
    <div class="position-relative">
        <button hidden id="btn_UserMenuClick"></button>

        <b-dropdown
            size="lg"
            variant="link"
            toggle-class="icon-dropdown"
            no-caret
        >
            <template #button-content class="btn-not-c">
               <i class="fas fa-envelope"></i>
            </template>
            <div class="menu-dropdown-lg position-relative" align="right">
                <div>
                    <div class="no-data-message text-center mt-4 mb-4 col-6">
                         لاتوجد رسائل حتى الأن
                    </div>
                </div>
            </div>
        </b-dropdown>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: []
        };
    }
};
</script>
