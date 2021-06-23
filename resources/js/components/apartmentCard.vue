<template>
    <div class="single-apartment">

        <div class="single-apartment__image-container">
            <img :src="imgSrc" :alt="name"
                class="single-apartment__image">
        </div>

        <div class="single-apartment__data">
            <h3 class="single-apartment__name heading--primary">{{name}}</h3>
            
            <p class="single-apartment__description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>

            <button class="btn btn--secondary">Dettagli</button>


            <div class="single-apartment__services">
                
                <span class="single-apartment__rating"><i class="fas fa-star"></i>{{rating}}</span>
                <span class="single-apartment__rating"><i class="fas fa-user"></i>5</span>
                <span class="single-apartment__rating"><i class="fas fa-restroom"></i>2</span>
                <span class="single-apartment__rating"><strong>€49</strong> / notte</span>

            </div>
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
            rating : Number,
            id:Number,
            is_sponsored:Boolean
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
        background-color: $white;

        @include shadow-standard;

        &:hover {

            @include shadow-enhanced;

            .single-apartment__image {
                transform: scale(1.1);
            }
        }

        &:not(:last-child){
            margin-bottom: $spacing-more;
        }

        &__image-container {
            height: 100%;
            flex: 0 0 50%;
            overflow: hidden;
        }

        &__image {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform $animation-time-very-slow;
        }

        &__name {
            margin-bottom: 0;
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

        &__services {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            width: 100%;

            i {
                margin-right: .5rem;            
                font-size: 90%;
                opacity: .75;
            }
        }

    }
</style>