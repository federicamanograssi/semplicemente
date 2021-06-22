<template>

<!-- Template:Codice HTML -->

    <div class="img_slider">

        <div id="root" class="container">
                <div class="slider-wrapper">
                    <div @click="prevImage" class="prev">
                        <i class="fas fa-angle-left"></i>
                    </div>
                    <div class="images">
                        <img v-bind:src="photos[counter]" class="img_slider" alt="">
                        <div class="nav">
                            <div :class="(index==counter) ? active : null" class="img_preview" @click="circleClick(index)" v-for="(photo,index) in photos">
                                <img v-bind:src="photo" alt="">
                            </div>
                        
                            <!-- <i :class="(index==counter) ? active : null" @click="circleClick(index)" class="fas fa-circle" v-for="(photo,index) in photos"></i> -->
                        
                        
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
                photos: [
                        "https://images.pexels.com/photos/371633/pexels-photo-371633.jpeg?cs=srgb&dl=clouds-country-daylight-371633.jpg&fm=jpg",
                        "https://static.photocdn.pt/images/articles/2017/04/28/iStock-646511634.jpg",
                        "https://cdn.mos.cms.futurecdn.net/FUE7XiFApEqWZQ85wYcAfM.jpg",
                        "https://static.photocdn.pt/images/articles/2017/04/28/iStock-546424192.jpg"
                ],
            }
        },
        methods : {
            prevImage: function() {
            this.counter--;
            if (this.counter < 0) {
                this.counter = (this.photos.length - 1);
                console.log(this.counter);
            }
        },
        nextImage: function() {
            this.counter++;
            if (this.counter > this.photos.length - 1) {
                this.counter = 0;
                console.log(this.counter);
            }
        },
        circleClick: function(index) {
            this.counter = index;
        },
        }
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
            .images {
                height: 100%;
                text-align: center;
                img.active {
                display: inline-block;
                }
                .img_slider {
                    width: 100%;
                    height: 50rem;
                    border-radius: $border-radius-standard;
                    object-fit: cover;
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

    .nav {
            @include responsive(phone) {
                display: none;
            }
        padding: $spacing-tiny;
        border-radius: $border-radius-standard;
        background: rgba(0, 0, 0, .7);
        cursor: pointer;
    }

    .img_preview {
        padding:$spacing-small;
        display: inline-block;
        width: 10rem;
        height: 10rem;
        img{
            width: 100%;
            border-radius: $border-radius-standard;
            object-fit: cover;
            height:100%;
        }
    }
    .img_preview.active{
        img{
            border:3px solid $white;
        }
    }
    .slider-wrapper.none {
    display: none;
    }
}


</style>
