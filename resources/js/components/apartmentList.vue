<template>
    <section class="apartments-list"
    :class="mapIsShown ? null : 'apartments-list--map-hidden'">

        <div v-if="apartments.length==0" class="no-results">
            <h3 class="no-results__title">
                Nessuno Chalet Trovato
            </h3>

            <p v-if="foundApt!=0">{{foundApt}} Chalet sono stati nascosti in base ai filtri selezionati. 
                <span 
                @click="$emit('resetFilters')"
                style="color:black;cursor:pointer;">Clicca qui</span> 
                per resettare tutti i filtri.
            </p>

        </div>

        <apartment-card 
                v-for="(apartment , index) in apartments" 
            :key="index" 
            :name="apartment.name" 
            :imgSrc="'storage/' + apartment.cover_img"
            :rating="apartment.rating"
            :id="apartment.id"
            :price="apartment.price"
            :beds="apartment.beds"
            :isSponsored="apartment.isSponsored"
            :dist="apartment.dist"
            >

            <!-- Apartment Card Component -->

        </apartment-card>

    </section>
</template>

<script>
    export default {
        mounted() {
            if(this.apartments){
                //
            }
            else this.apartments = this.defaultApartments;
        },
        props : ['apartments' , 'mapIsShown' , 'foundApt'],
        data() {
            return {
                'defaultApartments' : [
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

<style lang="scss">

@import "../../sass/variables";

    .apartments-list {

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
        align-content: flex-start;

        &--full-width {
            .single-apartment {
                flex: 0 0 100%;
            }
        }

        &--responsive {
            .single-apartment {
                flex: 0 0 calc((100% - #{$spacing-standard}) / 2);
                
                @include responsive(tablet) {
                    flex: 0 0 100% ;            
                }
            }
        }
    }

    .no-results {
    background-color: red;
    height: $height-section-big;
    width: 100%;
    margin-bottom: $spacing-more;
    border-radius: $border-radius-standard;
    padding: $spacing-standard;

    &__title {

    }

    &__text {

    }

    &__actions {

    }
}

</style>