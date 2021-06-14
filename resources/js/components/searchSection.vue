<template>
    <section class="advanced-search">

        <advanced-search-form>
            <!-- Search Form Component -->
        </advanced-search-form>


        <div class="advanced-search__results">

            <!-- Apartment Cards List  -->

            <apartment-card 
                 v-for="(apartment , index) in apartments" 
                :key="index" 
                :name="apartment.name" 
                :imgSrc="apartment.imgSrc"
                :rating="apartment.rating">

                <!-- Apartment Card Component -->

            </apartment-card>

        </div>


        <div class="advanced-search__map">
            
            <!-- 
                La mappa è provvisoriamente 
                integrata da Google Maps 
            -->

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54471.2440560787!2d12.052418201662949!3d46.66978139530556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47783435d247033f%3A0xdd3c30437b92e42b!2s32043%20Cortina%20d&#39;Ampezzo%20BL!5e1!3m2!1sit!2sit!4v1623660828144!5m2!1sit!2sit" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

    </section>
</template>

<script>
    export default {
        mounted() {
            
        } ,
        data() {
            return {
                'apartments' : [
                    {
                        'name' : 'Mountain Chalet Milly' ,
                        'imgSrc' : 'img/sampleApartments/01/94264560.jpg' ,
                        'rating' : '4'
                    } ,

                    {
                        'name' : 'La Baita Case Suite' ,
                        'imgSrc' : 'img/sampleApartments/02/148581352.jpg' ,
                        'rating' : '4.5'
                    } ,

                    {
                        'name' : 'Loft Caterina' ,
                        'imgSrc' : 'img/sampleApartments/03/192462101.jpg' ,
                        'rating' : '5'
                    } ,

                                        {
                        'name' : 'La Casa di Alice' ,
                        'imgSrc' : 'img/sampleApartments/04/280745444.jpg' ,
                        'rating' : '4'
                    } ,

                                        {
                        'name' : 'Ledro Mountain Chalet' ,
                        'imgSrc' : 'img/sampleApartments/05/294869423.jpg' ,
                        'rating' : '5'
                    } ,

                ]
            }
        }
    }



</script>

<style scoped lang="scss">

@import "../../sass/variables";

.advanced-search {

    background-color: $bg-transparent;
    max-width: $width-inner-content;
    margin: 0 auto;

    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    height: calc(100vh - #{$height-section-medium} ) ;

    &__results {
        flex: 0 0 50%;
        height: calc(100vh - 2 * #{$height-section-medium});
        padding: $spacing-standard;
        overflow-x: auto;  
        overflow-y: scroll;

        @include responsive(tablet) {
            flex: 0 0 100%;
            padding-bottom: $height-section-big + $spacing-more;
        }
    } 

    &__map {
        flex: 0 0 50%;
        padding: 10px;  // Temporaneo: evita overflow della mappa
        height: calc(100vh - 2 * #{$height-section-medium});

        @include responsive(tablet) {
            flex: 0 0 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: $height-section-big;
            background-color: $white;   //temp
            max-width: 100%;
        }
    }

}

</style>