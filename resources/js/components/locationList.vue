<template>
    <section class="locations-list">

        <a   href="#" v-for="(location,index) in this.locations" :key="index" class="single-location">
            
            <div class="single-location__img-container">
                <img class="single-location__img" :src="location.imgSrc" :alt="location.name">
            </div>

            <div class="single-location__bottom-bar">
                <h3 class="single-location__name">{{location.name}}</h3>
            </div>

        </a>
    </section>
</template>

<script>
    export default {
        mounted() {
            
        },
        data() {
            return {
                'locations' : [
                    {
                     'name' : 'Cortina d\'Ampezzo' ,
                     'imgSrc': 'images/cortina.webp'
                    } ,                    
                               
                    {
                        'name' : 'Etna' ,
                        'imgSrc': 'images/etna.jpg'
                    } ,
                    
                    
                    {
                        'name' : 'Saluzzo' ,
                        'imgSrc': 'images/saluzzo.jpg'
                    } ,
                    
                    {
                        'name' : 'Courmayeur' ,
                        'imgSrc': 'images/courmayeur.jpg'
                    } ,
                    
                    {
                        'name' : 'Cervinia' ,
                        'imgSrc': 'images/cervinia.jpg'
                    } ,                    
                    
                    {
                        'name' : 'Madonna di Campiglio' ,
                        'imgSrc': 'images/madonna-di-campiglio.jpg'
                    } ,
                    
                    {
                        'name' : 'San Candido' ,
                        'imgSrc': 'images/san-candido.jpg'
                    } ,
                    
                    {
                        'name' : 'Livigno',
                        'imgSrc': 'images/livigno.jpg'
                    }
                ]
            }
        }
    }
</script>

<style lang="scss">

@import "../../sass/variables";

    .locations-list {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;

    }

    .single-location {
        flex: 0 0 calc(  (100% - ( ( #{$spacing-more} )  * 3 ) ) / 4) ;

        @include responsive(desktop) {
            flex: 0 0 calc(  (100% - ( #{$spacing-more} ) * 2 ) / 3) ;            
        }

        @include responsive(tablet) {
            flex: 0 0 calc(  (100% - ( #{$spacing-more} ) ) / 2) ;            
        }

        @include responsive(tablet) {
            flex: 0 0 100% ;            
        }

        height: $height-section-big;
        margin-bottom: $spacing-standard;
        border-radius: $border-radius-standard;
        overflow: hidden;
        text-align: center;
        transition: all $animation-time-slow;


        &:link ,
        &:visited ,
        &:active ,
        &:hover {
            color: inherit;
            text-decoration: none;            
        }

        &:hover {
            @include shadow-standard;

            .single-location__name {
                transform: translateY(0);
                color: $color-primary-light;
            }

            .single-location__img {
                filter: grayscale(0);
                border-radius: 0;
            }

        }

        &__img-container {
            height: $height-section-big - $height-section-small;            
            overflow: hidden;
        }

        &__img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            object-position: center;
            filter: grayscale(80%) brightness(90%);
            transition: all $animation-time-slow;
            border-radius: $border-radius-standard;

        }

        &__name {
            color: $white;
            position: relative;
            z-index: 3;

            // transform: translateY( calc(-1 * #{$height-section-small} - 50%));

            transform: translateY( calc( -1 * ( #{$height-section-big / 2}  ) ) );

            width: 100%;
            margin: 0;
            transition: all $animation-time-slow;
            line-height: $height-section-small;
            font-size: 2.2rem;
            letter-spacing: 1px;
        }

        &__bottom-bar {
            height: $height-section-small;
        }
    }

</style>