<template>

    <main class="main main--advanced-search">

        <advanced-search-form 
            v-on:newQuery="getNewQuery($event)" 
            :currentQuery="currentQuery"
            :highestAptPrice="highestAptPrice"
            :lowestAptPrice="lowestAptPrice"
            >

            <!-- Search Form -->

        </advanced-search-form>

        <apartments-list 
            :apartments="filteredApartments" 
            :mapIsShown="mapIsShown" 
             class="apartments-list--full-width">

            <!-- Lista degli appartamenti -->

        </apartments-list>

        <chalet-map 
            v-on:mapToggled="toggleMap()" 
            :baseLon="baseLon" 
            :baseLat="baseLat">

            <!-- Mappa -->

        </chalet-map>

    </main>
    
</template>

<script>
    export default {

        mounted() {
            this.currentQuery.maxPrice ? null : this.currentQuery.maxPrice = this.highestAptPrice;
            this.search();
        },
        data() {            
            return {

                apartments: [] ,

                filteredApartments : [] ,

                baseLat  : 0 ,
                baseLon : 0 ,

                highestAptPrice  : 200  ,
                lowestAptPrice   :  0 ,

                currentQuery : {
                    baseLocation     : this.destination  ,
                    maxDistance      : 40 ,
                    guests           : 2 ,
                    minRating        : 1 ,
                    minRooms         : 1 ,
                    // maxPrice         : 199 ,
                    maxPrice         : null ,
                    selectedServices : []  ,
                } ,

                mapIsShown : true
            }
        },
        props : ['destination'] ,   // Arriva come parametro URL e deriva da uno dei link in home page oppure dalla località cha abbiamo scelo di default
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

                    // Controllo Servizi Aggiuntivi



                    this.filteredApartments.push(apt);   // Se l'appartamento soddisfa tutti i filtri lo pusho nell'array                    
                
                }                    
            },
            toggleMap(){
                this.mapIsShown == false ? this.mapIsShown = true : this.mapIsShown = false;
            },
            getaptListInfo() {
                                                

                if (this.apartments.length == 0) return // Se la lista di appartamenti è vuota abbandona la fuzione

                // Definizione di prezzo minimo e massimo fra tutti gli
                // appartamenti presenti nell'array (filtrati e non)

                let maxPrice = this.apartments[0].price;
                let minPrice = this.apartments[0].price;

                this.apartments.forEach(apt => {
                    apt.price > maxPrice ? maxPrice = apt.price : null;
                    apt.price < minPrice ? minPrice = apt.price : null;
                });

                this.highestAptPrice = Math.ceil(maxPrice);
                this.lowestAptPrice  = Math.ceil(minPrice);

            } ,
            search() {
                console.log("Occhio: Sto per lanciare una nuova richiesa al server!");
                self = this;    // alias
                axios
                    .get('http://127.0.0.1:8000/api/location' , {
                        params: {
                            location    :   this.currentQuery.baseLocation ,
                            radius      :   this.currentQuery.maxDistance
                            }
                        })
                    .then((response)=>{
                        
                        self.apartments = response.data.results;

                        self.baseLat = response.data.base_lat;  // latitudine  località cercata dall'utente
                        self.baseLon = response.data.base_lon;  // Longitudine località cercata dall'utente

                        self.getaptListInfo();
                        self.filterResults();
                });        
            } ,
            getNewQuery(newQuery){

                let newSearchIsNeeded = false;

                const oldQuery = this.currentQuery; // alias
                
                if((oldQuery.baseLocation != newQuery.baseLocation) || (oldQuery.maxDistance < newQuery.maxDistance) ){
                    newSearchIsNeeded = true;   // flag: se è cambiata la località o è aumentato il raggio serve una nuova ricerca nel DB
                }

                this.currentQuery = newQuery;           // sovrascrive la vecchia query con quella nuova

                if(newSearchIsNeeded) this.search();    // lancia una nuova ricerca nel DB se necessaio (il successivo filtraggio sarà richiamato dal metodo search() )
                             
                else this.filterResults();              // Se non è necessaria una nuova ricerca nel DB si limita a filtrare
                
            }
        }
    }
</script>
