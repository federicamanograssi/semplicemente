<template>

<!-- Template:Codice HTML -->

    <div class="img_slider">

        <!-- <div id="root" class="container">
                <div class="slider-wrapper">
                    <div @click="prevImage" class="prev">
                        <i class="fas fa-angle-left"></i>
                    </div>
                    <div class="images">
                        <img v-bind:src="photos[counter]" alt="">
                    </div>
                    <div @click="nextImage" class="next">
                        <i class="fas fa-angle-right"></i>
                    </div>
                    <div class="nav">
                        <i :class="(index==counter) ? active : null" @click="pallinoClick(index)" class="fas fa-circle" v-for="(photo,index) in photos"></i>
                    </div>
                </div>
            </div> -->
            <i class="fas fa-user-nurse"></i>
    </div>

</template>

<!-- Utilizzo Vue -->

<!--<script>
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
        pallinoClick: function(index) {
            this.counter = index;
        },
        }
    }
</script>

<!-- Style della pagina. Scoped=>Valido solo per la pagina -->

<!-- Style della pagina. Scoped=>Valido solo per la pagina --><style scoped>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    display: flex;
    margin: 0 auto;
    width: 70%;
    height: 100vh;
}

.slider-wrapper {
    position: relative;
    margin: auto;
    width: 100%;
    height: 80%;
}

.slider-wrapper .images {
    height: 100%;
    text-align: center;
}

.slider-wrapper .images img {
    height: 100%;
}

.slider-wrapper .images img.active {
    display: inline-block;
}

.prev,
.next {
    position: absolute;
    color: #565a5c;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 40px;
    cursor: pointer;
}

.next {
    left: auto;
    right: 0;
}

.nav {
    position: absolute;
    left: 50%;
    bottom: 20px;
    transform: translateX(-50%);
    padding: 20px;
    border-radius: 999px;
    background: rgba(0, 0, 0, .7);
    color: white;
}

.nav>i {
    margin: 0 20px;
}

.nav>i.active {
    color: blue;
}

.button {
    background-color: lime;
    padding: 5px;
    border-radius: 20px;
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
}

.button a {
    text-decoration: none;
    color: white;
}

.fantasia img {
    z-index: 300000;
    display: none;
    height: 80vh;
    position: absolute;
    top: 50px;
    left: 0;
    width: 100vw;
}

.fantasia img#fantasiaID.active {
    display: block;
}

.slider-wrapper.none {
    display: none;
}

</style>
