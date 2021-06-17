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

                        <!-- Link statici -->

                        <!-- 
                            <li class="header__menu-item header__menu-item--home"> <i class="fas fa-home"></i> Home Page</li>
                            <li class="header__menu-item"><i class="far fa-heart"></i> <a href="/search"> Chalet in Evidenza</a></li>
                            <li class="header__menu-item"><i class="fas fa-search-location"></i> Ricerca Avanzata</li>
                            <li class="header__menu-item"><i class="fas fa-sign-in-alt"></i> LogIn</li> 
                        -->

                        <!-- link dinamici -->

                        <li  v-for="(item , index) in this.items" 
                            :key="index"
                            :class="'header__menu-item--' + item.name"
                             class="header__menu-item">
                                
                            <form
                                v-if="item.name=='signout'"
                                id="logout-form" 
                                action="/logout" 
                                method="POST">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <button class="btn btn--primary-light-inverse" type="submit">
                                        <i :class="item.icon"></i>
                                        {{item.label}}
                                    </button>
                            </form>

                            <span  v-else>
                                <i :class="item.icon"></i> 
                                <a :href="item.slug">{{item.label}}</a>
                            </span>
                        </li>

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
                'isMenuOpen' : false ,                
            }
        },
        props :             
            ['items' , 'csrf'] ,
        
        methods : {
            toggleHeaderMenu() {
                this.isMenuOpen == true ? this.isMenuOpen = false : this.isMenuOpen = true;
            }
        }
    }
</script>
