<template>
        
        <form action="" class="form">
            
            <div class="form__group">
                
                <!-- Location -->

                <div class="form__field form__field--location"
                    :class="isFiltersBoxOpen ? 'form__field--full' : 'form__field--half'">
                    <label class="form__label form__label--left">Località</label>
                    <input :class="isFiltersBoxOpen ? null : 'form__input--small'"
                    
                    class="form__input" type="text">
                </div>

                <!-- Search Button -->

                <div v-if="!isFiltersBoxOpen"
                    class="form__field">       
                    <button                     
                    type="button" 
                    @click="search()"
                    class="btn btn--primary-light"><span class="hide-on-tablet">Cerca </span><i class="fas fa-search"></i></button>
                </div>


                <!-- Filters Button -->

                <div v-if="!isFiltersBoxOpen"                     
                    class="form__field">
                    <button @click="toggleFilterBox()" type="button" class="btn btn--primary-light"><span class="hide-on-tablet">Vedi Più </span>Filtri</button>
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
                            <input v-model="maxDistance" type="range" min="1" max="3" value="1" class="form__slider" id="search-form-distance">
                        </div>

                        <span class="form__slider__value">{{maxDistance * 20}} Km</span>

                    </div>
                </div>

                <div class="form__group">

                    <!-- Rooms -->

                    <div class="form__field form__field--half form__field--rooms">
                        <label for="search-form-rooms" class="form__label form__label--left">Camere <span class="hide-on-mobile">da letto </span>(min)</label>
                        <input id="search-form-rooms" class="form__input" type="number">
                    </div>

                    <!-- Toilets -->

                    <div class="form__field form__field--half form__field--toilets">
                        <label for="search-form-toilets" class="form__label form__label--left"><span class="hide-on-mobile">Numero </span>Bagni (min)</label>
                        <input id="search-form-toilets" class="form__input" type="number">
                    </div>
                </div>

                <div class="form__group">                    

                    <!-- Price -->

                    <div class="form__field form__field--half form__field--price">
                        <label class="form__label" for="search-form-price">Prezzo (max)</label>
                        <div class="form__slider__container">
                            <input v-model="maxPrice" type="range" min="20" max="500" value="50" class="form__slider" id="search-form-price">
                        </div>
                        <span class="form__slider__value">{{maxPrice}} <i class="fas fa-euro-sign"></i></span>
                    </div>

                    <!-- Rating -->

                    <div class="form__field form__field--half form__field--rating">
                        <label class="form__label" for="search-form-rating">Valutazione (min)</label>
                        <div class="form__slider__container">
                            <input v-model="minRating" type="range" min="1" max="5" value="3" class="form__slider" id="search-form-rating">
                        </div>
                        <span class="form__slider__value">{{minRating}} <i class="fas fa-star"></i></span>
                    </div>

                </div>

                <div class="form__group">

                    <!-- Additional Services -->

                    <div class="form__field form__field--big">
                        <span class="form__label">Servizi Aggiuntivi:</span>
                        
                            <ul class="checkbox-list">
                                <li>
                                    <label class="container">Aria Condizionata
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Cucina
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Piscina
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Garage
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Navetta Aeroportuale
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Escursioni Guidate
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Colazione Inclusa
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                                <li>
                                    <label class="container">Escort in camera
                                        <input type="checkbox" checked="checked">
                                    </label>
                                </li>

                            </ul>                            
                    </div>
                </div>
                

                <div class="form__group">

                    <!-- Search Button -->

                    <div class="form__field form__field--half">
                        <button 
                        @click="search()"
                        type="button" 
                        class="btn btn--primary-light">
                            Cerca 
                            <i class="fas fa-search"></i>
                        </button>                
                    </div>

                    <div class="form__field form__field--half">
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
    export default {
        data() {
            return {
                isFiltersBoxOpen : false ,
                minRating : 3 ,
                maxPrice : 50 ,
                maxDistance : 1
            }
        },
        methods : {
            toggleFilterBox() {
                this.isFiltersBoxOpen == true ? this.isFiltersBoxOpen = false : this.isFiltersBoxOpen = true;
            } ,
            search() {
                alert("Hai effettuato una ricerca. Bravo!");
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
            z-index: 3;

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
                padding: $spacing-small;
                flex: 0 0 100%;
            }

            // 50% Width Fields

            &--half {
                flex: 0 0 calc((100% - #{$spacing-tiny}) / 2);                
            }

            // Vertical Group (i.e. checkboxes container)

            &--big {
                height: auto;
                flex-direction: column;
            }

            // Special Style for location field

            &--location {
                .form__input {
                    flex: 1 0 50%;
                }
                .form__label {
                    flex: 0 1 50%;
                    }
            }
        }

        &__input {
            &--small {
                max-width: 18rem;   
            }
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

    .checkbox-list {
        list-style-type: none;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: space-evenly;

        max-width: calc(#{$width-inner-content} / 2);
        padding-top: $spacing-small;

        li {
            margin-right: $spacing-standard;
            margin-bottom: $spacing-small;
        }

        label {
            opacity: .8;
        }

        input {

        }
    }

</style>