<template>
        
        <form action="" class="form">
            
            <div class="form__group">
                
                <!-- Location -->

                <div class="form__field form__field--location"
                    :class="isFiltersBoxOpen ? 'form__field--full' : 'form__field--half'">
                    <label class="form__label form__label--left">Località</label>
                    <input  v-model="baseLocation" 
                            @change="updateQuery()" key="" 
                            class="form__input" type="text">
                </div>

                <!-- Search Button -->

                <div v-if="!isFiltersBoxOpen"
                    class="form__field">       
                    <button                     
                    type="button"
                    class="btn btn--primary-light"><span class="hide-on-tablet">Cerca </span><i class="fas fa-search"></i></button>
                </div>


                <!-- Filters Button -->

                <div v-if="!isFiltersBoxOpen"                     
                    class="form__field">
                    <button @click="toggleFilterBox()" type="button" class="btn btn--primary-light"><span class="hide-on-tablet">Vedi Più </span><span class="hide-on-mobile">Filtri </span><i class="show-on-mobile fas fa-cog"></i></button>
                </div>
                    
            </div>

            <!-- Form Filters: hidden by default -->

            <div class="form__filters"
                :class="isFiltersBoxOpen ? null : 'hidden'">
                
                
                <!-- Distance -->

                <div class="form__group">

                    <div class="form__field form__field--distance form__field--full">

                        <label for="search-form-distance" class="form__label">Distanza</label>

                        <div class="form__slider__container">
                            <input v-model="maxDistance" @change="updateQuery()" type="range" min="20" max="60" value="20" step="20" class="form__slider" id="search-form-distance">
                        </div>

                        <span class="form__slider__value">{{maxDistance}} Km</span>

                    </div>
                </div>

                <div class="form__group">

                    <!-- Rooms -->

                    <div class="form__field form__field--half form__field--rooms">
                        <label for="search-form-rooms" class="form__label form__label--left">Camere <span class="hide-on-mobile">da letto </span>(min)</label>
                        <input @change="updateQuery()" v-model="minRooms" id="search-form-rooms" class="form__input" type="number">
                    </div>

                    <!-- Posti letto -->

                    <div class="form__field form__field--half form__field--beds">
                        <label for="search-form-beds" class="form__label form__label--left"><span class="hide-on-mobile">Numero </span>Posti letto (min)</label>
                        <input id="search-form-beds" class="form__input" type="number">
                    </div>
                </div>

                <div class="form__group">                    

                    <!-- Price -->

                    <div class="form__field form__field--half form__field--price">
                        <label class="form__label" for="search-form-price">Prezzo (max)</label>
                        <div class="form__slider__container">
                            <input @change="updateQuery()" v-model="maxPrice" type="range" min="20" max="500" value="50" class="form__slider" id="search-form-price">
                        </div>
                        <span class="form__slider__value">{{maxPrice}} <i class="fas fa-euro-sign"></i></span>
                    </div>

                    <!-- Rating -->

                    <div class="form__field form__field--half form__field--rating">
                        <label class="form__label" for="search-form-rating">Valutazione (min)</label>
                        <div class="form__slider__container">
                            <input @change="updateQuery()" v-model="minRating" type="range" min="1" max="5" value="3" class="form__slider" id="search-form-rating">
                        </div>
                        <span class="form__slider__value">{{minRating}} <i class="fas fa-star"></i></span>
                    </div>

                </div>

                <div class="form__group">

                    <!-- Additional Services -->

                    <div class="form__field form__field--big">

                        <span class="form__label">Servizi Aggiuntivi:</span>
                        
                            <ul class="checkbox__container services-list">

                                <li
                                    v-for="(service , index) in servicesList"
                                    :key="index"
                                    class="services-list__item">

                                    <label 
                                        :for="'service-'+index"
                                        class="checkbox__label">

                                        {{service.service_name}}

                                        <input 
                                            :id="'service-'+index"
                                            type="checkbox"
                                            class="checkbox__field"
                                            :value="service.service_name"
                                            v-model="selectedServices"
                                            checked="checked"
                                            @change="updateQuery()">

                                        <span class="checkbox__checkmark"></span>

                                    </label>
                                </li>
                            </ul>                 
                    </div>
                </div>
                

                <div class="form__group">

                    <div class="form__field form__field--full">
                        
                        <button
                        @click="toggleFilterBox()"
                        type="button" 
                        class="btn btn--primary-light">
                            Fatto                             
                        </button>
                        
                    </div>
                </div>

            </div><!-- Form Filters -->

        </form>

</template>

<script>
import AdvancedSearchPageVue from './AdvancedSearchPage.vue';
    export default {
        mounted(){
            // richiamo il metodo che riempie la lista servizi
            this.getServicesList();
        },
        data() {
            return {

                // Proprietà relative alla query dell'utente

                baseLocation   : this.query.baseLocation ,
                maxDistance     : this.query.maxDistance ,
                minRating       : this.query.minRating ,
                maxPrice        : this.query.maxPrice ,
                minRooms        : this.query.minRooms ,
                guests       : this.query.guests,
                selectedServices : [] ,

                // Proprietà relative al funzionamento del form

                isFiltersBoxOpen : false ,
                servicesList : []
            }
        },
        props: ['query'] ,
        methods : {
            toggleFilterBox() {
                // Gestione del box con i filtri avanzati
                this.isFiltersBoxOpen == true ? this.isFiltersBoxOpen = false : this.isFiltersBoxOpen = true;
            } ,
            updateQuery(){
                
                // Metodo richiamato ogni volta che 
                // un qualsiasi campo viene modificato
                // Quali siano le operazioni da eseguire in base alle modifiche
                // lo stabilirà il parent component (AdvancedSearchPage)

                let newQuery = {
                    baseLocation        : this.baseLocation,
                    maxDistance         : Number(this.maxDistance),
                    guests              : Number(this.guests),
                    minRating           : Number(this.minRating),
                    minRooms            : Number(this.minRooms),
                    maxPrice            : Number(this.maxPrice),
                    selectedServices    : this.selectedServices ,
                    baseLat             : this.query.baseLat ,
                    baseLon             : this.query.baseLon
                }

                console.log("Occhio, Sto mandando una nuova query");
                this.$emit('newQuery' , newQuery);  // Evento raccolto dal componente genitore (AdvancedSearchPage)

            } ,
            getServicesList(){

                axios
                .get('http://127.0.0.1:8000/api/services')
                .then((servicesList)=>{
                    // console.log(servicesList.data.results);
                    this.servicesList= servicesList.data.results
                })
        }       
    }       
}
</script>

<style scoped lang="scss">

@import "../../sass/variables";

    .form {
        position: relative;
        flex: 0 0 100%;

        // Additional Filters Box
        
        &__filters {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 5;

            .form__group {
                padding-top: 0;
                @include responsive(tablet) {                                    
                    flex-wrap: wrap;
                }
            }

            .form__field {
                &--half {
                    @include responsive(tablet) {                    
                        flex: 0 0 100%;
                    }
                }

                &:not(:last-child){
                    @include responsive(tablet) {                    
                        margin-bottom: $spacing-tiny;
                    }
                }
            }
        }

        // Form Group

        &__group {
            display: flex;
            background-color: $color-primary-light;
            padding: $spacing-tiny;

        }

        // Form Field

        &__field {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: $white;
            flex: 1 1 auto;
            text-align: center;
            padding: $spacing-small;
            height: calc(#{$height-section-medium} - 2 * #{$spacing-tiny});
            
            > * {
                // flex-grow: 1;
                flex: 1 1 50%;
            }

            &:not(:last-child){
                margin-right: $spacing-tiny;
            }

            // Full Width Fields

            &--full {
                padding: $spacing-standard;
                flex: 0 0 100%;
            }

            // 50% Width Fields

            &--half {
                padding: $spacing-standard;

                flex: 0 0 calc((100% - #{$spacing-tiny}) / 2);                
            }

            // Vertical Group (i.e. checkboxes container)

            &--big {
                height: auto;
                flex-direction: column;
                padding-top: $spacing-more;
            }

            // Special Style for location field

            &--location {
                flex-shrink: 1;
                .form__input {
                    flex: 1 0 50%;
                }
                .form__label {
                    flex: 0 1 50%;
                }
            }
        }

        &__input {
            // Fixes flex-shrink
            width: 0;
        }

        // Form Labels

        &__label {
            color: $color-primary-light;
            letter-spacing: 1px;

            // Label with input field on its right

            &--left {
                margin-right: 0;
                padding: 1rem;
                border: 1px solid $color-primary-light;
                border-right: none;
                border-top-left-radius: $border-radius-standard;
                border-bottom-left-radius: $border-radius-standard;

                // ...The input field on its right

                & + .form__input {
                    border-top-left-radius: 0;
                    border-bottom-left-radius: 0;
                    border-left: none;                    
                    background-color: rgba($color-primary , .1);
                    border-color: $color-primary-light;

                    &:focus {
                        background-color: $color-primary-light;
                        border-color: $color-primary;
                    }                    
                }
            }
        }

        &__slider{
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: .5rem;
            background-color: $gray;
            border-radius: $border-radius-standard;
            outline: none;

            // Chrome
            &::-webkit-slider-thumb {
                appearance: none;
                width: 2rem;
                height: 25px;
                border-radius: 50%;
                background-color: $color-primary-light;
                border: none;
                outline: none;
                cursor: pointer;
            }

            // Mozilla
            &::-moz-range-thumb  {
                -webkit-appearance: none;
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                background-color: $color-primary-light;
                border: none;
                outline: none;
                cursor: pointer;
            }

            &__container {
                flex-grow: 3;
            }

            &__value {
                color: $color-primary-light;
                font-weight: bold;
                font-size: 1.2em;
                margin-left: $spacing-small;
            }
        }
    }

    // Checkboxes List

    .checkbox{

        &__container {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-evenly;

            max-width: calc(#{$width-inner-content} / 2);
            padding-top: $spacing-more;
            padding-bottom: $spacing-more;

            li {
                margin-right: $spacing-standard;
                margin-bottom: $spacing-standard;
            }
        }


        &__label {
            display: block;
            position: relative;
            padding-left: $spacing-more;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;


            &:hover input ~ .checkbox__checkmark {
                // Style Hover
            }
            & input:checked ~ .checkbox__checkmark {
                // Style Checked
            }
            & input:checked ~ .checkbox__checkmark:after {
                display: block;
            }
        }

        &__field {
            position: absolute;
            cursor: pointer;
            opacity: 0;
            height: 0;
            width: 0;
        }

        &__checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 2.2rem;
            width: 2.2rem;
            border: 1px solid $color-primary-light;
            border-radius: $border-radius-standard;

            &:after {
                content: "\f078";
                position: absolute;
                display: none;
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                line-height: 2.2rem;
                width: 100%;
                text-align: center;
                color: $color-primary-light;
                font-size: 90%;
            }
        }
    }

</style>