<template>
    <section class="apartments-list"
    :class="mapIsShown ? null : 'apartments-list--map-hidden'">

        <div v-if="(apartments.length==0) && foundApt!==undefined" class="no-results">
            <i class="no-results__icon fas fa-exclamation-circle"></i>
            <h3 class="no-results__title">
                Nessuno Chalet Trovato
            </h3>

            <p v-if="foundApt!=0">Nessun risultato disponibile, ma {{foundApt}} chalet sono stati nascosti in base ai filtri selezionati. 
                    <span class="no-results__reset"
                        @click="$emit('resetFilters')">
                        Clicca qui</span> per azzerare i filtri e visualizzarli!
            </p>

            <p v-else>Nessun risultato disponibile per questa ricerca; prova a scegliere un'altra località!</p>
                
            <p>Oppure, lasciati ispirare dai nostri chalet in evidenza presenti in ogni zona d'Italia!</p>

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
                },
            // sponsoredApt: {                
            //     handler: function() {
            //         // this.setOutputArray();
            //         console.log("ciao")
            //         }
            //     }
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
                const self = this;
                axios
                    .get('http://127.0.0.1:8000/api/getSponsoredApt' , {
                        params: {
                            nOfItems    :   6
                            }
                        })
                    .then((response)=>{
                        self.sponsoredApt = response.data.results;
                        self.setOutputArray();

                });
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
        top: $spacing-small;
        right: $spacing-standard;
        font-size: 5rem;
        color: $orange;
        opacity: .75;
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