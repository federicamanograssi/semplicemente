<template>
        <main class="main main--advanced-search">

        

        <advanced-search-form v-on:newQuery="getNewQuery($event)" :query="currentQuery">
            <!-- Search Form -->
        </advanced-search-form>

        <apartments-list :apartments="apartments" class="apartments-list--full-width">
            <!-- Lista degli appartamenti -->
        </apartments-list>

        <section class="chalet-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54471.2440560787!2d12.052418201662949!3d46.66978139530556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47783435d247033f%3A0xdd3c30437b92e42b!2s32043%20Cortina%20d&#39;Ampezzo%20BL!5e1!3m2!1sit!2sit!4v1623660828144!5m2!1sit!2sit" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>

        <div class="chalet-map__button-container">
            <div class="chalet-map__button chalet-map__button--close">
                <i class="fas fa-times"></i>
            </div>
            
            <div class="chalet-map__button chalet-map__button--open hidden">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>

    </main>
</template>

<script>
    export default {

        mounted() {
            //
        },
        data() {            
            return {
                apartments: [] ,                

                currentQuery : {                
                    baseLocation    : this.destination,
                    maxDistance     : 1,
                    minRating       : 1,
                    maxPrice        : 200 ,
                    selectedServices    : []
                }
            }
        },
        props : ['destination'] ,
        methods : {
            filterResults(){
                // filter results
                this.apartments.forEach(apartment => {

                    // Check Distance 

                    if( apartment['dist'] > this.currentQuery.maxDistance)
                        {                            
                            apartment.visible = false;
                            }
                    else apartment.visible = true;
                });
            },
            search() {
                console.log("Occhio: Sto per lanciare una nuova richiesa al server!");
                self = this;
                axios
                    .get('http://127.0.0.1:8000/api/location' , {
                        params: {
                            location    :   this.currentQuery.baseLocation ,
                            radius      :   this.currentQuery.maxDistance
                            }
                        })
                    .then((response)=>{
                        response.data.results.forEach(apartment => {
                            apartment['visible'] = true;
                        });
                        
                        self.apartments = response.data.results;
                        self.filterResults();
                });        
            } ,
            getNewQuery(newQuery){
                let newSearchIsNeeded = false;
                
                if((this.currentQuery.baseLocation != newQuery.baseLocation) || (this.currentQuery.maxDistance < newQuery.maxDistance) ){
                    newSearchIsNeeded = true;
                }

                this.currentQuery = newQuery;

                if(newSearchIsNeeded) this.search();
                else this.filterResults();
            }
        }
    }
</script>
