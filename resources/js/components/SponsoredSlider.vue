<template>

    <div class="sponsored_slider">

        <div class="container">
                <div class="slider-wrapper">
                    
                    <!-- <div @click="prevImage" class="prev">
                        <i class="fas fa-angle-left"></i>
                    </div> -->
                    
                    <!-- <div class="pages">
                        <p>{{page}}/2</p>
                    </div> -->

                    <div class="cards">
                        <a 
                        v-for="(apt, index) in apartments" 
                        :key="index"
                        :href="'/single/'+apt['id']"
                        class="card">

                            <div class="card__img">
                                <img :src="'../storage/'+apt['cover_img']" class="img_slider" alt="">
                            </div>

                            <div class="card__data">
                                <!-- <span><i class="fas fa-star"></i>{{rating[counter+index]}}</span> -->
                                <h4 class="card__title">{{apt['name']}}</h4> 
                                <span class="card__rating">{{apt['rating']}} <i class="fas fa-star"></i></span>
                            
                            </div>
                        </a><!-- Card End -->
                    </div>


                    <!-- <div @click="nextImage" class="next">
                        <i class="fas fa-angle-right"></i>
                    </div> -->
                    
                </div>

        </div>
    </div>

</template>

<!-- Utilizzo Vue -->

<script>
        export default {
        mounted() {
            self = this;    // alias
                axios
                    .get('http://127.0.0.1:8000/api/getSponsoredApt' , {
                        params: {
                            nOfItems    :   6
                            }
                        })
                    .then((response)=>{
                        self.apartments = response.data.results;    // Salva l'array degli apt ottenuti nella variabile apartments                        
                });

        } 
        ,
        data() {
            return {
                active: "active",
                counter: 0,
                page:1,
                apartments:null
            }
        },
        methods : {
            prevImage: function() {
            this.counter=0;
            if(this.page==2){
                this.page--;
            }
            
            console.log(this.page);

        },
        nextImage: function() {
            this.counter=4;
            if(this.page==1){
                this.page++;
            }
            
            console.log(this.page);
            }
        },
        circleClick: function(index) {
            this.counter = index;
        },
    }
    
</script>

<!-- Style della pagina. Scoped=>Valido solo per la pagina -->

<style scoped lang="scss">

@import "../../sass/variables";


.container {
  
            @include responsive(phone) {
                display: none;
            }
        
    max-width:$width-inner-content;
    margin: 0 auto;
    .slider-wrapper {
        position: relative;
        margin: auto;
        width: 100%;
            .pages{
                float: right;
            }
            .cards {
                width: 100%;
                display: flex;
                @include responsive(phone) {
                    display: block;
                }
                .card{
                    cursor: pointer;
                    width: 25%;
                    height:$height-section-big;
                    padding:$spacing-standard;
                    position: relative;

                    @include responsive(phone) {
                        width: 100%;
                        height: $height-section-big;
                        margin-bottom:$spacing-more;
                    }

                    &:link ,
                    &:visited,
                    &:active,
                    &:hover {
                        color: $color-primary;
                        text-decoration: none;
                    }

                    &__data {
                        position: absolute;
                        height: $height-section-medium;
                        bottom: 0;
                        width: calc(100% - 2 * #{$spacing-standard});
                        left: $spacing-standard;
                        background-color: $white;
                    }

                    &__img{
                        height: 100%;
                        width: 100%;
                        @include shadow-standard;

                        img{
                            border-radius: $border-radius-standard;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }                    
                    }
                    
                }
            }
    }
    .prev,
    .next {
        position: absolute;
        color: #565a5c;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 4rem;
        cursor: pointer;
    }

    .next {
        left: auto;
        right: 0;
    }
}


</style>
