<template>

<!-- Template:Codice HTML -->

    <div class="sponsored_slider">

        <div id="root" class="container">
                <div class="slider-wrapper">
                    <div @click="prevImage" class="prev">
                        <i class="fas fa-angle-left"></i>
                    </div>
                    
                    <div class="pages">
                        <p>{{page}}/2</p>
                    </div>

                    <div class="cards">
                        <div v-for="(photo, index) in photos" v-if="index < 4" class="card">
                            <div class="card-img">
                                <img v-bind:src="photos[counter+index]" class="img_slider" alt="">
                            </div>
                            <div class="card-rating">
                                <span><i class="fas fa-star"></i>{{rating[counter+index]}}</span>
                            </div>
                            <div class="card-title">
                                 <p><a href="#">{{title[counter+index]}}</a></p>
                            </div>
   
                        </div>

                    </div>


                    <div @click="nextImage" class="next">
                        <i class="fas fa-angle-right"></i>
                    </div>
                    
                </div>

        </div>
    </div>

</template>

<!-- Utilizzo Vue -->

<script>
        export default {
        mounted() {
            
        } 
        ,
        data() {
            return {
                active: "active",
                counter: 0,
                page:1,
                photos: [
                        "https://st.hzcdn.com/simgs/pictures/facades-de-maisons/chalet-montagne-impuls-architectures-img~1fa14b10048ae580_4-9910-1-424b58c.jpg",
                        "https://www.borgomaira.it/wp-content/uploads/2019/06/img-chalet-home-new3.jpg",
                        "https://lh3.googleusercontent.com/proxy/VYlaBx3WgYi5dqhCgOtEMloUJ2I98eoQHg8nph6KnSwKVzPeROkWvFymycnkobixJ0bNhxSAcaKZyXN5L214-VWDOEqMUUgQ5R9IYvQJUA",
                        "https://www.immobilien-consulting.at/wp-content/uploads/2021/02/IMG-20210402-WA0033.jpg",
                        "https://www.catellanismith.com/app/uploads/2019/12/img-amb-chalet-3.jpg",
                        "https://st.hzcdn.com/simgs/pictures/landscapes/chalet-architecture-ontario-canada-techo-bloc-img~b8c1b3b5022dd587_4-3335-1-6e31288.jpg",
                        "https://www.altoadige-tirolo.com/media/medium/img,alpwell-chalet2_35466786.jpg",
                        "https://www.lagederbau.it/cache/img-immobilien-chalet-st-ulrich-photo-2020-10-27-15-01-49-2-1200.jpg"

                ],
                title:[
                    "Chalet Sponsorizzato 1",
                    "Chalet Sponsorizzato 2",
                    "Chalet Sponsorizzato 3",
                    "Chalet Sponsorizzato 4",
                    "Chalet Sponsorizzato 5",
                    "Chalet Sponsorizzato 6",
                    "Chalet Sponsorizzato 7",
                    "Chalet Sponsorizzato 8"
                ],
                rating:[
                    5,
                    1,
                    2,
                    3,
                    4,
                    5,
                    5,
                    5,
                ]
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
                .card{
                    width: 25%;
                    height:$height-section-big;
                    padding:$spacing-standard;
                    .card-img{
                        height: 100%;
                        width: 100%;
                        @include shadow-standard;
                    }
                    img{
                        border-radius: $border-radius-standard;
                        width: 100%;
                        height: 100%;
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
