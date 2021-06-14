<template>
    <div class="single-apartment">

        <div class="single-apartment__image-container">
            <img :src="imgSrc" :alt="name"
                class="single-apartment__image">
        </div>

        <div class="single-apartment__data">
            <h2 class="single-apartment__name">{{name}}</h2>
            <p class="single-apartment__description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos delectus hic ab itaque eius ipsum.
            </p>
            <button class="btn btn--primary">Dettagli</button>
            <span class="single-apartment__rating"><i class="fas fa-star"></i>{{rating}}</span>
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
            rating : String,
        }
    }
</script>

<style lang="scss">
@import "../../sass/variables";

    .single-apartment {
        height: $height-section-big;
        width: 100%;
        border-radius: $border-radius-standard;
        overflow:hidden;
        display: flex;
        flex-direction: row;
        @include standard-shadow;

        &:not(:last-child){
            margin-bottom: $spacing-more;
        }

        &__image-container {
            height: 100%;
            flex: 0 0 50%;
        }

        &__image {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        &__data {
            flex: 0 0 50%;
            padding: $spacing-small;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        &__description {
            font-size: 85%;
        }

        &__name {
            color: $color-secondary;
        }

        &__rating {
            color: $color-secondary;
            i {
                margin-right: .5rem;            
                font-size: 90%;
            }
        }
    }
</style>