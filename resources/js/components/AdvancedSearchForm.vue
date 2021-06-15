<template>
        
        <form action="" class="form form--nowrap form--advanced-search">
            
            
                <div class="form__field form__field--location">
                    <label class="form__label" for="localita">Località</label>
                    <input id="localita" type="text" class="form__input">
                </div>
            

                <div class="form__field form__field--guests">
                    <label class="form__label" for="ospiti">Ospiti</label>
                    <input id="ospiti" type="text" class="form__input">
                </div>

                <div class="form__field form__field--services">
                    <label class="form__label" for="servizi">Servizi</label>
                    <input id="servizi" type="text" class="form__input">
                </div>

            

            <div class="form__field">
                <div @click="toggleFilterBox()" class="btn btn--primary-inverse">Più Filtri</div>
            </div>

            <div class="form__filters"
                :class="isFiltersBoxOpen ? null : 'hidden'">
                
                <div class="form__group">
                    <div class="form__field">
                        <label class="form__label" for="ospiti">Ospiti</label>
                        <input id="ospiti" type="text" class="form__input">
                    </div>

                    <div class="form__field form__field--services">
                        <label class="form__label" for="servizi">Servizi</label>
                        <input id="servizi" type="text" class="form__input">
                    </div>
                </div>
                
            </div>

        </form>

</template>

<script>
    export default {
        mounted() {
            
        },
        data() {
            return {
                isFiltersBoxOpen : false
            }
        },
        methods : {
            toggleFilterBox() {
                this.isFiltersBoxOpen == true ? this.isFiltersBoxOpen = false : this.isFiltersBoxOpen = true;

            }
        }
    }
</script>

<style scoped lang="scss">

@import "../../sass/variables";

    .form--advanced-search {
        flex: 0 0 100%;
        background-color: $color-primary-light;
        padding: $spacing-tiny;
        padding-right: 0;


        .form__field {
            background-color: $white;
            padding: 10px;
            border-radius: $border-radius-standard;

            &--guests ,
            &--services {
                @include responsive(tablet) {
                   display: none;
                }
            }
        }
        

        position: relative;

        .form__filters {
            position: absolute;
            top: 100%;
            height: 80px;
            width: 100%;
            z-index: 55;
            background-color: $white;
        }
    }

</style>
