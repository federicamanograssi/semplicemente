<template>
    <div class="single-apartment">

        <div class="single-apartment__image-container">
            <img :src="imgSrc" :alt="name"
                class="single-apartment__image">
        </div>

        <div class="single-apartment__data">
            <h2 class="single-apartment__name">{{name}}</h2>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            
        },
        props : {
            name : String,
            imgSrc : String,
        }
    }
</script>

<style lang="scss">
@import "../../sass/variables";

    .single-apartment {
        height: $height-section-big;
        width: 100%;
        margin-bottom: $spacing-more;
        border-radius: 5px;
        overflow:hidden;

        &__image-container {
            height: 100%;
            width: 50%;
        }

        &__image {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    }
</style>