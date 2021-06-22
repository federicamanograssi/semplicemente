<template>
        <section class="map-section">
            
            <div class="chalet-map" id="chalet-map">
            </div>  
        
            <div class="chalet-map__button-container">

                <!-- Close Button  -->
                <div class="chalet-map__button chalet-map__button--close"
                    @click="toggleMap()"
                    :class="mapIsShown ? null : 'hidden'">
                    <i class="fas fa-times"></i>
                </div>
                
                <!-- Open Button -->
                <div class="chalet-map__button chalet-map__button--open"
                    @click="toggleMap()"
                    :class="mapIsShown ? 'hidden' : null">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
        
        </section>
</template>

<script>
    export default {

        mounted() {
            this.mymap = L.map('chalet-map').setView([this.baseLat, this.baseLon], 11);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/light-v10',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWF1cml6aW8tZ3Jhc3NvIiwiYSI6ImNrbjBhcHYyOTBhd3AydmxyeHE2dm9pMWQifQ.W2n4tefi_FBnxWHAbz_yxA'
        }).addTo(this.mymap);
        },
        data() {            
            return {                
                mymap : null ,
                mapIsShown : true
            }
        },
        props : ['baseLat' , 'baseLon'] ,    
        watch: { 
            baseLat: {                
                handler: function(val, oldVal) {
                    console.log("La latitudine è passata da " + oldVal + ' a ' + val);
                this.updateCoordinates();
                },
            } ,
            baseLon: {                
                handler: function(val, oldVal) {
                this.updateCoordinates();
                },
            } 
        },
        methods : {
            toggleMap() {
                this.$emit('mapToggled');
                
                let mapClasses = document.getElementById("chalet-map").classList;
                
                this.mapIsShown ? mapClasses.add('hidden') : mapClasses.remove('hidden');
                
                this.mymap.invalidateSize();    // Previene deformazione della mappa alla sua ricomparsa

                this.mapIsShown ? this.mapIsShown = false : this.mapIsShown = true;
            } ,
            updateCoordinates(){
                console.log("Aggiorno Centro Mappa");
                console.log(this.baseLat + ' ' + this.baseLon);
                
                this.mymap.panTo([ this.baseLat , this.baseLon , {animate: true,} ]);
            }
        }
    }

</script>

<style scoped lang="scss">

    @import "../../sass/variables";

    .chalet-map {
        position: absolute;
        z-index: 2;
        right: $spacing-standard;
        top: $height-section-medium;
        width: calc(50% - 2 * #{$spacing-standard});
        height: calc(100vh - 2 * #{$height-section-medium} - #{$spacing-more});

        @include responsive(tablet) {
            // position: relative;
            top: auto;
            right: auto;
            height: $height-section-big;
            width: 100%;
        }

        &__button-container{
            display: none;
            @include responsive(tablet) {
                display: block;
            }
        }
        &__button {
            position: fixed;
            bottom: $height-section-big;            
            right: $spacing-more;                        
            height: $height-section-medium;
            line-height: $height-section-medium;
            width: $height-section-medium;
            transform: translateY(50%);
            z-index: 555;            
            background-color: $white;
            text-align: center;
            border-radius: 50%;
            font-size: 3rem;
            border: 1px solid $color-primary-light;
            transition: background $animation-time-standard , opacity $animation-time-very-slow;
            color: $color-primary-light;
            @include shadow-standard;
            cursor: pointer;
        }

    }
</style>
