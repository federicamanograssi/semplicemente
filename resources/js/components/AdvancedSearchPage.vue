<template>
        <main class="main main--advanced-search">

        

        <advanced-search-form v-on:newQuery="getNewQuery($event)" :query="currentQuery">
            <!-- Search Form -->
        </advanced-search-form>

        <apartments-list :apartments="apartments" :mapIsShown="mapIsShown" class="apartments-list--full-width">
            <!-- Lista degli appartamenti -->
        </apartments-list>

        <chalet-map v-on:mapToggled="toggleMap()" :baseLon="currentQuery.baseLon" :baseLat="currentQuery.baseLat">
            <!-- Mappa -->
        </chalet-map>

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
                    baseLat         : 0 ,
                    baseLon         : 0 ,
                    maxDistance     : 1,
                    minRating       : 1,
                    maxPrice        : 200 ,
                    selectedServices    : []
                } ,

                mapIsShown : true
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
            toggleMap(){
                this.mapIsShown == false ? this.mapIsShown = true : this.mapIsShown = false;
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

                        self.currentQuery.baseLat = response.data.base_lat;
                        self.currentQuery.baseLon = response.data.base_lon;

                        self.filterResults();
                });        
            } ,
            getNewQuery(newQuery){

                let newSearchIsNeeded = false;
                
                if((this.currentQuery.baseLocation != newQuery.baseLocation) || (this.currentQuery.maxDistance < newQuery.maxDistance) ){
                    newSearchIsNeeded = true;
                }

                newQuery.base_lat = this.currentQuery.base_lat; // <-- provvisorissimo: serve ad evitare che le coordinate passino per il 'undefinied
                newQuery.base_lon = this.currentQuery.base_lon; // <-- provvisorissimo: serve ad evitare che le coordinate passino per il 'undefinied

                this.currentQuery = newQuery; //   <-- Per questo ottieni due console.log al variare delle coordinate!

                if(newSearchIsNeeded) this.search();
                else this.filterResults();
            }
        }
    }
</script>
