<template>
        <main class="main main--advanced-search">

        

        <advanced-search-form v-on:newQuery="getNewQuery($event)" :query="currentQuery">
            <!-- Search Form -->
        </advanced-search-form>

        <apartments-list :apartments="filteredApartments" :mapIsShown="mapIsShown" class="apartments-list--full-width">
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
            this.search();
        },
        data() {            
            return {

                apartments: [] ,

                filteredApartments : [] ,

                currentQuery : {                
                    baseLocation    : this.destination,
                    baseLat         : 0 ,
                    baseLon         : 0 ,
                    maxDistance     : 40,
                    minRating       : 1,
                    minRooms       : 1,
                    guests          : 2,
                    maxPrice        : 200 ,
                    selectedServices    : []
                    // highestPrice : ***Si deve calcolare il prezzo massimo fra gli appartamenti filtrati e passarlo al form, in modo che si possa visualizzare come valore minimo nello slider***
                    // LowestPrice  : ***Come sopra, ma per il prezzo minimo***
                } ,

                mapIsShown : true
            }
        },
        props : ['destination'] ,
        methods : {
            filterResults(){

                this.filteredApartments = [];   // Resetta lista appartamenti filtrati (ne compileremo una nuova a breve)

                // Facciamo riferimento alla lista degli appartamenti generale
                // E filtriamo tutti quelli che corrispondono alle richieste dell'utente
                // il tutto tramite un ciclo for (preferito al foreach per la possibilità di usare 'continue')

                for(let i = 0; i < this.apartments.length ; i++) {

                    const apt   = this.apartments[i];   // Alias
                    const query = this.currentQuery;    // Alias

                    // Controllo la distanza

                    if (apt.dist > query.maxDistance) {
                        continue;
                    }
                    
                    // Controllo Prezzo

                    if (apt.price > query.maxPrice) {
                        // Possiamo approfittarne per stabilire prezzo max e min di tutti gli appartamenti selezionati
                        continue;
                    }

                    // Controllo Punteggio

                    if ( apt.rating < query.minRating ) {                
                        continue;
                    }

                    // Controllo numero ospiti / letti

                    if ( apt.beds < query.guests ) {                
                        continue;
                    }

                    // Controllo Numero Camere
                    
                    if ( apt.rooms < query.minRooms ) {                
                        continue;
                    }

                    this.filteredApartments.push(this.apartments[i]);   // Se l'appartamento sopravvive al filtraggio viene pushato nella lista degli appartamenti da visualizzare 
                }

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
                        
                        self.apartments = response.data.results;
                        self.currentQuery.baseLat = response.data.base_lat;
                        self.currentQuery.baseLon = response.data.base_lon;

                        self.filterResults();
                });        
            } ,
            getNewQuery(newQuery){


                let newSearchIsNeeded = false;

                const oldQuery = this.currentQuery;
                
                if((oldQuery.baseLocation != newQuery.baseLocation) || (oldQuery.maxDistance < newQuery.maxDistance) ){
                    newSearchIsNeeded = true;
                }

                this.currentQuery = newQuery;   // sovrascrive la vecchia query con quella nuova

                if(newSearchIsNeeded) this.search();    // lancia una nuova ricerca nel DB se necessaio                
                else this.filterResults();              // Se non è necessaria una nuova ricerca nel DB si limita a filtrare
            }
        }
    }
</script>
