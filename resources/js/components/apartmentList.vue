<template>
    <section class="apartments-list"
    :class="mapIsShown ? null : 'apartments-list--map-hidden'">

        <div v-if="(apartments.length==0) && foundApt!==undefined" class="no-results">
            <i class="no-results__icon fas fa-exclamation-circle"></i>
            <h3 class="no-results__title">
                Nessuno Chalet Trovato
            </h3>

            <p>Non abbiamo trovato nessun risultato per questa ricerca.</p>

            <p v-if="foundApt!=0">{{foundApt}} Chalet sono stati però nascosti in base ai filtri selezionati. 
                <span class="no-results__reset"
                @click="$emit('resetFilters')">Clicca qui</span> 
                per ripristinare tutti i filtri e visualizzarli!
            </p>

            <p v-else>Prova a cercare un'altra località, oppure lasciati ispirare dai nostri chalet in evidenza in ogni zona d'Italia!</p>

        </div>

        <apartment-card 
            v-for="(apartment , index) in outputApt"
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

            this.loadSponsored();
            this.setOutputArray();
        },
        props : [
            'apartments' ,  // Array di appartamenti da mostrare
            'mapIsShown' ,  // Booleano che indica se la mappa è visibile
            'foundApt' ,      // Numero di appartamenti esistenti per la località, compresi quelli esclusi dal filtraggio
            ],
        watch: {    
            apartments: {                
                handler: function() {
                    this.setOutputArray();
                    }
                }
            },
        data() {
            return {
                outputApt    : null,    // Array di appartamenti che sarà effettivamente renderizzato
                sponsoredApt : [],      // Array di apt Sponsorizzati
                showSponsored: false,   // Mostrare apt Sponsorizzati (in assenza di quelli relativi alla ricerca?)
            }
        },
        methods : {
            //  Metodo che stabilisce se visualizzare apt Sponsorizzati in caso di assenza risultati

            setOutputArray(){
                if(this.apartments.length > 0) this.outputApt = this.apartments;
                else this.outputApt = this.sponsoredApt;
            },
            loadSponsored(){
                this.sponsoredApt = [
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
    height: $height-section-big;
    width: 100%;
    background-color: $white;
    margin-bottom: $spacing-more;
    border-radius: $border-radius-standard;
    padding: $spacing-standard;
    border: 1px dashed $orange;
    position: relative;

    &__title {
        color: $orange;
        margin-bottom: $spacing-standard;
    }

    &__icon {
        position: absolute;
        top: $spacing-standard;
        right: $spacing-standard;
        font-size: 5rem;
        color: $orange;
        opacity: .75;
    }

    &__text {

    }

    &__reset {
        color: $color-primary;
        text-decoration: underline;
        cursor: pointer;
    }

    p {
        margin-bottom: $spacing-standard;
    }
}

</style>