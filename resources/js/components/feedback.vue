<template>
    <div>
        <div id="feedback" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Headline 1</h2>
        </div>
        <div class="uk-modal-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <a href="#modal-group-2" class="uk-button uk-button-primary" uk-toggle>Next</a>
        </div>
    </div>
</div>
        <div href="#feedback" uk-toggle class="feedback-border">
            <div class="feedback-icon"> <span uk-icon="icon:star; ratio: 1.6"></span> </div>
            <div class="feed-back-text">اخبرنا رأيك بالمنصة</div>
        </div>

    </div>
</template>
<script>
export default {

}
</script>
