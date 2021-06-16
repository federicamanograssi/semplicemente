<template>
    <header class="header header--guest">

            <div class="header__inner">

                <!-- Primary Nav -->
                <nav class="header__nav">

                    <!-- Logo -->
                    <div class="header__logo-container">
                        <img class="header__logo" :src="logoSrc" alt="logo">
                    </div>
                    
                    <!-- Toggle Menu -->

                    <div @click="toggleHeaderMenu()" class="header__toggle-button">
                        
                        <i class="header__hamburger fas fa-bars"
                          :class="isMenuOpen ? 'hidden' : null">
                        </i>   

                        <i class="header__close-menu fas fa-times"
                          :class="!isMenuOpen ? 'hidden' : null">
                        </i>

                    </div>

                    <!-- Main Menu -->
                    <ul class="header__menu"
                       :class="isMenuOpen ? 'header__menu--mobile' : null">
                        <li class="header__menu-item header__menu-item--home"><i class="fas fa-home"></i> Home Page</li>
                        <li class="header__menu-item"><i class="far fa-heart"></i> Chalet in Evidenza</li>
                        <li class="header__menu-item"><i class="fas fa-search-location"></i> Ricerca Avanzata</li>
                        <li class="header__menu-item"><i class="fas fa-sign-in-alt"></i> LogIn</li>
                    </ul>

                </nav>

            </div>
        </header>
</template>

<script>
    export default {
        mounted() {
            
        } 
        ,
        data() {
            return {
                'logoSrc' : '/img/logo.png' ,
                'isMenuOpen' : false
            }
        },
        methods : {
            toggleHeaderMenu() {
                this.isMenuOpen == true ? this.isMenuOpen = false : this.isMenuOpen = true;
            }
        }
    }
</script>
