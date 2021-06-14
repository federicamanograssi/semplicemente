<template>
        <form action="" class="form form--advanced-search">
            
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
                <div class="btn btn--primary-inverse">Più Filtri</div>
            </div>

        </form>
</template>

<script>
    export default {
        mounted() {
            
        }
    }
</script>

<style scoped lang="scss">

@import "../../sass/variables";

    .form--advanced-search {
        flex: 0 0 100%;
        background-color: $color-primary-light;

        padding: 5px;

        .form__field {
            background-color: $white;
            height: 100%;
            flex-grow: 1;
            padding: 10px;

            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;

            &:not(:last-child) {
                margin-right: 5px;
                border-radius: $border-radius-standard;
            }

            &--guests {
                @include responsive(tablet) {
                   display: none;
                }
            }

            &--services {
                @include responsive(tablet) {  
                   display: none;
                }
            }
        }

        .form__label {
            margin-right: $spacing-standard;
        }
    }

</style>
